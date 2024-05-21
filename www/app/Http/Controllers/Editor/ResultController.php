<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Result\StoreRequest;
use App\Http\Requests\Result\UpdateRequest;
use App\Models\Test;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class ResultController extends Controller
{
    public function index(Test $test)
    {
        $results = $test->results()->get();
        return view('editor.result.index', compact('test', 'results'));
    }

    public function create(Test $test)
    {
        return view('editor.result.create', compact('test'));
    }

    public function store(StoreRequest $request, Test $test)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                $data['cover_image_path'] = $request->file('cover_image')->store('cover_images');
            }

            if ($request->hasFile('result_image')) {
                $data['result_image_path'] = $request->file('result_image')->store('result_images');
            }

            $test->results()->create($data);

            return redirect()->route('editor.tests.results.index', $test->id)->with('success', 'Result created successfully');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Test $test, Result $result)
    {
        return view('editor.result.edit', compact('test', 'result'));
    }

    public function update(UpdateRequest $request, Test $test, Result $result)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                // Удаляем старый файл
                if ($result->cover_image_path) {
                    Storage::delete($result->cover_image_path);
                }
                $data['cover_image_path'] = $request->file('cover_image')->store('cover_images');
            }

            if ($request->hasFile('result_image')) {
                // Удаляем старый файл
                if ($result->result_image_path) {
                    Storage::delete($result->result_image_path);
                }
                $data['result_image_path'] = $request->file('result_image')->store('result_images');
            }

            $result->update($data);

            return redirect()->route('editor.tests.results.index', $test->id)->with('success', 'Result updated successfully');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Test $test, Result $result)
    {
        $result->delete();
        return redirect()->route('editor.tests.results.index', $test->id)->with('success', 'Result deleted successfully');
    }
}
