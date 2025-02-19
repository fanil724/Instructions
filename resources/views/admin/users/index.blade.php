@extends('layouts.app')

@section('title', 'Пользователи')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h2>Пользователи</h2>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-4">Создать пользователя</a>
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <a href="{{ route('admin.users.blockedUsers') }}" class=" btn btn-primary">
                        Заблокированные пользователи
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @include('parts.messages')
            @forelse ($users as $user)
                <div class="card" class="col-sm" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <div class="form-check">
                            <input data-id="{{ $user->id }}" class="form-check-input checkBlock" type="checkbox"
                                id="flexCheckDefault" name="is_blocked" @checked(old('is_blocked', $user->is_blocked))>
                            <label class="form-check-label" for="flexCheckDefault">
                                Заблокированный
                            </label>
                        </div>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">Изменить</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger  mt-2">Удалить</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Нет пользователей</p>
            @endforelse
            {{$users->links() }}
        </div>
    </div>
@endsection