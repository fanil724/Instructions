@extends('layouts.app')

@section('title', 'Главная | Админка')

@section('menu')
    @include('admin.parts.menu')
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

                        <h2>Добро пожаловать админ</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection