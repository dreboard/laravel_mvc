<?php

namespace Tests\Unit;

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
        //$response = $this->get('allCycle');
        $response = $this->action('GET', 'CycleController@getAllCycles');
        $response->assertStatus(200);
    }

    /**
     * Test get all cycles route.
     *
     * @return void
     */
    public function testShowCycleForm()
    {
        $response = $this->get('showCycleForm');
        $response->assertStatus(200);
    }
}
