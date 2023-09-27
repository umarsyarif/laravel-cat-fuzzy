<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    protected $faker;
    protected $questionCountPerCategory = 50;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create("id_ID");
        $faker = $this->faker;

        $categories = ['Mudah', 'Menengah', 'Sulit'];
        for ($i=0; $i < $this->questionCountPerCategory; $i++) {
            foreach ($categories as $row) {
                Question::create([
                    'category' => $row,
                    'question' => $faker->sentence(),
                    'multiple_choice' => [
                        ['pilihan' => 'A', 'text' => $faker->text($maxNbChars = 20)],
                        ['pilihan' => 'B', 'text' => $faker->text($maxNbChars = 20)],
                        ['pilihan' => 'C', 'text' => $faker->text($maxNbChars = 20)],
                        ['pilihan' => 'D', 'text' => $faker->text($maxNbChars = 20)],
                        ['pilihan' => 'E', 'text' => $faker->text($maxNbChars = 20)]
                    ],
                    'answer' => 'A',
                    'value' => $this->getValueByCategory($row)
                ]);
            }
        }
    }

    private function getValueByCategory($category){
        $lowerLimit = [
            'Mudah' => 0.1,
            'Menengah' => 0.26,
            'Sulit' => 0.51,
        ];
        $upperLimit = [
            'Mudah' => 0.25,
            'Menengah' => 0.50,
            'Sulit' => 1,
        ];
        return $this->faker->randomFloat(1, $lowerLimit[$category], $upperLimit[$category]);
    }
}
