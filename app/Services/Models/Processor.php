<?php

namespace App\Services\Models;

use App\Services\Parsers\CpuInfo;
use JsonSerializable;

class Processor implements JsonSerializable
{
	protected $model = '';

	protected $frequency = '';

	protected $cache = '';

	protected $physicalCoreCount = 0;

	protected $coreCount = 0;

	protected $temperature = null;


	public function __construct() {
		$cores = CpuInfo::parse();
		$max_frequency = CpuInfo::getMaxFrequency();
		$core_data = count($cores) ? $cores[0] : [];

		$this->model = $this->getModel($core_data);
		$this->frequency = $max_frequency ?: $this->getFrequency($core_data);
		$this->cache = $this->getCacheSize($core_data);
		$this->physicalCoreCount = intval($this->getPhysicalCoreCount($core_data));
		$this->coreCount = count($cores);

		if(config('monitor.cpu.temperature')) {
			$this->getTemperature();
		}
	}

	public function jsonSerialize() {
		$result = [
			'model' => $this->model,
			'frequency' => $this->frequency,
			'cache' => $this->cache,
		 ];

		if(config('monitor.cpu.temperature')) {
			$result['temperature'] = $this->temperature;
		}

		return $result;
	}

	protected function getModel(array $coreData) {
		$field_names = [
			'model name',
			'cpu model',
			'cpu',
			'processor',
		];

		return $this->findField($field_names, $coreData);
	}


	protected function getFrequency(array $coreData) {
		$field_names = [
			'cpu mhz',
			'clock',
		];

		return $this->findField($field_names, $coreData);
	}


	protected function getCacheSize(array $coreData) {
		$field_names = [
			'cache size',
			'l2 cache',
		];

		return $this->findField($field_names, $coreData);
	}


	protected function getPhysicalCoreCount(array $coreData) {
		$field_names = [
			'cpu cores'
		];

		return $this->findField($field_names, $coreData);
	}


	protected function findField(array $fieldNames, array $coreData) {
		foreach($fieldNames as $field_name) {
			if(key_exists($field_name, $coreData)) {
				return $coreData[ $field_name ];
			}
		}

		return '';
	}


	protected function getTemperature() {
		$result = exec('/usr/bin/sensors | grep -E "^(CPU Temp|Core 0)" | cut -d \'+\' -f2 | cut -d \'.\' -f1', $temp);

		if($result && key_exists(0, $temp)) {
			$this->temperature = sprintf('%s °C', $temp[0]);
		} elseif (exec('cat /sys/class/thermal/thermal_zone0/temp', $temp) && key_exists(0, $temp)) {
			$this->temperature = round($temp[0] / 1000).' °C';
		}
	}
}
