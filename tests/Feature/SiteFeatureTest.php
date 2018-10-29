<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteFeatureTest extends TestCase
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
        $titleNum = "New Site ". random_int(1, 10000000);
        $this->withoutMiddleware();
        $data = [
            'title' => $titleNum,
            'description' => "This is a site",
            'url' => 'www.test'. random_int(1, 10000000).'.com',
            'ga' => 'UA'. random_int(100000, 9999999),
            'submitted' => 1,
            'git_url' => 'github.com/tester',
            'created_by' => 1
        ];
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'web')->json('POST', '/site_save',$data);
        $this->assertDatabaseHas($this->table, ['title' => $titleNum]);
        $response->assertViewIs('admin.sites.view');
    }

    public function testNoUserCanCreateSite()
    {
        $this->withoutMiddleware();
        $data = [
            'title' => "New Site Tested",
            'description' => "This is a site",
            'url' => 'www.tested.com',
            'ga' => '111111111',
            'submitted' => 1,
            'git_url' => 'github.com/tester',
            'created_by' => 1
        ];
        $response = $this->json('POST', '/site_save',$data);
        $this->assertDatabaseMissing($this->table, $data);
    }

    public function testIsLoggedInAdmin()  {
        $titleNum = "New Site ". random_int(1, 10000000);
        $this->withoutMiddleware();
        $data = [
            'title' => $titleNum,
            'description' => "This is a site",
            'url' => 'www.test'. random_int(1, 10000000).'.com',
            'ga' => 'UA'. random_int(100000, 9999999),
            'submitted' => 1,
            'git_url' => 'github.com/tester',
            'created_by' => 1
        ];
        //$user = factory(\App\User::class)->create();
        $user = User::where('isAdmin', '=', 1)->first();
        $response = $this->actingAs($user, 'web')->json('POST', '/site_save',$data);
        $this->assertDatabaseHas($this->table, ['title' => $titleNum]);
        $response->assertViewIs('admin.sites.view');
    }
}
