<?php

namespace Tests\Feature;

use App\Monitor;
use App\Service\MonitorService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonitorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
    	/** @var Monitor $monitor */
	    foreach (Monitor::all() as $monitor){

		    $snapshot = $monitor->snapshots()->create();

		    $requestResult = MonitorService::request($monitor);

		    MonitorService::storeSnapshot($snapshot, $requestResult);
		    MonitorService::updateMonitorData($monitor, $snapshot);
		    MonitorService::handleSnapshotNotice($snapshot);
//		    MonitorService::joinQueue($monitor);

		    $this->assertTrue(true);
	    }
    }
}
