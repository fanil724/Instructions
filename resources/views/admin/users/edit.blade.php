@extends('layouts.app')

@section('title', 'Админ | Изменить пользователя')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        @include('parts.messages')
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Имя пользователя</label>
                <input type="text" class="form-control @error('name')  is-invalid @enderror" id="exampleFormControlInput1"
                    name="name" value="{{old('name') ?? $user->name}}">
                @error('name')
                    <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Майл пользователя</label>
                <input type="text" class="form-control @error('email')  is-invalid @enderror" id="exampleFormControlInput1"
                    name="email" value="{{old('email') ?? $user->email}}">
                @error('email')
                    <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="is_admin"
                    @checked(old('is_admin', $user->is_admin))>
                <label class="form-check-label" for="flexCheckDefault">
                    Админ
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Изменить пользователя</button>
        </form>
    </div>
@endsection