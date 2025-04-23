@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 mb-8 text-white font-medium tracking-wide">
        <span class="italic text-sm">Home / Overview / <a href="{{url('/players/' . $fetchPlayers->dota_id)}}"
            class="no-underline hover:underline text-blue-500">{{$fetchPlayers->user->name}}</a> / Totals</span>
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

                <div class="container mx-auto w-full mt-4 font-mono">
                    <p class="text-2xl font-semibold text-indigo-700 text-center">All Matches</p>
                    <div class="flex flex-wrap rounded-lg p-4 justify-center">
                        @if ($statistics != null)
                            @foreach ($statistics->tot_score as $recent)
                            @if ($recent['field'] == 'kills')
                                <div class="mini-card">
                                    <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                            {{$recent['field']}}
                                    </div>
                                    <div class="font-semibold text-center text-lg">
                                        {{$recent['sum']}}
                                    </div>
                                </div>
                            @elseif($recent['field'] == 'deaths')
                            <div class="mini-card">
                                    <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                            {{$recent['field']}}
                                    </div>
                                    <div class="font-semibold text-center text-lg">
                                        {{$recent['sum']}}
                                    </div>
                                </div>
                                @elseif($recent['field'] == 'assists')
                                <div class="mini-card">
                                        <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                {{$recent['field']}}
                                        </div>
                                        <div class="font-semibold text-center text-lg">
                                            {{$recent['sum']}}
                                        </div>
                                    </div>
                                    @elseif($recent['field'] == 'last_hits')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$recent['sum']}}
                                            </div>
                                    </div>
                                    @elseif($recent['field'] == 'denies')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$recent['sum']}}
                                            </div>
                                    </div>
                                    @elseif($recent['field'] == 'duration')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                @php
                                                    $days = (int)($recent['sum']/86400);
                                                    $rdays = ($recent['sum']-($days*86400));
                                                    $hours = (int)($rdays/3600);
                                                    $rhours = ($rdays-($hours*3600));
                                                    $minutes = (int)($rhours/60);
                                                @endphp
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$days}}D : {{$hours}}H : {{$minutes}}M

                                            </div>


                                    </div>
                                    @elseif($recent['field'] == 'level')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$recent['sum']}}

                                            </div>


                                    </div>
                                    @elseif($recent['field'] == 'hero_damage')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$recent['sum']}}

                                            </div>


                                    </div>
                                    @elseif($recent['field'] == 'tower_damage')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$recent['sum']}}

                                            </div>


                                    </div>
                                    @elseif($recent['field'] == 'hero_healing')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$recent['sum']}}

                                            </div>


                                    </div>
                                    @elseif($recent['field'] == 'hero_healing')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>
                                            <div class="font-semibold text-center text-lg">
                                                {{$recent['sum']}}

                                            </div>


                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="container mx-auto w-full mt-4 font-mono">
                        <p class="text-2xl font-semibold text-indigo-700 text-center">Parsed Matches</p>
                        <div class="flex flex-wrap rounded-lg p-4 justify-center">
                                @if ($statistics != null)
                                @foreach ($statistics->tot_score as $recent)
                                    @if ($recent['field'] == 'stuns')
                                        <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                    {{$recent['field']}}
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{ round($recent['sum'], 0)}}</div>

                                        </div>
                                    @elseif($recent['field'] == 'tower_kills')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Tower Kills
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'neutral_kills')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Neutral Kills
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'courier_kills')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Courier Kills
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'purchase_tpscroll')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Tps Purchased
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'purchase_ward_observer')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide whitespace-no-wrap">
                                                Observers Purchased
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'purchase_ward_sentry')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Sentries Purchased
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'purchase_gem')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Gems Purchased
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'purchase_rapier')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Rapiers Purchased
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>
                                    @elseif($recent['field'] == 'pings')
                                    <div class="mini-card">
                                            <div class="border-b border-gray-600 font-medium font-semibold mb-1 pb-1 text-center text-lg tracking-wide">
                                                Map Pings
                                            </div>

                                                <div class="font-semibold text-center text-lg">{{$recent['sum']}}</div>

                                    </div>

                                    @endif
                                @endforeach
                                @endif

                    </div>
                </div>
@endsection
