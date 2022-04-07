<?php

namespace App\Services\Parsers;

class Memory
{
	public static function parse() {
		$stat = shell_exec('cat /proc/meminfo | awk \'{print $1","$2","$3}\'');

		if(!$stat) {
			return [];
		}

		$stat = explode(PHP_EOL, $stat);
		$stat = array_filter($stat, 'mb_strlen');

		return array_map(function($item) {
			list($name, $value, $unit) = explode(',', $item);

			$value = intval($value);
			$name = mb_strtolower(str_replace(':', '', $name));

			if($unit == 'kB') {
				$value *= 1024;
			}

			if($unit == 'MB') {
				$value *= 1024 * 1024;
			}

			return compact('name', 'value');
		}, $stat);
	}
}
