<?php

use Illuminate\Support\HtmlString;

if (!function_exists('bytes_convert')) {
	function bytes_convert(string $bytes, string $format = NULL, int $precission = 0):string {
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

		return round($bytes / $size, $precission) . ' ' . $format;
	}
}

if (! function_exists('mix')) {

    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString
     *
     * @throws \Exception
     */
    function mix($path, $manifestDirectory = '')
    {
        static $manifest;
        if (!str_starts_with($path, '/')) {
            $path = "/{$path}";
        }
        if ($manifestDirectory && !str_starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }
        if (file_exists(base_path('/public'.$manifestDirectory.'/hot'))) {
            return new HtmlString("//localhost:8080{$path}");
        }
        if (! $manifest) {
            if (! file_exists($manifestPath = base_path('/public'.$manifestDirectory.'/mix-manifest.json'))) {
                throw new Exception('The Mix manifest does not exist.');
            }
            $manifest = json_decode(file_get_contents($manifestPath), true);
        }
        if (! array_key_exists($path, $manifest)) {
            throw new Exception(
                "Unable to locate Mix file: {$path}. Please check your ".
                'webpack.mix.js output paths and try again.'
            );
        }
        return new HtmlString($manifestDirectory.$manifest[$path]);
    }
}
