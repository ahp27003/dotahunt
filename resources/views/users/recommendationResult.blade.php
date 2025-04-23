@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
        <span class="italic text-sm">Home / Recomendation / Search / Result</a></span>
    </section>
    <div class="container mx-auto mt-12 font-mono">
            <div class="flex">
            <div class="w-5/6 ml-16">
                <div class="flex justify-between">
                        <p class="text-2xl  ml-1 font-bold  pb-6 capitalize text-white">Results</p>
                        <a href="/players/recommendation" class="btn-indigo
                            font-semibold py-1 px-3 border border-indigo-800 hover:border-transparent rounded-lg shadow-md text-md
                            flex items-center leading-loose my-2"><i class="material-icons mr-1">
                                    search</i>Search again</a>
                </div>
                    <div class="bg-dark-100 shadow-lg text-center rounded-lg px-4 pb-6 pt-5">
                        <table class="border-collapse w-full">
                            <thead class="text-gray-300 border-b border-gray-600">
                                <th class="capitalize py-4 ">Name</th>
                                <th class="capitalize py-4 ">Rank</th>
                                <th class="capitalize py-4 ">Main Role</th>
                                <th class="capitalize py-4 ">Tournament</th>
                                <th class="capitalize py-4 ">Experience</th>
                                <th class="capitalize py-4 ">Team</th>
                                <th class="capitalize py-4 "></th>
                            </thead>
                            <tbody class="text-center">
                                @foreach($result as $player)
                                <tr class="hover:bg-content text-white  border-b border-gray-600">
                                <td class="py-4 px-6 center flex flex-col items-center">
                                    @if($player->accounts['avatar_url'] == null)
                                    <img src="{{asset('img/default.svg')}}" alt="" class="rounded-full w-24 h-24">
                                    @else
                                    <img src="{{  $player->accounts['avatar_url']  }}" alt="" class="rounded-full w-24 h-auto">
                                    @endif
                                    {{$player->accounts['steam_name']}}</td>
                                <td class="py-4">
                                    @include('users.medal_rec')
                                </td>
                                <td class="py-4 px-6">{{$pos}}</td>
                                <td class="py-4 px-6 text-left">
                                        <ul class="list-disc">
                                @foreach($player->tournaments as $tour)
                                    @if($tour->status != 1)
                                    <li class="capitalize capitalize whitespace-no-wrap">{{$tour->name}}</li>
                                    @endif
                                @endforeach
                            </ul>
                                </td>
                                <td class="py-4 px-6">
                                    @if($player->achievements()->exists() == true)
                                    Professional
                                    @else
                                    Beginner
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if($player->team()->exists() == true)
                                    {{$player->team[0]->name}}
                                    @endif
                                </td>
                                <td class="py-4 px-2">
                                    <div class="flex flex-col">
                                            <div>
                                                <a href="/players/{{$player->accounts['dota_id']}}"
                                                    class="mt-2 bg-pink-500 font-semibold text-white hover:bg-pink-600
                                                    py-2 px-4 border border-pink-500 hover:border-pink-600 rounded whitespace-no-wrap">View Profile</a>
                                                </div>
                                               <div class="mt-6">
                                                    <a href="#" @click.prevent="$modal.show('stats', { knowledge: {{$player->knowledge}} })"
                                                        class="bg-transparent hover:bg-pink-500 text-pink-400 font-semibold hover:text-white
                                                        py-2 px-4 border border-pink-500 hover:border-transparent rounded whitespace-no-wrap">View AVG Stats</a>
                                               </div>
                                    </div>

                                   </td>
                            </tr>
                                @endforeach

                            </tbody>

                        </table>
                        <stats-component></stats-component>
                    </div>

                </div>


            </div>
            </div>





{{-- <div class="container">
        <div class="row justify-content-center">
    @forelse($result as $player)


<div class="col-5">
    <div class="card text-center" >
            <div class="card-body">
                    <img src="{{  $player->accounts['avatar_url']  }}" class="rounded-circle mb-3" alt="...">
                    <h5 class="card-title text-center"> {{   $player->accounts['steam_name']  }}</h5>
                    @include('users.medal2')
            </div>
            <a href="{{ url('/players/' . $player->accounts['dota_id']) }}" class="btn btn-primary" role="button" >View</a>
          </div>
        </div>
        @empty
        <div class="col-10 text-center mt-4">
            <div class="alert alert-warning">
                <h1>There is no players that satisfy your input!</h1>
            </div>
        </div>
    @endforelse
</div>
</div> --}}
@endsection
