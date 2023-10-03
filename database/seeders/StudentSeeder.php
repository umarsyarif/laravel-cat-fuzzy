<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => "Test",
            'nisn' => "1234567890",
            'password' => "123456",
            'address' => "123"
        ]);
    }
}
