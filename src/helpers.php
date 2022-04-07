<?php

if (!function_exists('bytes_convert')) {
	function bytes_convert(string $bytes, string $format = NULL):string {
		$base = 1024;
		$units = [ 'B', 'KB', 'MB', 'GB', 'TB' ];

		if (is_null($format)) {
			for ($i = count($units) - 1; $i >= 0; $i--) {
				$size = pow($base, $i);
				$format = $units[ $i ];
				if ($bytes > $size) {
					break;
				}
			}
		} else {
			$format = mb_strtoupper($format, 'UTF-8');
			$exp = array_search($format, $units);
			$size = pow($base, $exp);
		}

		return sprintf('%d %s', round($bytes / $size), $format);
	}
}