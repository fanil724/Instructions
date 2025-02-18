@extends('layouts.app')

@section('title', 'Жалобы')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container-fluid">
        @include('parts.messages')
        <div class="card" style="width: 56rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $comInstrukt->title }}</h5>
                <p class="card-text">{{$comInstrukt->dexription}}</p>
                <p class="card-text">{{$comInstrukt->users_id}}</p>
                <p class="card-text">{{$comInstrukt->instructions_id}}</p>
            </div>
        </div>
    </div>
@endsection