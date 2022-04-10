<?php

namespace App\Services\Models;

use App\Services\Parsers\SystemInfo;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use JsonSerializable;

class System implements JsonSerializable
{
	protected $hostname = '';

	protected $system = '';

	protected $kernel = '';

	protected $uptime = '';

	protected $lastBoot = '';

	protected $serverDate = '';


	public function __construct() {
		$info = SystemInfo::parse();

		$uptime = CarbonInterval::createFromFormat('s', $info['uptime'])->roundMinute();
		$uptime->setLocale('ru');

		$this->hostname = $info['hostname'];
		$this->system = $info['os'];
		$this->kernel = $info['kernel'];
		$this->uptime = (string)$uptime;
		$this->lastBoot = Carbon::now(config('app.timezone'))->subSeconds($info['uptime'])->toIso8601String();
		$this->serverDate = $info['server_date']->toIso8601String();
	}


	public function jsonSerialize() {
		return [
			'hostname' => $this->hostname,
			'system' => $this->system,
			'kernel' => $this->kernel,
			'uptime' => $this->uptime,
			'lastBoot' => $this->lastBoot,
			'serverDate' => $this->serverDate,
		];
	}
}
