<?php

namespace App\Services\Editor;

use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestService
{
    public function createTest(array $testData)
    {
        $test = null;
        DB::transaction(function () use ($testData, &$test) {
            $test = Test::create([
                'title' => $testData['title'],
            ]);
        });
        return $test;
    }

    public function updateTest(Test $test, array $data): Test
    {
        DB::transaction(function () use ($test, $data) {
            $test->update([
                'title' => $data['title'],
            ]);
        });
        return $test;
    }

    public function deleteTest(Test $test)
    {
        DB::transaction(function () use ($test) {
            $test->delete();
        });
    }
}
