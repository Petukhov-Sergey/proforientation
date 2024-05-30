<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'test_id' => \App\Models\Test::factory(),
            'content' => $this->faker->sentence,
        ];
    }
}
