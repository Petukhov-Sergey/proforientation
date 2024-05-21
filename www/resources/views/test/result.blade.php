@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">На главную</a>
        </div>
        <h1 class="mt-5">Ваш результат: {{ $topResult->title }}</h1>
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($topResult->result_image_path)
                        <img src="{{ $topResult->result_image_path }}" class="img-fluid rounded-start" alt="{{ $topResult->title }}">
                    @else
                        <img src="https://via.placeholder.com/640x480.png/005588?text=result" class="img-fluid rounded-start" alt="{{ $topResult->title }}">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $topResult->title }}</h5>
                        <p class="card-text">{{ $topResult->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
