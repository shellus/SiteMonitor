<?php

namespace Tests\Feature;

use App\Mail\TestEmail;
use App\Service\MonitorService;
use App\Snapshot;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        MonitorService::handleSnapshot(Snapshot::findOrFail(2));
        $this->assertTrue(true);
    }
}
