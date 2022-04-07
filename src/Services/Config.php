<?php

namespace Asboldyrev\Monitor\Services;

class Config
{
	protected static $config = [];


	public static function get($key, $default = null) {
		self::loadConfig();

		if(key_exists($key, self::$config)) {
			return self::$config[$key];
		}

		$array = self::$config;
		foreach (explode('.', $key) as $segment) {
            if (key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

		return $array;
	}


	private static function loadConfig() {
		if(count(self::$config) == 0) {
			self::$config = include __DIR__ . '/../../config.php';
		}
	}
}