<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\User;

class UserControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'UsersTableSeeder']);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUser():void
    {
        $response = $this->json('POST', '/api/v1/user', ['email' => 'aggrey00@gmail.com',
            'password' =>'passowrd', 'username' => 'dee', 'password_confirmation' =>'passowrd']);
        $response->assertStatus(201);
    }

    public function testCreateUserWithInvalidData():void
    {
        $response = $this->json('POST', '/api/v1/user', ['email' => 'aggrey00@gmail.com',
            'password' =>'passowrd', 'usernam' => 'dee', 'password_confirmation' =>'passowrd']);
        $response->assertStatus(400);
    }

    public function testgetAllUsers(): void
    {
        $response = $this->json('GET', '/api/v1/user');
        $response->assertStatus(200);
    }

    public function testGetUser():void
    {
        $response = $this->json('GET', '/api/v1/user/1');
        $response->assertStatus(200);
    }

    public function testGetUserNotFound(): void
    {
        $response = $this->json('GET', '/api/v1/user/20000');
        $response->assertStatus(404);
    }

    public function testUpdateUser(): void
    {
        $user = User::first();
        $token = auth('api')->login($user);
        $response = $this->json('PUT', "/api/v1/user/$user->id",
        ['password'=> 'password', 'password_confirmation' => 'password'],
        ['HTTP_Authorization' => $token]);
        $response->assertStatus(200);
    }

    public function testUnAuthoriseUpdate(): void
    {
        $user = User::first();
        $token = auth('api')->login($user);
        $response = $this->json('PUT', "/api/v1/user/2",
        ['password'=> 'password', 'password_confirmation' => 'password'],
        ['HTTP_Authorization' => $token]);
        $response->assertStatus(403);
    }
}
