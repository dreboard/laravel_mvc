<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteTest extends TestCase
{

    protected $table = 'sites';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSiteHome()
    {
        $this->withoutMiddleware();
        $response = $this->get('/site_all');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSiteWithoutMiddleware()
    {
        $data = [
            'title' => "New Site",
            'description' => "This is a site",
            'url' => 'www.test.com',
            'ga' => 'UA12345678',
            'submitted' => 1,
            'git_url' => 'github.com/tester',
            'created_by' => 1
        ];
        $this->assertTrue(true);
        $response = $this->json('POST', '/site_save',$data);
        //$response->assertStatus(419);
        //$response->assertJson(['exception' => "Symfony\\Component\\HttpKernel\\Exception\\HttpException"]);
    }

    /**
     *
     */
    public function testUserCanCreateSite()
    {
        $this->withoutMiddleware();
        $data = [
            'title' => "New Site 5",
            'description' => "This is a site",
            'url' => 'www.test5.com',
            'ga' => 'UA12345678',
            'submitted' => 1,
            'git_url' => 'github.com/tester',
            'created_by' => 1
        ];
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'web')->json('POST', '/site_save',$data);
        //$response->assertStatus(200);
        $this->assertDatabaseHas($this->table, ['title' => "New Site 5"]);
        $response->assertViewIs('admin.sites.view');
    }

    public function testNoUserCanCreateSite()
    {
        $this->withoutMiddleware();
        $data = [
            'title' => "New Site",
            'description' => "This is a site",
            'url' => 'www.test2.com',
            'ga' => 'UA12345678',
            'submitted' => 1,
            'git_url' => 'github.com/tester',
            'created_by' => 1
        ];
        $response = $this->json('POST', '/site_save',$data);
        $this->assertDatabaseMissing($this->table, $data);
    }
}
