<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CycleTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    /**
     * Test get all cycles route.
     *
     * @return void
     */
    public function testAllCyclesRoute()
    {
        $user = new User(array('email' => 'dre.board@gmail.com'));
        $this->be($user); //You are now authenticated
        $response = $this->get('allCycle');
        $response->assertStatus(200);
    }

    /**
     * Test get all cycles route.
     *
     * @return void
     */
    public function testShowCycleForm()
    {
        $user = new User(array('email' => 'dre.board@gmail.com'));
        $this->be($user); //You are now authenticated
        $response = $this->get('showCycleForm');
        $response->assertStatus(200);
    }
}
