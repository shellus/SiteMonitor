<?php

namespace Tests\Feature;

use App\Monitor;
use App\Service\MonitorService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMonitorTest extends TestCase
{
	protected $monitor;

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$this->monitor = MonitorService::quickGenerateMonitor(1, "http://www.baidu.com",'http_status_code', '200', 1);
		$this->assertNotNull($this->monitor->id);
		$this->assertNotNull($this->monitor->data->monitor_id);
		MonitorService::deleteMonitor($this->monitor->id);
		$this->assertTrue(true);
	}
}
