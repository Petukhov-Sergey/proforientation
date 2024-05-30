@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5">Все тесты</h1>
        <div class="row">
            @foreach ($tests as $test)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($test->preview)
                            <img src="{{ $test->preview }}" class="card-img-top" alt="{{ $test->title }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $test->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $test->title }}</h5>
                            <p class="card-text">{{ Str::limit($test->description, 100) }}</p>
                            <a href="{{ route('tests.show', $test->id) }}" class="btn btn-primary">Пройти тест</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $tests->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
