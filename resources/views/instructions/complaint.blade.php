@extends('layouts.app')

@section('title', ' Создать инструкцию')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        @include('parts.messages')

        <form action="{{ route('instructions.complaint.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="text" hidden readonly class="form-control" id="exampleFormControlInput1" name="instruction_id"
                value="{{$instruction_id}}">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Наименование жалобы</label>
                <input type="text" class="form-control @error('title')  is-invalid @enderror" id="exampleFormControlInput1"
                    name="title" value="{{old('title')}}">
                @error('title')
                    <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Описание жалобы</label>
                <textarea class="form-control @error('dexription') is-invalid @enderror" id="exampleFormControlTextarea1"
                    rows="3" name="dexription">{{ old('dexription') }}</textarea>
                @error('dexription')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary m-3">Отправить жалобу</button>
        </form>
    </div>
@endsection