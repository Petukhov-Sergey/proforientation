@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.breadcrumbs')
        <h1 class="mt-5">Редактирование результатов для теста: {{ $test->title }}</h1>
        <a href="{{ route('editor.tests.results.create', $test->id) }}" class="btn btn-primary mb-3">Создать результат</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->title }}</td>
                    <td>{{ $result->description }}</td>
                    <td>
                        <a href="{{ route('editor.tests.results.edit', [$test->id, $result->id]) }}" class="btn btn-sm btn-secondary me-2">Редактировать</a>
                        <form action="{{ route('editor.tests.results.destroy', [$test->id, $result->id]) }}" method="POST" style="display: inline;">
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
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
