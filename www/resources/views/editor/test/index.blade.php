@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.breadcrumbs')
        <h1 class="mt-5">Редактирование тестов</h1>
        <a href="{{ route('editor.tests.create') }}" class="btn btn-primary mb-3">Создать тест</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Количество вопросов</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tests as $test)
                <tr>
                    <td>{{ $test->id }}</td>
                    <td id="test-title-{{ $test->id }}">{{ $test->title }}</td>
                    <td>{{ $test->questions->count() }}</td>
                    <td>
                        <button class="btn btn-sm btn-secondary me-2" @click="$refs.editTestModal.openModal({ id: {{ $test->id }}, title: '{{ $test->title }}' })">Редактировать название</button>
                        <a href="{{ route('editor.tests.questions.index', $test->id) }}" class="btn btn-sm btn-primary me-2">Редактировать вопросы</a>
                        <a href="{{ route('editor.tests.results.index', $test->id) }}" class="btn btn-sm btn-info me-2">Просмотр результатов</a>
                        <form action="{{ route('editor.tests.destroy', $test->id) }}" method="POST" style="display: inline;">
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
        <edit-test-modal ref="editTestModal"></edit-test-modal>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
