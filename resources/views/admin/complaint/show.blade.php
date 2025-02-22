@extends('layouts.app')

@section('title', 'Жалобы')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="justify-content-center">
        <div class="container ">
            @include('parts.messages')
            <div class="card" style="width: 56rem;">
                <div class="card-body">
                    <h5 class="card-title">Наименование жалобы: {{ $compalint->title }}</h5>
                    <p class="card-text">Текст жалобы: {{$compalint->dexription}}</p>
                    <p class="card-text">Отправитель жалобы:
                        <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            href="{{ route('admin.users.show', $compalint->user) }}">{{$compalint->user->name}}</a>
                    </p>
                    <p class="card-text">Инструкция:
                        <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            href="{{ route('admin.instructions.show', $compalint->instruction) }}">{{$compalint->instruction->title}}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection