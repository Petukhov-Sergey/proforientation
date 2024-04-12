@extends('layouts.main')
@section('content')
    <div class="container">
        <h1 class="mt-5">Изменение данных пользователя</h1>
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Новый пароль (оставьте пустым, чтобы не изменять)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group mb-3">
                <label for="role_id">Роль</label>
                <select class="form-control" id="role_id" name="role_id" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Обновить пользователя</button>
        </form>
    </div>
@endsection
