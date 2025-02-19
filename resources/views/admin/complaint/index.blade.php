@extends('layouts.app')

@section('title', 'Жалобы')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h2>Жалобы на проверку</h2>
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <a href="{{ route('admin.complaint.all') }}" class=" btn btn-primary">
                        Все жалобы
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row justify-content-center">
            @include('parts.messages')
            @forelse ($comInstrukts as $comInstrukt)
                <div class="card" class="col-sm" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comInstrukt->title }}</h5>
                        <p class="card-text"> {{$comInstrukt->description}} </p>
                        <div class="form-check">
                            <input class="form-check-input checkBlock" type="checkbox" id="flexCheckDefault" name="status"
                                @checked($comInstrukt->status)>
                            <label class="form-check-label" for="flexCheckDefault">
                                Обработанные
                            </label>
                        </div>
                        <a href="{{ route('admin.complaint.show', $comInstrukt) }}" class="btn btn-primary">Прочитать </a>
                    </div>
                </div>
            @empty
                <p>Нет жалоб</p>
            @endforelse
            {{ $comInstrukts->links() }}
        </div>
    </div>
@endsection