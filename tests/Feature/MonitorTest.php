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
    	foreach (Monitor::all() as $monitor){
		    $snapshot = MonitorService::request($monitor);
		    MonitorService::handleSnapshot($snapshot);
		    $this->assertTrue(true);
	    }
    }
}
