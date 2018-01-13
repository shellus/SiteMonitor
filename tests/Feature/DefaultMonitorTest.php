<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DefaultMonitorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
    	/** @var User $user */
    	$user = User::findOrFail(1);
    	$monitors = $user->defaultProject()->monitors;
        $this->assertNotNull($monitors);
    }
}
