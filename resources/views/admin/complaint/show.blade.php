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
                    <p class="card-text">Отправитель жалобы: {{$compalint->users_id}}</p>
                    <p class="card-text">Инструкция {{$compalint->instructions_id}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection