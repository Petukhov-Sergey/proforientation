@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Назад</a>
        </div>
        <h1 class="mt-5">{{ $test->title }}</h1>
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($test->preview)
                        <img src="{{ $test->preview }}" class="img-fluid rounded-start" alt="{{ $test->title }}">
                    @else
                        <img src="https://via.placeholder.com/640x480.png/005588?text=test+perspiciatis" class="img-fluid rounded-start" alt="{{ $test->title }}">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $test->title }}</h5>
                        <p class="card-text">{{ $test->description }}</p>
                        <a href="{{ route('tests.start', $test->id) }}" class="btn btn-primary">Начать тест</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
