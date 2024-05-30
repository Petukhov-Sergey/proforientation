@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.breadcrumbs')
        <h1 class="mt-5">Редактирование вопросов для теста: {{ $test->title }}</h1>
        <a href="{{ route('editor.tests.questions.create', $test->id) }}" class="btn btn-primary mb-3">Создать вопрос</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Содержание</th>
                <th>Количество ответов</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td id="question-content-{{ $question->id }}">{{ $question->content }}</td>
                    <td>{{ $question->answers->count() }}</td>
                    <td>
                        <button class="btn btn-sm btn-secondary me-2" @click="$refs.editQuestionModal.openModal({ id: {{ $question->id }}, content: '{{ $question->content }}', test_id: {{ $test->id }} })">Редактировать вопрос</button>
                        <a href="{{ route('editor.questions.answers.index', $question->id) }}" class="btn btn-sm btn-primary me-2">Редактировать ответы</a>
                        <form action="{{ route('editor.tests.questions.destroy', [$test->id, $question->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger me-2" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="app">
        <edit-question-modal ref="editQuestionModal"></edit-question-modal>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
