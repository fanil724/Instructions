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
                        <div class="row justify-content-center" style="width: 15rem;">
                            <div class="col justify-content-center">
                                <a href="{{ route('instructions.show', $instruction) }}">
                                    <img class="hvr-pulse" src="{{ asset('storage/icon/read.png') }}" alt="прочитать"
                                        title="прочитать" width="32">
                                </a>
                            </div>
                            <div class="col justify-content-center">
                                <a href="{{ route('download', $instruction) }}">
                                    <img class="hvr-pulse" src="{{ asset('storage/icon/download.png') }}" alt="скачать"
                                        title="скачать" width="32"></a>
                            </div>
                            <div class="col justify-content-center">
                                @if (Auth::user())
                                    <a href="{{ route('instructions.complaint', $instruction) }}"><img class="hvr-pulse"
                                            src="{{ asset('storage/icon/complaint.png') }}" alt="сообщить о нарушении"
                                            title="сообщить о нарушении" width="32"></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <p>Нет интсрукции</p>
            @endforelse
            {{ $instructions->links() }}
        </div>
    </div>
@endsection