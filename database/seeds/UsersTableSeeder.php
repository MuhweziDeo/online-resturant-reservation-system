<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => "aggrey",
            'email' => 'aggrey257@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
