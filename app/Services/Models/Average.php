<?php

namespace App\Services\Models;

use JsonSerializable;

class Average implements JsonSerializable
{

	protected $average = [
		'value' => [ 0, 0, 0 ],
		'percent' => [ 0, 0, 0 ]
	 ];


	public function __construct() {
		$load = shell_exec('cat /proc/loadavg | awk \'{print $1","$2","$3}\'');

		if($load) {
			$core_count = $this->getCpuCoresNumber();

			$load = explode(',', $load);

			array_walk($load, function(&$value) {
				$value = floatval($value);
			});

			$this->average['value'] = $load;

			array_walk(
				$load,
				function(&$value) use ($core_count) {
					$value = $value * 100 / $core_count;
					if ($value > 100) {
						$value = 100;
					}
				}
			);

			$this->average['percent'] = $load;
		}
	}


	public function jsonSerialize() {
		return $this->average;
	}


	protected function getCpuCoresNumber() {
		$num_cores = intval(shell_exec('/bin/grep -c ^processor /proc/cpuinfo'));
		if($num_cores) {
			return $num_cores;
		}

		$num_cores = intval(shell_exec('/usr/bin/nproc'));
		if($num_cores) {
			return $num_cores;
		}

        return 1;
    }
}
