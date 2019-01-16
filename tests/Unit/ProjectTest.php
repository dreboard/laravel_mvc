<?php

namespace Tests\Unit;

use App\Project;
use App\Ticket;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProjectTest extends TestCase
{
    protected $table = 'projects';
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = User::find(1);
    }
    //use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_any_project_route()
    {
        $user = User::find(1);
        $projects = Project::Find(1);
        $response = $this->actingAs($user, 'web')->get(route('project_view', ['id' => $projects->id]));
        $response->assertStatus(200);
    }

    /**
     *
     */
    public function test_user_can_create_a_project()
    {
        $this->withoutMiddleware();

        $user = new User(array('name' => 'John'));
        $this->be($user);

        $data = [
            'title' => 'Updated Name',
            'description' => 'f5fr5rf 6y56erf t44',
            'create_date' => date('Y-m-d'),
            'site_id' => 1,
            'created_by' => 1,
        ];

        $response = $this->post(route('project_save', $data));
        $response->assertStatus(302)->assertSee($data['title']);
    }
}
