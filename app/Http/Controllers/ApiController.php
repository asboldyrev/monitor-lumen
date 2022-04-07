<?php

namespace App\Http\Controllers;

use App\Services\Models\FileSystem;
use App\Services\Models\Login;
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
}