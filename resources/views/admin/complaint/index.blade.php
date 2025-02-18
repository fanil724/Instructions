@extends('layouts.app')

@section('title', 'Жалобы')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container justify-content-center">
        <div class="page-header">
            <h2>Жалобы на проверку</h2>

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