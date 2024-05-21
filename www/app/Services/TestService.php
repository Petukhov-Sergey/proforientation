<?php

namespace App\Services;

use App\Models\Test;
use App\Models\Answer;
use App\Models\Result;

class TestService
{
    public function calculateResult(array $answers)
    {
        $results = [];
        foreach ($answers as $answerId) {
            $answer = Answer::find($answerId);
            foreach ($answer->results as $result) {
                if (!isset($results[$result->id])) {
                    $results[$result->id] = 0;
                }
                $results[$result->id] += $result->pivot->rating;
            }
        }

        $topResultId = array_keys($results, max($results))[0];
        return Result::find($topResultId);
    }
}
