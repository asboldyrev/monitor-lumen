<?php

namespace Asboldyrev\Monitor\Models;

use Asboldyrev\Monitor\Parsers\FileSystems;

class FileSystem
{
	protected $volumes = [];


	public function __construct() {
		$volumes = FileSystems::parse();

		foreach($volumes as $volume) {
			$this->volumes[] = new Volume($volume);
		}
	}


	public function __toString() {
		return json_encode($this->volumes);
	}
}