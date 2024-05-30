<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required|string|max:255',
            'results' => 'nullable|array',
            'results.*' => 'nullable|integer|exists:results,id',
            'ratings' => 'nullable|array',
            'ratings.*' => 'nullable|numeric|min:0|max:1'
        ];
    }
}
