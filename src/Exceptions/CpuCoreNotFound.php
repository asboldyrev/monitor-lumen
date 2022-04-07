<?php

namespace Asboldyrev\Monitor\Exceptions;

use RuntimeException;

class CpuCoreNotFound extends RuntimeException
{
	public function __construct(int $coreId) {
		parent::__construct(sprintf('Ядро %d не найдено', $coreId));
	}
}