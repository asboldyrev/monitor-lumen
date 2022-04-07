<?php

namespace Asboldyrev\Monitor\Models;

use JsonSerializable;

class Volume implements JsonSerializable
{
	protected $total = '';

	protected $used = '';

	protected $free = '';

	protected $percent = 0;

	protected $type = '';

	protected $mount = '';

	protected $filesystem = '';


	public function __construct(array $data) {
		$this->total = $data['total'];
		$this->used = $data['used'];
		$this->free = $data['free'];
		$this->percent = $data['percent_used'];
		$this->type = $data['type'];
		$this->mount = $data['mount'];
		$this->filesystem = $data['filesystem'];
	}


	public function jsonSerialize() {
		return [
			'total' => $this->total,
			'used' => $this->used,
			'free' => $this->free,
			'percent' => $this->percent,
			'type' => $this->type,
			'mount' => $this->mount,
			'filesystem' => $this->filesystem,
		];
	}
}