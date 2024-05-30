<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\StoreRequest;
use App\Http\Requests\Test\UpdateRequest;
use App\Models\Test;
use App\Services\Editor\TestService;

class TestController extends Controller
{
    private TestService $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function index()
    {
        $tests = Test::with('questions')->get();
        return view('editor.test.index', compact('tests'));
    }

    public function create()
    {
        return view('editor.test.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->testService->createTest($data);
        return redirect()->route('editor.tests.index');
    }

    public function update(UpdateRequest $request, Test $test)
    {
        $data = $request->validated();
        $this->testService->updateTest($test, $data);

        return response()->json([
            'message' => 'Test updated successfully',
            'test' => $test,
        ]);
    }

    public function destroy(Test $test)
    {
        $this->testService->deleteTest($test);
        return redirect()->route('editor.tests.index');
    }
}
