@extends('layouts.app')

@section('title', 'инструкции')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center">
        @include('parts.messages')
        <div class="card" style="width: 56rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $instruction->title }}</h5>
                <p class="card-text">{{$instruction->description}}</p>
                <p class="card-text">{{$content}}</p>
            </div>
        </div>
    </div>
@endsection