<?php

namespace App\Services\Models;

use JsonSerializable;

class Utilization implements JsonSerializable
{
	protected $utilization = 0;

	public function __construct() {
		$this->utilization = floatval(shell_exec('grep \'cpu \' /proc/stat | awk \'{print ($2+$4)*100/($2+$4+$5)}\' | tr -d \\\\n'));
	}


	public function jsonSerialize() {
		return [ 'utilization' => $this->utilization ];
	}
}
