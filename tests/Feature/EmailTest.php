<?php

namespace Tests\Feature;

use App\Mail\TestEmail;
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
        \Mail::to(User::firstOrFail())->send(new TestEmail("你好"));
        $this->assertTrue(true);
    }
}
