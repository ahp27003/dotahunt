@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / Player / List</a></span>
</section>
<div class="container mt-12">
        <div class="flex">
        <div class="w-5/6 ml-16 font-mono">
            <p class="text-2xl  ml-1 font-bold  pb-6 text-purple-600 uppercase">List of registered player</p>
                <div class="bg-dark-100 shadow-lg text-center rounded-lg px-4 pb-6 pt-5">
                    <table class="border-collapse w-full">
                        <thead class="text-white tracking-wide text-lg border-b border-gray-600">
                            <th class="capitalize py-4 ">Name</th>
                            <th class="capitalize py-4 ">Rank</th>
                            <th class="capitalize py-4 ">Main Role</th>
                            <th class="capitalize py-4 ">Tournament</th>
                            <th class="capitalize py-4 ">Experience</th>
                            <th class="capitalize py-4 ">Team</th>
                            <th class="capitalize py-4 "></th>
                        </thead>
                        <tbody class="text-center text-white font-semibold">
                            @foreach($pagePlayers as $player)
                                <tr class="hover:bg-content border-b border-gray-600">
                                <td class="flex flex-col items-center px-6 py-4">
                                    @if($player->accounts['avatar_url'] == null)
                                    <img src="{{asset('img/default.svg')}}" alt="" class="rounded-full w-24 h-24">
                                    @else
                                    <img src="{{  $player->accounts['avatar_url']  }}" alt="" class="rounded-full w-24 h-24">
                                    @endif
                                    {{$player->accounts['steam_name']}}</td>
                                <td class="py-4">@include('users.medal_rec')</td>
                                @if($player->knowledge()->exists() != false)
                                <td class="py-4 px-6 capitalize">{{$player->knowledge->mainRole()}}</td>
                                @else
                                <td class="py-4 px-6">Unknown</td>
                                @endif
                                <td class="py-4 px-6">
                                @forelse($player->tournaments as $tour)
                                    @if($tour->status != 1)
                                    <li class="capitalize">{{$tour->name}}</li>
                                    @endif
                                @empty
                                <p>None</p>
                                @endforelse
                                </td>
                                @if($player->achievements()->exists() != false)
                                <td class="py-4 px-6">Professional</td>
                                @else
                                <td class="py-4 px-6">Beginner</td>
                                @endif
                                @if($player->team()->exists() != false)
                                <td class="py-4 px-6">{{$player->team[0]->name}}</td>
                                @else
                                <td class="py-4 px-6">None</td>
                                @endif
                                <td class="py-4 px-6"><a href="/players/{{$player->accounts['dota_id']}}" class="inline-block  rounded px-3 py-1
                                    text-md font-semibold text-white mt-3 text-center btn-indigo tracking-wide border-2 border-purple-800">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="mt-4 -mb-1">
                            {{ $pagePlayers->links() }}


                    </div>
                </div>

            </div>


        </div>
        </div>
@endsection
{{-- <div class="container">
        <div class="row justify-content-center">
    @foreach ($players as $player)


<div class="col-5">
    <div class="card text-center" >
            <div class="card-body">
                    <img src="{{  $player->accounts['avatar_url']  }}" class="rounded-circle mb-3" alt="...">
                    <h5 class="card-title text-center"> {{   $player->accounts['steam_name']  }}</h5>
                    @include('users.medal2')
                <p class="card-text"></p>
            </div>
            <a href="{{ url('/players/' . $player->accounts['dota_id']) }}" class="btn btn-primary" role="button" >View</a>
          </div>
        </div>
    @endforeach
</div>
</div> --}}

