<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteTest extends TestCase
{
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

        $response = $this->json('POST', '/site_save',$data);
        $response->assertStatus(419);
        $response->assertJson(['exception' => "Symfony\\Component\\HttpKernel\\Exception\\HttpException"]);
    }

    /**
     *
     */
    public function testCreateSite()
    {
        $this->withoutMiddleware();
        $data = [
            'title' => "New Site",
            'description' => "This is a site",
            'url' => 'www.test.com',
            'ga' => 'UA12345678',
            'submitted' => 1,
            'git_url' => 'github.com/tester',
            'created_by' => 1
        ];
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'web')->json('POST', '/site_save',$data);
        $response->assertStatus(200);
        $response->assertViewIs('admin.sites.view');
    }
}
