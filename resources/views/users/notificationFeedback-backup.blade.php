@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notification center</div>

                <div class="card" >





                    <div class="card-body">
                      <h5 class="card-title text-center"><b>Notification center</b> </h5>
                      <p class="card-text"></p>
                    </div>

                    {{-- @foreach (Auth::user()->unreadNotifications as $noti)

                        @foreach ($offers as $offer)

                        @if ($offer->status == 'pending')
                            <li>Offer from <a href="/teams/{{$offer->team->id}}"> Team {{ $offer->team->name }} </a>  <a
                            href="/accept/{{ $offer->id }}/notifications/{{$noti->id}}" class="btn btn-primary btn-lg active"
                                role="button" aria-pressed="true">Accept</a>
                                <a href="/reject/{{ $offer->id }}" class="btn btn-danger btn-lg active"
                                role="button" aria-pressed="true">Reject</a>
                            </li>


                        @endif

                        @endforeach --}}


                        @if($myOffers != null)
                        @foreach (Auth::user()->unreadNotifications as $noti)




                                @if ($noti->data['offer_status'] == 'Accepted')

                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>
                                            <a href="{{ url('/players/' . $noti->data['dota_id']) }}">
                                            {{ $noti->data['steam_name'] }}</a>
                                        </strong> has accepts your offer

                                    <form action="/notifications/{{$noti->id}}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf

                                        <button type="submit" class="close" > <span aria-hidden="true">&times;</span>
                                        </button>
                                    </form>
                                    </div>

                                @elseif ($noti->data['offer_status'] == 'Rejected')


                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>
                                                <a href="{{ url('/players/' . $noti->data['dota_id']) }}">
                                                {{ $noti->data['steam_name'] }}</a>
                                            </strong> has rejects your offer

                                        <form action="/notifications/{{$noti->id}}" method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf

                                            <button type="submit" class="close" > <span aria-hidden="true">&times;</span>
                                            </button>
                                        </form>
                                        </div>
                                @endif

                            @endforeach
                    @endif


                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session('success') }}</li>
                        </ul>
                    </div>
                @endif
                @if (session('reject'))
                <div class="alert alert-primary">
                    <ul>
                        <li>{{ session('reject') }}</li>
                    </ul>
                </div>
            @endif
                  </div>

            </div>
        </div>
    </div>
</div>
@endsection
   {{-- {{ dd($dotas->accounts->toArray())}} --}}

                    {{-- {{ dd($dotas->name)}} --}}
