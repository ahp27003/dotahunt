@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / Notifications</span>
</section>
<div class="container mt-6">
    <div class="p-4">

        <p class=" text-center font-semibold text-purple-600 text-3xl border-b border-gray-600">Notifications Dashboard</p>

        <div class="flex flex-col items-center justify-center mt-3">
        @foreach (Auth::user()->unreadNotifications as $noti)
            @if( class_basename($noti->type) == "OfferTeam")

                <div class="flex flex-row justify-center bg-dark-100 text-white rounded my-2 py-2 shadow-lg w-8/12">
                        <div class="mr-12">
                                <i class="material-icons md-48 text-indigo-700">transfer_within_a_station</i>
                        </div>
                        <div class="border-r-2 border-gray-400 pr-10 mr-10">
                            <p class="text-xl font-bold">
                                    You received new offer!
                            </p>
                            <span class="text-md font-base">
                                <span class="font-bold text-purple-600"><a href="/teams/{{ $noti->data['team_id'] }}">Team {{ $noti->data['team_name'] }}</a></span> has sent you offer to join their team!
                            </span>
                        </div>
                        <div class="flex">
                            <div class="flex flex-col mr-2 cursor-pointer">
                                <a
                                href="/accept/{{ $noti->data['offer_id'] }}/notifications/{{$noti->id}}"
                                role="button" aria-pressed="true">
                                    <i class="material-icons md-48 text-green-600 hover:text-green-700">
                                    check
                                    </i>
                                    <p class="text-md font-medium">Accept</p>
                                </a>
                            </div>
                            <div class="flex flex-col ml-2 cursor-pointer">
                                <a href="/reject/{{ $noti->data['offer_id'] }}/notifications/{{$noti->id}}"
                                    role="button">
                                    <i class="material-icons md-48 text-red-600 hover:text-red-700">
                                        close
                                    </i>
                                </a>
                                <p class="text-md font-medium">Reject</p>
                            </div>
                        </div>
                </div>


            @elseif ( class_basename($noti->type) == "AcceptOffer")

                @if ($noti->data['offer_status'] == 'Accepted')
                    <div class="flex flex-row justify-center  bg-dark-100 text-white rounded my-2 py-2 shadow-lg w-8/12">
                        <div class="mr-12">
                                <i class="material-icons md-48 text-green-500">transfer_within_a_station</i>
                        </div>
                        <div class="border-r-2 border-gray-400 pr-10 mr-10 text-white">
                            <p class="text-xl font-bold">
                                    Offer Accepted!
                            </p>
                            <span class="text-md font-base">
                                <span class="font-bold text-purple-600"><a href="{{ url('/players/' . $noti->data['dota_id']) }}">
                                    {{ $noti->data['steam_name'] }}</a></span> has accepts your offer.
                            </span>
                        </div>
                        <div class="flex">

                            <div class="flex flex-col ml-2 cursor-pointer">
                                    <form action="/notifications/{{$noti->id}}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="close" ><i class="material-icons md-48 text-red-600 hover:text-red-700">
                                                close
                                            </i>
                                        </button>

                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            @elseif ( class_basename($noti->type) == "RejectOffer")
                @if ($noti->data['offer_status'] == 'Rejected')
                <div class="flex flex-row justify-center bg-dark-100 rounded-lg my-2 py-2 shadow-lg w-8/12 text-white">
                    <div class="mr-12">
                            <i class="material-icons md-48 text-red-500">transfer_within_a_station</i>
                    </div>
                    <div class="border-r-2 border-gray-400 pr-10 mr-10">
                        <p class="text-xl font-bold">
                                Offer Rejected!
                        </p>
                        <span class="text-md font-base">
                            <span class="font-bold text-purple-600"><a href="{{ url('/players/' . $noti->data['dota_id']) }}">
                                {{ $noti->data['steam_name'] }}</a></span> has rejects your offer.
                        </span>
                    </div>
                    <div class="flex">

                        <div class="flex flex-col ml-2 cursor-pointer">
                                <form action="/notifications/{{$noti->id}}" method="post">
                                    {{ method_field('DELETE') }}
                                    @csrf
                                    <button type="submit" class="close" ><i class="material-icons md-48 text-red-600 hover:text-red-700">
                                            close
                                        </i>
                                    </button>

                            </form>
                        </div>
                    </div>
                </div>


                @endif
            @endif
        @endforeach

        @foreach (Auth::user()->unreadNotifications as $noti)

            @if( class_basename($noti->type) == "OfferScrim")

                <div class="flex flex-row justify-center bg-dark-100 rounded-lg my-2 py-2 shadow-lg w-8/12 text-white">
                    <div class="mr-12">
                            <i class="material-icons md-48 text-indigo-700">sports_kabaddi</i>
                    </div>
                    <div class="border-r-2 border-gray-400 pr-10 mr-10">
                        <p class="text-xl font-bold">
                                You received new scrim invitation!
                        </p>
                        <span class="text-md font-base">
                            <span class="font-bold text-purple-600"><a href="/teams/{{$noti->data['team_id']}}"> Team {{ $noti->data['team_name'] }}</a>
                            </span> schedule a scrim on {{ $noti->data['offer_date'] }} at {{ $noti->data['offer_time'] }}
                            <p class=" text-sm"><span class="text-gray-500 font-semibold">Notes: </span> <span class="font-medium italic">{{ $noti->data['notes'] }}</span></p>
                        </span>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col mr-2 cursor-pointer">
                            <a
                            href="/scrims/accept/{{ $noti->data['offer_id'] }}/notifications/{{ $noti->id}}"
                            role="button" aria-pressed="true">
                                <i class="material-icons md-48 text-green-600 hover:text-green-700">
                                check
                                </i>
                                <p class="text-md font-medium">Accept</p>
                            </a>
                        </div>
                        <div class="flex flex-col ml-2 cursor-pointer">
                            <a href="/scrims/reject/{{ $noti->data['offer_id'] }}/notifications/{{ $noti->id}}"
                                role="button">
                                <i class="material-icons md-48 text-red-600 hover:text-red-700">
                                    close
                                </i>
                            </a>
                            <p class="text-md font-medium">Reject</p>
                        </div>
                    </div>
                </div>

            @elseif( class_basename($noti->type) == "AcceptScrim")

                @if ($noti->data['offer_status'] == 'Accepted')
                    <div class="flex flex-row justify-center bg-dark-100 text-white rounded-lg my-2 py-2 shadow-lg w-8/12">
                        <div class="mr-12">
                                <i class="material-icons md-48 text-green-500">sports_kabaddi</i>
                        </div>
                        <div class="border-r-2 border-gray-400 pr-10 mr-10">
                            <p class="text-xl font-bold">
                                    Scrim Invitation Accepted!
                            </p>
                            <span class="text-md font-base">
                                <span class="font-bold text-purple-600"><a href="/teams/{{ $noti->data['team_id'] }}">Team {{ $noti->data['team_name']}}</a> </span> has aggreed to <a class="font-bold text-purple-600"
                                href="{{url('/scrims-schedule')}}">scrim</a>
                                with you on {{ $noti->data['offer_date'] }} at {{ $noti->data['offer_time'] }}
                            </span>
                        </div>
                        <div class="flex">

                            <div class="flex flex-col ml-2 cursor-pointer">
                                    <form action="/notifications/{{$noti->id}}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="close" ><i class="material-icons md-48 text-red-600 hover:text-red-700">
                                                close
                                            </i>
                                        </button>

                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            @elseif( class_basename($noti->type) == "RejectScrim")
                @if ($noti->data['offer_status'] == 'Rejected')

                <div class="flex flex-row justify-center bg-dark-100 text-white rounded-lg my-2 py-2 shadow-lg w-8/12">
                    <div class="mr-12">
                            <i class="material-icons md-48 text-red-500">sports_kabaddi</i>
                    </div>
                    <div class="border-r-2 border-gray-400 pr-10 mr-10">
                        <p class="text-xl font-bold">
                                Scrim Invitation Rejected!
                        </p>
                        <span class="text-md font-base">
                            <span class="font-bold text-purple-600"><a href="/teams/{{ $noti->data['team_id'] }}">Team {{ $noti->data['team_name']}}</a> </span> has rejected to <a class="font-bold text-purple-600"
                            href="{{url('/scrims-schedule')}}">scrim</a>
                            with you on {{ $noti->data['offer_date'] }} at {{ $noti->data['offer_time'] }}
                        </span>
                    </div>
                    <div class="flex">

                        <div class="flex flex-col ml-2 cursor-pointer">
                                <form action="/notifications/{{$noti->id}}" method="post">
                                    {{ method_field('DELETE') }}
                                    @csrf
                                    <button type="submit" class="close" ><i class="material-icons md-48 text-red-600 hover:text-red-700">
                                            close
                                        </i>
                                    </button>

                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @elseif( class_basename($noti->type) == "KickPlayer")
                <div class="flex flex-row justify-center bg-dark-100 text-white rounded-lg my-2 py-2 shadow-lg w-8/12">
                    <div class="mr-12">
                            <i class="material-icons md-48 text-red-500">block</i>
                    </div>
                    <div class="border-r-2 border-gray-400 pr-10 mr-10">
                        <p class="text-xl font-bold">
                                You has been Kicked!
                        </p>
                        <span class="text-md font-base">
                            <span class="font-bold text-purple-600"><a href="/teams/{{ $noti->data['team_id'] }}">Team {{ $noti->data['team_name']}}</a> </span> has kick you
                        </span>
                    </div>
                    <div class="flex">

                        <div class="flex flex-col ml-2 cursor-pointer">
                                <form action="/notifications/{{$noti->id}}" method="post">
                                    {{ method_field('DELETE') }}
                                    @csrf
                                    <button type="submit" class="close" ><i class="material-icons md-48 text-red-600 hover:text-red-700">
                                            close
                                        </i>
                                    </button>

                            </form>
                        </div>
                    </div>
                </div>


            @endif
        @endforeach

            @if (session('success'))
                <div v-show="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded  w-2/5 relative" v-on:click="hideAlert" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif

            @if (session('reject'))
                <div v-show="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded w-1/5 relative" v-on:click="hideAlert" role="alert">
                    <span class="block sm:inline">{{ session('reject') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif

            @if (session('error'))
            <div v-show="alert" class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded  w-3/5 relative" v-on:click="hideAlert" role="alert">
                <strong class="font-bold">Hold up!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-orange-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            @endif

        </div>

    </div>



</div>
@endsection

