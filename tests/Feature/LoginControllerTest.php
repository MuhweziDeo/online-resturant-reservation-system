<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'UsersTableSeeder']);
    }


    public function testLoginFail(): void
    {

        $response = $this->json('POST', '/api/v1/login', ['email' => 'aggrey00@gmail.com',
            'password' =>'passowrd']);
        $response->assertStatus(401);
    }

    public function testLoginSuccess(): void
    {

        $response = $this->json('POST', '/api/v1/login', ['email' => 'aggrey257@gmail.com',
            'password' =>'password']);
        $response->assertStatus(200);

    }

    public function testJsonResponseStructure():void
    {
        $response = $this->json('POST', '/api/v1/login', ['email' => 'aggrey257@gmail.com',
            'password' =>'password']);
        $response->assertJsonStructure(['message', 'token', 'data']);
    }

}
