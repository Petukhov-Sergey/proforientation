@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.breadcrumbs')
        <h1 class="mt-5">Создание вопроса для теста: {{ $test->title }}</h1>
        <form action="{{ route('editor.tests.questions.store', $test->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">Содержание вопроса</label>
                <input type="text" class="form-control" id="content" name="content" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Создать вопрос</button>
        </form>
    </div>
@endsection
