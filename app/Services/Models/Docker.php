<?php

namespace App\Services\Models;

use Carbon\Carbon;
use JsonSerializable;

class Docker implements JsonSerializable
{
	protected $containers = [];

	public function __construct() {
		$containers = json_decode(shell_exec('curl --unix-socket /var/run/docker.sock http://localhost/v1.41/containers/json?all=true'));

		foreach($containers as $container) {
			$this->containers[] = [
				'name' => mb_strcut($container->Names[0], 1),
				'state' => $container->State,
				'status' => $container->Status,
				'image' => $container->Image,
				'created' => Carbon::createFromTimestamp($container->Created, config('app.timezone'))->toIso8601String()
			];
		}
	}


	public function jsonSerialize() {
		return $this->containers;
	}
}
