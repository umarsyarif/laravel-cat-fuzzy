<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 3; $i++) {
            Exam::create([
                'name' => 'Ujian Akhir B.Inggris ' . $i + 1,
                'timer' => 120,
                'timer_per_question' => 120,
                'total_question' => 25,
                'is_active' => true
            ]);
        }
    }
}
