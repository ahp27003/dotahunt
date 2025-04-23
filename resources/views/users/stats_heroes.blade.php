@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide mb-8">
        <span class="italic text-sm">Home / Overview / <a href="{{url('/players/' . $fetchPlayers->dota_id)}}"
            class="no-underline hover:underline text-blue-500">{{$fetchPlayers->user->name}}</a> / Heroes</span>
        </section>

        <!--topsection-->
        <div class="bg-dark-100 container mt-4 mx-auto p-8 rounded-lg w-full font-mono">
            <div class="flex">
                <div class="flex w-3/4">
                    <div class="flex">
                        <div>
                            <img src="{{  $fetchPlayers->avatar_url  }}" class="rounded-full shadow-lg w-40 border-purple-700 border-2" alt="...">
                        </div>
                        <div class="ml-6">
                        <p class="text-lg font-bold text-white">{{  $fetchPlayers->steam_name  }}</p>
                        <p class="text-md font-bold text-white">Wins: {{  $fetchPlayers->win_lose['win']  }}</p>
                        <p class="text-md font-bold text-white">Losses: {{  $fetchPlayers->win_lose['lose']  }}</p>
                        <p class="text-md font-bold text-white">Winrate: {{  round(($fetchPlayers->win_lose['win'] / ($fetchPlayers->win_lose['win'] +
                                $fetchPlayers->win_lose['lose'])) * 100, 2)  }} %</p>
                                 @if($fetchPlayers->user->knowledge != null)
                                 <p class="text-lg font-semibold text-white capitalize">Main Roles: {{$fetchPlayers->user->knowledge->mainRole()}}</p>
                                 <div class="mt-3">
                                     <a href="#" @click.prevent="$modal.show('stats', { knowledge: {{$fetchPlayers->user->knowledge}} })"
                                         class="bg-transparent hover:bg-pink-500 text-pink-400 font-semibold hover:text-white
                                         py-2 px-4 border border-pink-500 hover:border-transparent rounded whitespace-no-wrap">View AVG Stats</a>
                                         <stats-component></stats-component>
                                 </div>
                                 @endif
                        </div>
                    </div>


                </div>
                <div class="w-1/4">
                    @include('users.medal')</div>

                </div>
                <div class="border-b border-gray-600 flex justify-center mt-4 pb-4">
                        <a href="{{ url('/players/' . $fetchPlayers->dota_id ) }}/stats" class="text-md font-medium mr-20 hover:underline
                         {{Request::is('players/'.$fetchPlayers->dota_id.'/stats') ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Overview</a>
                        <a href="{{ url('/players/' . $fetchPlayers->dota_id ) }}/heroes" class="text-md font-medium mx-10 hover:underline
                        {{Request::is('players/'.$fetchPlayers->dota_id.'/heroes') ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Heroes</a>
                        <a href="{{ url('/players/' . $fetchPlayers->dota_id ) }}/totals" class="text-md font-medium ml-20 hover:underline
                        {{Request::is('players/'.$fetchPlayers->dota_id.'/totals') ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Totals</a>
                    </div>
                </div>
                <div class="container mx-auto w-full mt-4 px-5 font-mono">
                        <p class="text-2xl font-semibold text-indigo-700">Heroes Played</p>
                        <div class="bg-dark-100 rounded-lg  p-4">
                            <table class="border-collapse w-full">
                                    <thead class="text-white">
                                        <tr>
                                            <th class="text-left capitalize border-b border-gray-500 py-4">Hero</th>
                                            <th class="text-left capitalize border-b border-gray-500 py-4">Matches Played</th>
                                            <th class="text-left capitalize border-b border-gray-500 py-4">Win Rate %</th>
                                            <th class="text-left capitalize border-b border-gray-500 py-4">Win With %</th>
                                            <th class="text-left capitalize border-b border-gray-500 py-4">Win Against %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @if ($pageHeroes != null)
                                            @foreach ($pageHeroes as $recent)
                                                      <tr  class="py-4 px-6 border-b border-gray-500 hover:bg-content text-left text-white">
                                                        <td class="py-2"> @include('users.heroes')</td>
                                                        <td class="py-2"> {{$recent['games']}} ({{$recent['win']}} won)</td>
                                                        <td class="py-2"> @php
                                                                if($recent['games'] != 0){
                                                                    echo (round(($recent['win'] / $recent['games']) * 100, 1));
                                                                }
                                                                else {
                                                                    echo "0";
                                                                }
                                                            @endphp
                                                            </td>
                                                        <td class="py-2">  @php
                                                                if($recent['with_games'] != 0){
                                                                    echo (round(($recent['with_win'] / $recent['with_games']) * 100, 1));
                                                                    echo "(" . $recent['with_win'] . "/" . $recent['with_games'] . ")";
                                                                }
                                                                else {
                                                                    echo "0";
                                                                }
                                                            @endphp
                                                            </td>
                                                        <td class="py-2"> @php
                                                                if($recent['against_games'] != 0){
                                                                    echo (round(($recent['against_win'] / $recent['against_games']) * 100, 1));
                                                                    echo "(" . $recent['against_win'] . "/" . $recent['against_games'] . ")";
                                                                }
                                                                else {
                                                                    echo "0";
                                                                }
                                                            @endphp</td>
                                                        </tr>
                                        @endforeach

                                        @endif
                                    </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $pageHeroes->links() }}
                            </div>
                        </div>
                    </div>

@endsection
