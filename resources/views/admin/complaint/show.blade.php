@extends('layouts.app')

@section('title', 'Жалобы')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container-fluid justify-content-center">
        @include('parts.messages')
        <div class="card" style="width: 56rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $comInstrukt->title }}</h5>
                <p class="card-text">{{$comInstrukt->dexription}}</p>
                <p class="card-text">Отправитель жалобы: {{$comInstrukt->user->name}}</p>
                <p class="card-text">Инструкция {{$comInstrukt->instruction->title}}</p>
            </div>
        </div>
    </div>
@endsection