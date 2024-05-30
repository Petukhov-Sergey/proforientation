<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
public function index(Question $question)
{
return response()->json($question->answers()->with('results')->get());
}

public function store(Request $request, Question $question)
{
$answer = $question->answers()->create($request->only('content'));
$answer->results()->attach($request->input('results', []));
return response()->json($answer->load('results'));
}

public function show(Question $question, Answer $answer)
{
return response()->json($answer->load('results'));
}

public function update(Request $request, Question $question, Answer $answer)
{
$answer->update($request->only('content'));
$answer->results()->sync($request->input('results', []));
return response()->json($answer->load('results'));
}

public function destroy(Question $question, Answer $answer)
{
$answer->delete();
return response()->json(null, 204);
}
}
