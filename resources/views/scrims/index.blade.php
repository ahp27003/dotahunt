@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / <a href="/scrims" class="text-blue-500 hover:underline">Scrim</a> /  Available Team</span>
    </section>
    @if (session('captain'))
            <div v-show="alert" class="mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-on:click="hideAlert" role="alert">
                <strong class="font-bold">Ops!</strong>
                <span class="block sm:inline">{{ session('captain') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            @endif
            @if (session('scrim'))
            <div v-show="alert" class="mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-on:click="hideAlert" role="alert">
                <strong class="font-bold">Ops!</strong>
                <span class="block sm:inline">{{ session('scrim') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            @endif
    <div class="container ml-20 w-full mt-4 pt-3 pl-3">
        <p class="ml-3 text-2xl font-bold text-purple-600 uppercase">SCRIMS</p>
        <p class="pb-4 ml-3 text-md font-normal text-gray-600 italic">Find Dota 2 teams to practice together</p>
        <div class="flex">
        <div class="flex flex-wrap w-10/12">
        @forelse ($teams as $team)
                <div class="bg-dark-100 w-64 flex flex-col m-2 shadow-lg rounded-t-lg">
                    <a href="/teams/{{$team->id}}" class="text-white font-semibold cursor-pointer h-48">
                    <div class="flex p-4">
                        <img class="w-24 h-24 rounded-full" src="{{  asset('storage/pics/' . $team->image) }}" alt="">
                        <div class="ml-5">
                            <p class="font-semibold ml-1 text-lg tracking-wide uppercase">{{$team->name}}</p>
                            <p class="-mt-1 capitalize font-medium ml-1 text-gray-400 text-md">{{$team->area}}</p>
                            <p class="italic ml-1 text-gray-400 text-sm">{{$team->description}}</p>
                        </div>
                    </div></a>
                    <div class="flex flex-col justify-center py-3 border-b border-t border-gray-600">
                        <div><p class="text-center font-medium text-indigo-400 mb-1">Team Members</p></div>
                        <div class="flex justify-center">
                            @foreach($team->users as $user)
                            {{-- {{dd($user->accounts->avatar_url)}} --}}
                                @if($user->accounts->avatar_url == null)
                                    <img class="w-12 h-12 rounded-full border-2 border-white relative -ml-2" src="{{asset('img/default.svg')}}">
                                @else
                                    <img class="w-12 h-12 rounded-full border-2 border-white relative -ml-2" src="{{$user->accounts->avatar_url}}">
                                @endif
                                {{-- <p>{{$user->name}}</p> --}}
                            @endforeach
                        </div>

                    </div>
                    <div class="text-center py-4  bg-purple-800 hover:bg-indigo-800">
                        <a href="/scrims/add/{{$team->id}}" class="text-white font-semibold cursor-pointer">Send Scrim Invite</a>
                    </div>
                    {{-- <div class="text-center py-4  bg-indigo-700 hover:bg-indigo-800">
                        <a href="/teams/{{$team->id}}" class="text-white font-semibold cursor-pointer">View Details</a>
                    </div> --}}
                </div>

                @empty
                <div class="container ml-20 mt-12 max-w-6xl mr-2">
                    <div class="bg-purple-100 border-t border-b border-purple-500 text-purple-500 px-4 py-3 text-center bg-dark-100" role="alert">
                        <p class="font-bold text-lg">Currently there is no team available to scrim</p>
                        <p class="text-md">Please come back later.</p>
                    </div>

                </div>
        @endforelse

        </div>

        <div class="w-1/4 mt-12 ml-4">

            <a href="/scrims-schedule" v-tooltip.bottom="'View Scrim list Schedule'" class="w-40 flex items-center px-2 py-2 font-semibold leading-loose whitespace-no-wrap border border-indigo-800 rounded-lg shadow-md btn-indigo hover:border-transparent text-md"><i class="mr-1 material-icons">
                date_range</i>Scrim Schedule</a>
        </div>
    </div>
</div>
@endsection
