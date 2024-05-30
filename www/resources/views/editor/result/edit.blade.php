@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.breadcrumbs')
        <h1 class="mt-5">Редактирование результата для теста: {{ $test->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('editor.tests.results.update', [$test->id, $result->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="title">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $result->title }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="cover_image">Обложка</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                @if($result->cover_image_path)
                    <img src="{{ Storage::url($result->cover_image_path) }}" alt="Cover Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="result_image">Изображение результата</label>
                <input type="file" class="form-control-file" id="result_image" name="result_image">
                @if($result->result_image_path)
                    <img src="{{ Storage::url($result->result_image_path) }}" alt="Result Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description">{{ $result->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
