<?php

namespace Asboldyrev\Monitor\Controllers;

use Asboldyrev\Monitor\Models\FileSystem;
use Asboldyrev\Monitor\Models\Login;
use Asboldyrev\Monitor\Models\Processor;

class ApiController
{
	public function processor() {
		$cpu = new Processor();

		header('Content-Type: application/json');
		echo $cpu;
	}


	public function fileSystems() {
		$volumes = new FileSystem();

		header('Content-Type: application/json');
		echo $volumes;
	}


	public function lastLogin() {
		$logins = new Login();

		header('Content-Type: application/json');
		echo $logins;
	}
}