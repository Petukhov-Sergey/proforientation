<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\StoreRequest;
use App\Http\Requests\Answer\UpdateRequest;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(Question $question)
    {
        $answers = $question->answers()->with('results')->get();
        $results = $question->test->results;
        return view('editor.answer.index', compact('question', 'answers', 'results'));
    }

    public function create(Question $question)
    {
        $results = $question->test->results;
        return view('editor.answer.create', compact('question', 'results'));
    }

    public function store(StoreRequest $request, Question $question)
    {
        $data = $request->validated();

        $answer = $question->answers()->create([
            'content' => $data['content'],
        ]);

        if (!empty($data['results'])) {
            foreach ($data['results'] as $resultId) {
                $answer->results()->attach($resultId, ['rating' => $data['ratings'][$resultId] ?? 0]);
            }
        }

        return redirect()->route('editor.questions.answers.index', $question->id)->with('success', 'Answer created successfully');
    }

    public function edit(Question $question, Answer $answer)
    {
        $answer->load('results');
        return response()->json($answer);
    }




    public function update(UpdateRequest $request, Question $question, Answer $answer)
    {
        $data = $request->validated();

        $answer->update([
            'content' => $data['content'],
        ]);
        $answer->results()->detach();
        if (!empty($data['results'])) {
            foreach ($data['results'] as $resultId) {
                $answer->results()->attach($resultId, ['rating' => $data['ratings'][$resultId] ?? 0]);
            }
        }
        return redirect()->route('editor.questions.answers.index', $question->id)->with('success', 'Answer updated successfully');
    }

    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();
        return redirect()->route('editor.questions.answers.index', $question->id)->with('success', 'Answer deleted successfully');
    }
}
