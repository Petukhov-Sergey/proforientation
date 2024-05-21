<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Services\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function index()
    {
        $tests = Test::paginate(10);
        return view('test.index', compact('tests'));
    }

    public function show(Test $test)
    {
        return view('test.show', compact('test'));
    }

    public function start(Test $test)
    {
        $test->load('questions.answers');
        return view('test.start', compact('test'));
    }

    public function submit(Request $request, Test $test)
    {
        $answers = $request->input('answers');
        $topResult = $this->testService->calculateResult($answers);

        return view('test.result', compact('test', 'topResult'));
    }
}
