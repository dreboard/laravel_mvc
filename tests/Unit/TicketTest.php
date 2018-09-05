<?php

namespace Tests\Unit;

use App\Project;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TicketTest extends TestCase
{
    //use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        //$this->withoutMiddleware();
        $projects = Project::Find(1);
        $response = $this->get(route('project_view', ['id' => $projects->id]));
        $response->assertStatus(302);
        //$response->assertSee('Project #1');
        //$response->assertViewHas('allCycles', $tickets);
        //$this->assertTrue(true);
    }
}
