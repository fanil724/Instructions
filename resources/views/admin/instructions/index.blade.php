@extends('layouts.app')

@section('title', 'Интсрукции')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container justify-content-center">
        <div class="page-header">
            <h2>Интсрукции на проверку</h2>

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
                        <a href="{{ route('admin.instructions.show', $instruction) }}" class="btn btn-primary">Прочитать </a>
                        <a href="{{ route('download', $instruction) }}" class="btn  btn-success ">Скачать </a>
                        <a href="{{ route('admin.instructions.addInstruktion', $instruction->id) }}"
                            class="btn btn-warning mt-2">Добавить
                            инструкцию</a>

                    </div>
                </div>
            @empty
                <p>Нет интсрукции</p>
            @endforelse
            {{ $instructions->links() }}
        </div>
    </div>
@endsection