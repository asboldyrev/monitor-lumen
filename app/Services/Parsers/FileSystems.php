<?php

namespace App\Services\Parsers;

class FileSystems
{
	public static function parse() {
		$volumes = [];

		exec('/bin/df -T | tail -n +2 | awk \'{print $1","$2","$3","$4","$5","$6","$7}\'', $volumes_data);

		foreach($volumes_data as $volume_data) {
			list($filesystem, $type, $total, $used, $free, $percent, $mount) = explode(',', $volume_data);

			if (strpos($type, 'tmpfs') !== false && !config('monitor.volumes.show_tmpfs')) {
				continue;
			}

			$volumes[] = [
				'total' => bytes_convert($total * 1024),
				'used' => bytes_convert($used * 1024),
				'free' => bytes_convert($free * 1024),
				'percent_used' => intval($percent),
				'type' => $type,
				'mount' => $mount,
				'filesystem' => $filesystem,
			];
		}

		return $volumes;
	}
}
