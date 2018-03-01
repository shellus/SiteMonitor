<?php

namespace Tests\Feature;

use JJG\Ping;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $host = 'www.google.com';
        $ping = new Ping($host);
        $latency = $ping->ping();
        if ($latency !== false) {
            print 'Latency is ' . $latency . ' ms';
        }
        else {
            print 'Host could not be reached.';
        }
        $this->assertTrue(true);
    }
}
