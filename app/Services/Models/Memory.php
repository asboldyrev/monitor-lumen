<?php

namespace App\Services\Models;

use App\Services\Parsers\Memory as ParsersMemory;
use JsonSerializable;

class Memory implements JsonSerializable
{
	protected $total = 0;

	protected $used = 0;

	protected $free = 0;

	protected $percent = 0;


	public function __construct() {
		$stat = ParsersMemory::parse();

		if(count($stat)) {
			$total = $this->finFiled('memtotal', $stat);
			$free = $this->finFiled('memfree', $stat);
			$buffers = $this->finFiled('buffers', $stat);
			$cached = $this->finFiled('cached', $stat);

			$free = $free + $buffers + $cached;

			$used = $total - $free;

			if($total) {
				$percent = 100 - round($free / $total * 100, 2);
			}
		}

    	$this->total = bytes_convert($total, null, 2);
		$this->used = bytes_convert($used, null, 2);
    	$this->free = bytes_convert($free, null, 2);
    	$this->percent = $percent ?? 0;
	}


	public function jsonSerialize() {
		return [
			'total' => $this->total,
			'used' => $this->used,
			'free' => $this->free,
			'percent' => $this->percent,
		];
	}


	protected function finFiled(string $fieldName, array $fields) {
		foreach($fields as $field) {
			if($field['name'] == $fieldName) {
				return $field['value'];
			}
		}

		return '';
	}
}
