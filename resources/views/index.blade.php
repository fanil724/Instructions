@extends('layouts.app')

@section('title', 'Главная')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('parts.messages')

                <div class="card">



                    <div class="card-header">Интсрукции</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>Добро пожаловать на наш сайт!</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection