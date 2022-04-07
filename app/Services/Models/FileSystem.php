<?php

namespace App\Services\Models;

use App\Services\Parsers\FileSystems;
use JsonSerializable;

class FileSystem implements JsonSerializable
{
	protected $volumes = [];


	public function __construct() {
		$volumes = FileSystems::parse();

		foreach($volumes as $volume) {
			$this->volumes[] = new Volume($volume);
		}
	}


	public function jsonSerialize() {
		return $this->volumes;
	}
}
