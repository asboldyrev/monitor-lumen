<?php

namespace Asboldyrev\Monitor\Exceptions;

use RuntimeException;
use Throwable;

class CpuInfoEmptyException extends RuntimeException
{
	public function __construct($code = 0, Throwable $previous = null) {
		parent::__construct('Отсутствует информация в /proc/cpuinfo', $code, $previous);
	}
}