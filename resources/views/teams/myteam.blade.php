@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / Team / <a href="/teams/{{$myTeam->id}}"
        class="no-underline hover:underline text-blue-500">{{$myTeam->name}}</a></span>
</section>
<div class="container mt-12 ml-12">
     @if (session('leave'))
                <div v-show="alert" class="mt-1 bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative mb-2" v-on:click="hideAlert" role="alert">
                        <strong class="font-bold">Hold up!</strong>
                        <span class="block sm:inline">{{ session('leave') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-orange-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>

            @elseif (session('scrim'))
            <div v-show="alert" class="mt-1 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" v-on:click="hideAlert" role="alert">
                <strong class="font-bold">Ops!</strong>
                <span class="block sm:inline">{{ session('scrim') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            @elseif(session('kick'))
            <div v-show="alert" class="mt-1 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" v-on:click="hideAlert" role="alert">
                <strong class="font-bold">Ops!</strong>
                <span class="block sm:inline">{{ session('kick') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif
    <p class="ml-1 pb-4 text-2xl font-bold text-purple-600 uppercase">Team Dashboard</p>
    <div class="flex">
        <div class="w-2/5">
            <div class="flex flex-col bg-dark-100 shadow-lg rounded-lg mr-4">
                <div class="w-full px-10 bg-purple-700   relative text-center pb-1">
                        <span class="text-white font-mono font-semibold text-2xl capitalize text-center">Team {{$myTeam->name}}</span>
                        @if(auth()->user()->id == $myTeam->captain_id)
                        <i class="material-icons cursor-pointer absolute ml-16 mb-1 text-white md-48 right-0"  v-click-outside="hides" v-on:click="dropTeam">
                                more_horiz
                                </i>

                            <div v-show="team" id="dropdown" class="absolute rounded shadow right-0  bg-content text-white w-4/12 font-mono">
                                @if($myTeam->scrim == false)
                                <a href="/teams/scrim/{{ $myTeam->id }}" class="block text-default py-2 px-4 no-underline hover:underline
                                    text-md leading-loose ml-1 my-1 hover:bg-dark-100"
                                role="button" >Ready for scrim</a>
                            @else
                                <a href="/teams/notScrim/{{ $myTeam->id }}" class="block text-default py-2 px-4 no-underline hover:underline
                                    text-md leading-loose ml-1 my-1 hover:bg-dark-100"
                                role="button" >Not Ready for scrim</a>
                                <a href="/scrims-schedule" class="block text-default py-2 px-4 no-underline hover:underline
                                    text-md leading-loose ml-1 my-1 hover:bg-dark-100"
                                role="button" >Scrim list</a>
                            @endif
                                    <a href="/teams/{{$myTeam->id}}/edit" class="block text-default py-2 px-4 no-underline hover:underline
                                        text-md leading-loose ml-1 my-1 hover:bg-dark-100">Edit team profile</a>

                                    <a @click.prevent="deleteTeam({{ $myTeam->id }})" class="block text-default py-2 px-4 no-underline hover:underline
                                      text-md leading-loose ml-1 my-1 hover:bg-dark-100 cursor-pointer">Delete</a>

                                </div>
                            @endif
                </div>

                <div class="flex justify-center my-2">
                        <img src="{{  asset('storage/pics/' . $myTeam->image) }}" alt="" class=" rounded-sm w-3/5">
                </div>

                <div class="w-full px-10 bg-purple-700">
                        <p class="font-semibold text-xl capitalize text-center text-white font-mono">Team Information</p>
                </div>
                <div class="flex flex-col  items-center mt-2 mx-10 mb-2 py-2 text-white font-mono">
                    <p class="text-center"><span class="font-semibold">City:</span> {{$myTeam->area}}</p>
                    <p class="text-center"><span class="font-semibold">State:</span> {{$myTeam->state}}</p>
                    <p class="text-center"><span class="font-semibold">Captain:</span>
                        <a href="/players/{{$captain->accounts->dota_id}}" class="no-underline hover:underline text-blue-500">{{$captain->name}}</a></p>
                    <p class="text-center"><span class="font-semibold">Main Sponsor:</span>
                        @if($myTeam->sponsor == null)
                        None
                        @else
                        {{$myTeam->sponsor}}
                        @endif
                        </p>
                <p class="text-center"><span class="font-semibold">Description:</span> {{$myTeam->description}}</p>
                    @if($myTeam->scrim == true)
                    <p class="text-center"><span class="font-semibold">Scrim:</span> Ready</p>
                    @else
                    <p class="text-center"><span class="font-semibold">Scrim:</span> Not Ready</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="w-auto rounded-lg">
            <div class="flex flex-col justify-content bg-dark-100 shadow-lg ml-4 font-mono text-white">
                    <div class="bg-purple-700 py-2">
                            <p class="text-white font-semibold text-2xl text-center">Player Roster</p>
                        </div>
                        <div>
                                <table class="border-collapse w-full">
                                        <thead class="text-gray-4 border-b border-gray-500">
                                            <th class="capitalize py-4 text-center">ID</th>
                                            <th class="capitalize py-4 text-center">Name</th>
                                            <th class="capitalize py-4 text-center">Position</th>
                                            <th class="capitalize py-4 text-center">Join Date</th>
                                            <th class="capitalize py-4 "></th>
                                        </thead>
                                        <tbody class="text-center">
                                        @foreach($teamMembers as $teamMember)

                                        <tr class="hover:bg-content border-b border-gray-500 font-semibold">
                                        <td class="py-4 px-6 ">{{$teamMember->accounts->steam_name}}</td>
                                        <td class="py-4 px-6  capitalize">{{$teamMember->name}}</td>
                                        @if($teamMember->knowledge()->exists() != false)
                                        <td class="py-4 px-6 capitalize">{{$teamMember->knowledge->mainRole()}}</td>
                                        @else
                                        <td class="py-4 px-6">Unknown</td>
                                        @endif
                                        @foreach($teamMember->team as $t)
                                        <td class="py-4 px-6 ">{{$t->pivot->created_at->format('d-m-Y')}}</td>

                                        @endforeach
                                        <td class="py-4 px-6  flex">
                                            <a href="{{ url('/players/' . $teamMember->accounts->dota_id) }}" v-tooltip.top="'View Player'">
                                                <i class="material-icons text-indigo-600 cursor-pointer md-48 hover:text-indigo-800">
                                                search
                                                </i>
                                            </a>
                                            @if(auth()->user()->id == $teamMember->id and auth()->user()->id != $myTeam->captain_id)
                                            <a href="/leave/{{ $myTeam->id }}" @click.prevent="leaveTeam({{ $myTeam->id }})" v-tooltip.top="'Leave Team'"><i class="material-icons  text-indigo-600 cursor-pointer md-48 hover:text-indigo-800">
                                            exit_to_app
                                            </i>
                                            </a>
                                            @endif
                                            @if(auth()->user()->id == $myTeam->captain_id and auth()->user()->id != $teamMember->id)
                                        <a href="/kick/{{ $teamMember->id }}/team/{{ $myTeam->id}}" @click.prevent="kickPlayer({{ $teamMember->id }},{{ $myTeam->id}})"  v-tooltip.top="'Kick Player'"><i class="material-icons text-indigo-600 cursor-pointer md-48 hover:text-indigo-800">
                                                    close
                                                    </i></a>
                                            @endif

                                        </td>
                                        </tr>
                                        @endforeach

                                        </tbody>

                                    </table>

                        </div>

            </div>

            <v-dialog/>


        </div>


    </div>
</div>
@endsection
