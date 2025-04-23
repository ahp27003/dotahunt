@extends('layouts.admin')

@section('content')
<div class="container">
        @if (session('interest'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('interest') }}</li>
            </ul>
        </div>
        @elseif(session('notInterest'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('notInterest') }}</li>
            </ul>
        </div>
    @endif
    <div class="row justify-content-center">


        @foreach ($tournament as $tour)


        <div class="col-md-4 mb-4">
            <div class="card text-white bg-secondary">
            <div class="card-header">{{ $tour->name }}</div>

                <div class="card text-white bg-secondary" >
                    <div class="card-body">
                        <img src="{{  asset('storage/tour/' . $tour->image) }}" class="img-fluid mb-3">
                        <h5 class="card-title text-center"><b>Prize Pool:</b> RM {{ $tour->prizepool }}</h5>
                        <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item bg-secondary"><b>Organizer:</b> {{ $tour->organizer }}</li>
                        <li class="list-group-item bg-secondary"><b>Date:</b> {{ $tour->start_date }} until {{ $tour->end_date }}</li>
                        <li class="list-group-item bg-secondary"><b>Venu:</b> {{ $tour->venue }}</li>
                        <li class="list-group-item bg-secondary"><b>State:</b> {{ $tour->state }}  </li>
                        @if($tour->status == 1)
                        <li class="list-group-item bg-secondary"><b>Status: </b>Ended</li>
                        @endif
                    </ul>
                    <a href="/admin/tournaments/{{ $tour->id }}/edit" class="btn btn-warning" role="button" >Update</a>
                    @if($tour->status == 0)
                    <a href="/admin/tournaments/{{ $tour->id }}/status" class="btn btn-primary" role="button" >Complete or not</a>
                    @endif
                  </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
