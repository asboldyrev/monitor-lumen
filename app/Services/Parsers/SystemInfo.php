<?php

namespace App\Services\Parsers;

class SystemInfo
{
	public static function parse() {
		$tz = self::getTimezone();

		$uptime = shell_exec('cat /proc/uptime | awk \'{print $1}\' | tr -d \\\\n');

		return [
			'hostname'      => php_uname('n'),
			'os'            => self::getSystemName(),
			'kernel'        => shell_exec('/bin/uname -r | tr -d \\\\n') ?: '',
			'uptime'        => round($uptime),
			'server_date'   => shell_exec('/bin/date') ?: date('Y-m-d H:i:s'),
			'timezone'      => $tz,
		];
	}


	protected static function getSystemName() {
		$name = shell_exec('/usr/bin/lsb_release -ds | cut -d= -f2 | tr -d \'"\'');
		if($name) {
			return self::clear($name);
		}

		$name = shell_exec('cat /etc/system-release | cut -d= -f2 | tr -d \'"\'');
		if($name) {
			return self::clear($name);
		}

		$name = shell_exec('find /etc/*-release -type f -exec cat {} \; | grep PRETTY_NAME | tail -n 1 | cut -d= -f2 | tr -d \'"\'');
		if($name) {
			return self::clear($name);
		}

		return '';
	}


	public static function getTimezone() {
		return shell_exec('timedatectl | grep "Time zone" | awk \'{print $3}\' | tr -d \\\\n');
	}


	protected static function clear($string) {
		$string = trim($string, '"');
		return str_replace("\n", '', $string);
	}
}
