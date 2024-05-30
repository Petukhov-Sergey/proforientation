<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\StoreRequest;
use App\Http\Requests\Question\UpdateRequest;
use App\Models\Question;
use App\Models\Test;

class QuestionController extends Controller
{
    public function index(Test $test)
    {
        $questions = $test->questions()->with('answers')->get();
        return view('editor.question.index', compact('test', 'questions'));
    }

    public function create(Test $test)
    {
        return view('editor.question.create', compact('test'));
    }

    public function store(StoreRequest $request, Test $test)
    {
        $data = $request->validated();
        $test->questions()->create($data);

        return redirect()->route('editor.tests.questions.index', $test->id);
    }

    public function update(UpdateRequest $request, Test $test, Question $question)
    {
        $data = $request->validated();
        $question->update($data);

        return response()->json([
            'message' => 'Question updated successfully',
            'question' => $question,
        ]);
    }

    public function destroy(Test $test, Question $question)
    {
        $question->delete();

        return redirect()->route('editor.tests.questions.index', $test->id);
    }
}
