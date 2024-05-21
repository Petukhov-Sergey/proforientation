<?php

namespace App\Services\Editor;

use App\Models\Answer;
use App\Models\Question;

class AnswerService
{
    public function createAnswer(array $data, Question $question): Answer
    {
        $answer = $question->answers()->create([
            'content' => $data['content'],
        ]);

        if (!empty($data['results'])) {
            foreach ($data['results'] as $resultId) {
                $answer->results()->attach($resultId, ['rating' => $data['ratings'][$resultId] ?? 0]);
            }
        }

        return $answer;
    }

    public function updateAnswer(array $data, Question $question, Answer $answer): Answer
    {
        $answer->update([
            'content' => $data['content'],
        ]);

        $answer->results()->detach();
        if (!empty($data['results'])) {
            foreach ($data['results'] as $resultId) {
                $answer->results()->attach($resultId, ['rating' => $data['ratings'][$resultId] ?? 0]);
            }
        }

        return $answer;
    }
}
