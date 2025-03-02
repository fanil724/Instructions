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
                <div class="card" class="col-sm" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $instruction->title }}</h5>
                        <p class="card-text"> {{$instruction->description}} </p>
                        <div class="row" style="width: 20rem;">
                            <div class="col">
                                <a href="{{ route('admin.instructions.show', $instruction) }}">
                                    <img class="hvr-pulse" src="{{ asset('storage/icon/read.png') }}" alt="прочитать"
                                        title="прочитать" width="32">
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{ route('download', $instruction) }}">
                                    <img class=" hvr-pulse" src="{{ asset('storage/icon/download.png') }}" alt="скачать"
                                        title="скачать" width="32"></a>
                            </div>
                            <div class="col">
                                <form action="{{ route('admin.instructions.destroy', $instruction) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        style="border: medium none;   background-image: none;   background: transparent;">
                                        <img class="hvr-pulse" src=" {{ asset('storage/icon/delete.png') }}" alt="удалить"
                                            title="удалить" width="32"></button>
                                </form>
                            </div>
                            <div class="col">
                                <a href="{{ route('admin.instructions.edit', $instruction) }}">
                                    <img class="hvr-pulse" src="{{ asset('storage/icon/edit.png') }}" alt="изменить"
                                        title="изменить" width="32">
                                </a>
                            </div>
                            <dib class="col">
                                <a href="{{ route('admin.instructions.addInstruktion', $instruction->id) }}"><img
                                        class="hvr-pulse" src="{{ asset('storage/icon/add.png') }}"
                                        alt="добавить инструкцию после проверки" title="добавить инструкцию после проверки"
                                        width="32"></a>
                            </dib>
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