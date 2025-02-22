@extends('layouts.app')

@section('title', 'Пользователь')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="justify-content-center">
        <div class="container ">
            @include('parts.messages')
            <div class="card" style="width: 56rem;">
                <div class="card-body">
                    <h5 class="card-title">Имя пользователя: {{ $user->name }}</h5>
                    <p class="card-text">Почта: {{$user->email}}</p>

                    <p class="card-text">Жалобы:</p>
                    @forelse ($user->complaints as $complaint)
                        <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            href="{{ route('admin.complaint.show', $complaint->id) }}">
                            <p class="card-text">{{$complaint->title}}</p>
                        </a>
                    @empty
                        <p class="card-text">Нет жалоб</p>
                    @endforelse
                    <br>
                    <p class="card-text">Инструкции:</p>
                    @forelse ($user->instructions as $instruction)
                        <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            href="{{ route('admin.instructions.show', $instruction) }}">
                            <p class="card-text">{{$instruction->title}}</p>
                        </a>
                    @empty
                        <p class="card-text">Нет инструкции</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection