<?php
namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \Illuminate\Foundation\Testing\Concerns\InteractsWithPages;

class RouteTest extends TestCase
{

    use InteractsWithPages;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        //$this->assertTrue(true);
        $this->visit('/')
            ->see('Laravel');
    }
}