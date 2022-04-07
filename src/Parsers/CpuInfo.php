<?php

namespace Asboldyrev\Monitor\Parsers;

use Asboldyrev\Monitor\Exceptions\CpuInfoEmptyException;

class CpuInfo
{
	public static function parse() {
		$cpuinfo = shell_exec('cat /proc/cpuinfo');

		if(!$cpuinfo) {
			throw new CpuInfoEmptyException();
		}

		$cores = [];

		$processors = preg_split('/\s?\n\s?\n/', trim($cpuinfo));

		foreach ($processors as $index => $processor){
			$details = preg_split('/\n/', $processor, -1, PREG_SPLIT_NO_EMPTY);

			foreach ($details as $detail) {
				list($key, $value) = preg_split('/\s*:\s*/', trim($detail));

				$cores[$index][mb_strtolower($key)] = $value;
			}
		}

		return $cores;
	}


	public static function getMaxFrequency() {
		$frecuency = shell_exec('cat /sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_max_freq');
		$frecuency = intval($frecuency);

		if ($frecuency) {
			return sprintf('%s MHz', round($frecuency / 1000));
		}

		return '';
	}
}