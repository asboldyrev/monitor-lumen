<?php

namespace App\Http\Controllers;

use App\Services\Models\Average;
use App\Services\Models\FileSystem;
use App\Services\Models\Login;
use App\Services\Models\Memory;
use App\Services\Models\System;
use App\Services\Models\Processor;

class ApiController extends Controller
{
    public function processor() {
		$cpu = new Processor();

		return response()->json($cpu);
	}


	public function fileSystems() {
		$volumes = new FileSystem();

		return response()->json($volumes);
	}


	public function lastLogin() {
		$logins = new Login();

		return response()->json($logins);
	}


	public function load() {
		$average = new Average();

		return response()->json($average);
	}


	public function memory() {
		$memory = new Memory();

		return response()->json($memory);
	}


	public function system() {
		$system = new System();

		return response()->json($system);
	}
}
