<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Site;

/**
 * Class SiteTest
 * @package Tests\Unit
 * @see https://www.5balloons.info/config-laravel-run-phpunit-test-sqlite-database/
 */
class SiteTest extends TestCase
{
    use WithoutMiddleware;

    protected $table = 'sites';

    private $user;


    /**
     * Test for database table
     * Also test for site generated by migration
     */
    public function testDatabase()
    {
        $this->assertDatabaseHas($this->table, [
            'title' => 'New Site'
        ]);
    }

    /**
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
     * Assert that the user policy is enforced.
     *
     */
    public function testViewUserSite()
    {
        $this->withExceptionHandling();
        $user = User::find(2);
        $response = $this->actingAs($user, 'web')->json('GET', route('site_view', ['id' => 1]));
        $response->assertSessionHasNoErrors();
    }

    /**
     * Assert that the user policy is enforced.
     *
     */
    public function testViewOtherUserSite()
    {
        $this->withExceptionHandling();
        $user = User::find(1);
        $response = $this->actingAs($user, 'web')->json('GET', route('site_view', ['id' => 1]));
        $response->assertSessionHasErrors(['errors']);
    }

    /**
     *
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
     *
     * Assert unauthenticated form access.
     *
     */
    public function testGuessSiteForm()
    {
        $response = $this->get('/site_new');
        $this->assertGuest($guard = 'web');
    }

    /**
     *
     * Authorized user can save a site
     * Database testing for factory post data
     * View testing for correct view loaded
     *
     */
    public function testCanCreateSite()
    {
        $this->withExceptionHandling();
        $user = User::find(1);
        $site = factory(\App\Site::class)->make();
        $response = $this->actingAs($user, 'web')->json('POST', route('site_save'),$site->toArray());
        $this->assertDatabaseHas($this->table, ['title' => $site->title]);
    }

    /**
     *
     * Authorized user can save a site
     * Database testing for factory post data
     * View testing for correct view loaded
     *
     */
    public function testCanCreateSiteException()
    {
        $this->withExceptionHandling();
        $user = User::find(1);
        $site = factory(\App\Site::class)->make()->toArray();
        $response = $this->actingAs($user, 'web')->json('POST', route('site_save'),$site);
        $this->assertDatabaseHas($this->table, ['title' => $site->title]);
    }

    /**
     *
     * Save a site with errors
     * Database testing for factory post data
     * View testing for correct view loaded
     *
     */
    public function testCanCreateSiteFail()
    {
        $user = User::find(1);
        $site = factory(\App\Site::class)->make(['title' => '']);
        $response = $this->actingAs($user, 'web')->json('POST', route('site_save'),$site->toArray());
        $response->assertSessionHasErrors(['title']);
    }
    /**
     *
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
