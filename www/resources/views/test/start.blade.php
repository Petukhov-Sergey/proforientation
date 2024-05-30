@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5">{{ $test->title }}</h1>
        <form action="{{ route('tests.submit', $test->id) }}" method="POST">
            @csrf
            @foreach ($test->questions as $question)
                <div class="mb-4">
                    <h5>{{ $question->content }}</h5>
                    @foreach ($question->answers as $answer)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" required>
                            <label class="form-check-label">{{ $answer->content }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Отправить ответы</button>
        </form>
    </div>
@endsection
