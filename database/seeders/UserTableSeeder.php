<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'bluelabel@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin@2021'),
            'remember_token' => 'token',
            'role' => 1,
        ]);
        User::factory()->create([
            'name' => 'Viewer',
            'email' => 'bluelabel-view@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('viewer@2021'),
            'remember_token' => 'token',
            'role' => 2,
        ]);
        User::factory()->create([
            'name' => 'Uploader',
            'email' => 'bluelabel-upload@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('uploader@2021'),
            'remember_token' => 'token',
            'role' => 3,
        ]);
    }
}
