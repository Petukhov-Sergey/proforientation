<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;

class TestSeeder extends Seeder
{
    public function run()
    {
        Test::factory()
            ->count(23)
            ->create()
            ->each(function ($test) {
                $results = Result::factory()->count(3)->create(['test_id' => $test->id]);

                $questions = Question::factory()->count(5)->create(['test_id' => $test->id]);

                $questions->each(function ($question) use ($results) {
                    $answers = Answer::factory()->count(4)->create(['question_id' => $question->id]);

                    $answers->each(function ($answer) use ($results) {
                        $results->each(function ($result) use ($answer) {
                            $answer->results()->attach($result->id, ['rating' => rand(0, 100) / 100]);
                        });
                    });
                });
            });
    }
}
