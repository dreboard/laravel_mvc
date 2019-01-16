<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllUsers()
    {
        $this->withoutMiddleware();
        $response = $this->get('/user');
        $response->assertStatus(200);
    }

    /**
     * Test Creating User.
     *
     * @return void
     * @throws \Exception
     */
    public function testCreateUser()
    {
        $this->withoutMiddleware();
        $this->withoutExceptionHandling();
        $response = $this->json('post', '/user', [
            'userName' => 'dreboard',
            'email' => 'dre.board'.random_int(1, 1000).'@gmail.com',
            'password' => 'secret',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    /**
     * Test Creating User Fails Validation.
     *
     * @return void
     * @throws \Exception
     */
    public function testCreateUserFails()
    {
        $this->withoutMiddleware();
        $this->withoutExceptionHandling();
        $response = $this->json('post', '/user', [
            'email' => 'dre.board'.random_int(1, 1000).'@gmail.com',
            'password' => 'secret',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => false,
                'error' => ['The user name field is required.'],
            ]);
    }

    public function test_it_validates_login() {

        $this->visit('/login')
            ->press('Login')
            ->see('The password field is required')
            ->see('The email field is required');
    }

    /** @test */
    public function authors_name_must_be_unique_to_store_an_author()
    {
        $author = factory(User::class)->create([
            'name' => 'Robert',
            'email' => 'Jordan'
        ]);

        $author = factory(User::class)->make([
            'name' => 'Robert',
            'email' => 'Jordan'
        ]);

        $this->post('/authors', $author->toArray())->assertSessionHasErrors(['first_name' => 'Author name not unique']);

        $this->assertEquals(1, User::count());
    }
}
