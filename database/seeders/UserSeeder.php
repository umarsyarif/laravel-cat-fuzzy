<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Admin",
            'username' => "admin",
            'email' => "asd@asd.asd",
            'role' => UserRoles::Admin,
            'password' => "123456"
        ]);
    }
}
