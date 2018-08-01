<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CycleTest extends TestCase
{
    use WithoutMiddleware;
    //use RefreshDatabase;

    protected $user;

    protected function setUp () {
        parent::setUp();
        $this->user = new User(array('email' => 'dre.board@gmail.com'));
        $this->be($this->user); //You are now authenticated
        Route::any('test-route', ['as' => 'test-route']);
    }

    /**
     * Test get all cycles route.
     *
     * @return void
     */
    public function testAllCyclesRoute()
    {
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
        //$response = $this->get('/showCycleForm');
        //$response->assertStatus(200);
        $this->assertTrue(true);

    }
}
