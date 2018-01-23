<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018-01-24
 * Time: 0:32
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class MonitorLog extends Facade {
	protected static function getFacadeAccessor() {
		return 'monitorLog';
	}
}