<?php

namespace Asboldyrev\Monitor\Models;

use Asboldyrev\Monitor\Services\Config;
use Carbon\Carbon;

class Login
{
	protected $list = [];

	public function __construct() {
		if(!Config::get('last_login.show')) {
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


	public function __toString() {
		return json_encode($this->list);
	}
}