<?php

namespace Database\Factories;

use App\Models\Result;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    protected $model = Result::class;

    public function definition()
    {
        return [
            'test_id' => \App\Models\Test::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'cover_image_path' => $this->faker->imageUrl(640, 480, 'result', true),
            'result_image_path' => $this->faker->imageUrl(640, 480, 'result', true),
        ];
    }
}
