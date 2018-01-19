<?php

namespace Tests\Feature;

use App\Monitor;
use App\Service\MonitorService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $monitor = new Monitor();
        $monitor->request_url = "http://www.baidu.com";
        $monitor->request_method = "GET";
        $monitor->request_follow_location = true;
        $monitor->request_nobody = false;
        $monitor->request_body = null;

        $curlResult = MonitorService::request($monitor);
        echo PHP_EOL;
        var_dump($curlResult);
        echo PHP_EOL;
        $this->assertTrue(true);
    }
}
