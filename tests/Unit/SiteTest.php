<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Site;

class SiteTest extends TestCase
{
    use WithoutMiddleware;

    protected $table = 'sites';

    private $user;

    /**
     * @covers SiteController::show
     * Assert that the user is authenticated.
     *
     */
    public function testUserSiteView()
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'web')->json('GET', route('site_view'));
        $this->assertAuthenticated($guard = 'web');
    }

    /**
     * @covers SiteController::create
     * Assert that the user is authenticated.
     *
     */
    public function testUserSiteForm()
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'web')->json('GET', route('site_new'));
        $this->assertAuthenticated($guard = 'web');
    }

    /**
     * @covers SiteController::create
     * Assert unauthenticated form access.
     *
     */
    public function testGuessSiteForm()
    {
        $response = $this->get('/site_new');
        $this->assertGuest($guard = 'web');
    }

    /**
     * @covers SiteController::save
     * Authorized user can save a site
     * Database testing for factory post data
     * View testing for correct view loaded
     *
     */
    public function testCanCreateSite()
    {
        $user = User::find(1);
        $site = factory(\App\Site::class)->make();
        $response = $this->actingAs($user, 'web')->json('POST', route('site_save'),$site->toArray());
        $this->assertDatabaseHas($this->table, ['title' => $site->title]);
        $response->assertStatus(200);
        $response->assertViewIs('admin.sites.view');
    }

    /**
     * @covers SiteController::save
     * Unauthorized user cant save a site
     *
     */
    public function testNoUserCanCreateSite()
    {
        $data = factory(\App\Site::class)->make();
        $response = $this->json('POST', route('site_save'),$data->toArray());
        $this->assertDatabaseMissing($this->table, $data->toArray());
        $response->assertStatus(302);
    }
}
