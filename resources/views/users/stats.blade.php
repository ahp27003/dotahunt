@extends('layouts.app')

@section('content')
    <section id="breadcrumb" class="pt-2 ml-4 mb-8">
    <span class="text-sm italic font-medium tracking-wide text-white">Home / Overview / <a href="{{url('/players/' . $fetchPlayers->dota_id)}}"
        class="text-blue-500 no-underline hover:underline">{{$fetchPlayers->user->name}}</a></span>
    </section>

    <!--topsection-->
        <div class="container w-full p-8 mx-auto mt-4 font-mono rounded-lg bg-dark-100">
            <div class="flex">
                <div class="flex w-3/4">
                    <div class="flex">
                        <div>
                            <img src="{{  $fetchPlayers->avatar_url  }}" class="w-40 border-2 border-purple-700 rounded-full shadow-lg" alt="...">
                        </div>
                        <div class="ml-6">
                        <p class="text-lg font-bold text-white">{{  $fetchPlayers->steam_name  }}</p>
                        <p class="font-bold text-white text-md">Wins: {{  $fetchPlayers->win_lose['win']  }}</p>
                        <p class="font-bold text-white text-md">Losses: {{  $fetchPlayers->win_lose['lose']  }}</p>
                        <p class="font-bold text-white text-md">Winrate: {{  round(($fetchPlayers->win_lose['win'] / ($fetchPlayers->win_lose['win'] +
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
                <div class="flex justify-center pb-4 mt-4 border-b border-gray-600">
                        <a href="{{ url('/players/' . $fetchPlayers->dota_id ) }}/stats" class="text-md font-medium mr-20 hover:underline
                         {{Request::is('players/'.$fetchPlayers->dota_id.'/stats') ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Overview</a>
                        <a href="{{ url('/players/' . $fetchPlayers->dota_id ) }}/heroes" class="text-md font-medium mx-10 hover:underline
                        {{Request::is('players/'.$fetchPlayers->dota_id.'/heroes') ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Heroes</a>
                        <a href="{{ url('/players/' . $fetchPlayers->dota_id ) }}/totals" class="text-md font-medium ml-20 hover:underline
                        {{Request::is('players/'.$fetchPlayers->dota_id.'/totals') ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Totals</a>
                    </div>
                </div>
            <!--stats section-->
            <div class="container w-full mx-auto mt-4 font-mono">
                <p class="text-2xl font-semibold text-purple-600">Recent Matches</p>
                <div class="p-4 rounded-lg bg-dark-100">
                    <table class="w-full border-collapse">
                            <thead class="text-white">
                                <tr>
                                    <th class="py-4 text-left capitalize border-b border-gray-500">Hero</th>
                                    <th class="py-4 text-left capitalize border-b border-gray-500">Date</th>
                                    <th class="py-4 text-left capitalize border-b border-gray-500">Result</th>
                                    <th class="py-4 text-left capitalize border-b border-gray-500">Game Mode</th>
                                    <th class="py-4 text-left capitalize border-b border-gray-500">Score (<span class="text-green-600">K</span>/
                                        <span class="text-red-600">D</span>/<span class="text-gray-600">A</span>)</th>
                                    <th class="py-4 text-left capitalize border-b border-gray-500">Duration</th>
                                    <th class="py-4 text-left capitalize border-b border-gray-500"></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @if ($pageStats != null)
                                    @foreach ($pageStats as $recent)
                                              <tr  class="px-6 py-4 text-white border-b border-gray-500 hover:bg-content">
                                                <td class="text-center"> @include('users.heroes') </td>
                                                <td><span v-tooltip.bottom="'{{ date('m/d/Y',$recent['start_time']) }}'">
                                                    {{
                                                        \Carbon\Carbon::createFromTimeStamp($recent['start_time'])->diffForHumans()
                                                        }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        if($recent['player_slot'] >= 0 && $recent['player_slot'] <= 127)
                                                            {
                                                                $position = 'Radiant';
                                                            }
                                                        else {
                                                            $position =  'Dire';
                                                        }
                                                        if($recent['radiant_win'] == true && $position == 'Radiant')
                                                            {
                                                                $result = 'Won Match';
                                                            }
                                                        elseif ($recent['radiant_win'] == false && $position == 'Dire') {
                                                                $result = 'Won Match';
                                                            }
                                                        else {
                                                                $result = 'Lost Match';
                                                            }
                                                    @endphp

                                                <a href="{{ url('matches/' . $recent['match_id']) }}"><p class="{{ $result == 'Won Match' ? 'text-green-500' : 'text-red-500' }} hover:underline font-semibold">
                                                    {{ $result}} </p></a>


                                                </td>
                                                <td> @include('users.gameMode')</td>
                                                <td class="font-semibold"><span class="text-green-600">{{ $recent['kills'] }}</span>/
                                                    <span class="text-red-600">{{ $recent['deaths'] }}</span>/<span class="text-gray-600">{{ $recent['assists'] }}</span></td>
                                                <td>@php
                                                        $minutes=$recent['duration'];
                                                        $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                                                        echo $hours;
                                                    @endphp
                                                    <br>
                                                   {{ $position }}
                                                </td>
                                                <td><a href="{{ url('matches/' . $recent['match_id']) }}"><i class="text-purple-600 cursor-pointer material-icons md-48">
                                                        pageview
                                                        </i></a></td>
                                                </tr>
                                @endforeach

                                @endif

                            </tbody>
                    </table>
                    <div class="p-2 mt-4">
                        {{ $pageStats->links() }}
                    </div>
                </div>
            </div>
@endsection
