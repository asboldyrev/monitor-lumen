<?php

namespace App\Services\Models;

use Carbon\Carbon;
use JsonSerializable;

class Login implements JsonSerializable
{
	protected $list = [];

	public function __construct() {
		if(!config('monitor.last_login.show')) {
			return;
		}

		exec('/usr/bin/lastlog --time 365 | /usr/bin/awk -F\' \' \'{ print $1";"$5, $4, $8, $6}\'', $users);

		if(count($users)) {
			array_shift($users);

			foreach($users as $user) {
				list($user, $date) = explode(';', $user);

				$this->list[] = [
					'user' => $user,
					'date' => Carbon::createFromTimeString($date),
				];
			}
		}
	}


	public function jsonSerialize() {
		return $this->list;
	}
}
