<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    protected $faker;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create("id_ID");
        $faker = $this->faker;
        $index = 1;

        // -4 >= difficulty level <= 4
        for ($i = -4; $i <= 4; $i = $i + 0.01) {
            Question::create([
                'question_code' => 'M' . str_pad($index, 3, '0', STR_PAD_LEFT),
                'question' => $faker->sentence(),
                'multiple_choice' => [
                    'A' => $faker->text(20),
                    'B' => $faker->text(20),
                    'C' => $faker->text(20),
                    'D' => $faker->text(20)
                ],
                'answer' => 'A',
                'difficulty_level' => $i,
                'different_power' => $this->getDifferentPower()
            ]);
            $index++;
        }
    }

    private function getDifferentPower(){
        // 0 >= different power <= 2
        return $this->faker->randomFloat(2, 0, 2);
    }
}
