<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'question_id' => \App\Models\Question::factory(),
        ];
    }
}
