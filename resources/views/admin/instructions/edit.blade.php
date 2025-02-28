@extends('layouts.app')

@section('title', ' Создать инструкцию')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        @include('parts.messages')
        <form action="{{ route('admin.instructions.update', $instruction) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Наименование инструкции</label>
                <input type="text" class="form-control @error('title')  is-invalid @enderror" id="exampleFormControlInput1"
                    name="title" value="{{$instruction->title}}">
                @error('title')
                    <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Описание инструкции</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1"
                    rows="3" name="description">{{$instruction->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <input type="file" class="form-control" name="file" id="file">
                @error('file')
                    <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>

                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary m-3">Обновить инструкцию</button>
        </form>
    </div>
@endsection