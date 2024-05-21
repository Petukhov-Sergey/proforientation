@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.breadcrumbs')
        <h1 class="mt-5">Редактирование ответов для вопроса: {{ $question->content }}</h1>
        <answers :question='@json($question)' :results='@json($results)'></answers>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
