@extends('layouts.app')

@section('title', 'Интсрукции')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header col">
                <h2>Интсрукции</h2>
                @if (Auth::user())
                    <a href="{{ route('instructions.create') }}" class="btn btn-success mb-5">Добавить инструкцию</a>
                @endif
            </div>
            <div class="col">
                <form action="{{ route('instructions.search') }}" class="input-group mb-3" method="POST">
                    @csrf
                    <button class="input-group-text" id="basic-addon1">Поиск</button>
                    <input type="text" class="form-control" placeholder="Search.." aria-label="Search" name="search"
                        aria-describedby="basic-addon1">
                </form>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row justify-content-center">
            @include('parts.messages')
            @forelse ($instructions as $instruction)
                <div class="card" class="col-sm" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $instruction->title }}</h5>
                        <p class="card-text"> {{$instruction->description}} </p>
                        <a href="{{ route('instructions.show', $instruction) }}" class="btn btn-primary">Прочитать </a>
                        <a href="{{ route('download', $instruction) }}" class="btn  btn-success ">Скачать </a>
                        <a href="{{ route('instructions.complaint', $instruction) }}" class="btn btn-warning mt-2">Сообщить о
                            нарушении </a>

                    </div>
                </div>
            @empty
                <p>Нет интсрукции</p>
            @endforelse
            {{ $instructions->links() }}
        </div>
    </div>
@endsection