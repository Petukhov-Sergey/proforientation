@extends('layouts.app')
@section('content')
    <div class="container">
        @include('components.breadcrumbs')
        <h1>Create a New Test</h1>
        <hr>
        <form action="{{ route('editor.tests.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title" class="mb-3">Test Title</label>
                <input type="text" class="form-control mb-3" id="title" name="title" placeholder="Enter Test Title" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Test</button>
        </form>
    </div>
@endsection
