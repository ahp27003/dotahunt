@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / <a href="/players/{{$matches->user->accounts->dota_id}}/stats"
        class="no-underline hover:underline text-blue-500">Overview</a> / {{$matches->match_id}} / Performance</span>
    </section>

    <div class="container w-full p-4 mx-auto mt-4 font-mono">
            @if($matches != null)
        {{-- top --}}
        <div class="bg-dark-100 flex flex-col justify-between max-w-6xl p-4 rounded-lg shadow-lg">
                <div class="flex">
                     <div class="flex-1">
                             @if($matches->match_details['radiant_win'] == true)
                                 <p class="text-3xl text-green-500 font-semibold tracking-wide">Radiant Victory</p>
                             @else
                                 <p class="text-3xl text-red-500 font-semibold">Dire Victory</p>
                             @endif
                             </div>
                             <div class="flex-1 text-white">
                                 <p class="text-sm font-medium text-center">RANKED MATCH</p>
                                 <div class="flex justify-center items-center">
                                     <p class="text-4xl font-medium text-green-500 mr-10">{{$matches->match_details['radiant_score']}}</p>
                                     <p class="text-2xl font-medium text-center">@php
                                             $minutes=$matches->match_details['duration'];
                                             $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                                             echo $hours;
                                         @endphp</p>
                                     <p class="text-4xl font-medium text-red-500 ml-10">{{$matches->match_details['dire_score']}}</p>
                                 </div>


                             </div>
                             <div class="flex-1">
                                 <div class="flex justify-end text-white">
                                     <div class="flex flex-col mr-4">
                                         <p class="font-medium text-right text-gray-600">MATCH ID</p>
                                         <p class="font-medium text-right">{{$matches->match_id}}</p>
                                     </div>
                                     <div class="flex flex-col mr-4">
                                         <p class="font-medium text-right text-gray-600">REGION</p>
                                         <p class="font-medium text-right low">{{$itemsData->region[$matches->match_details['region']]}}</p>
                                     </div>
                                     <div class="flex flex-col">
                                         <p class="font-medium text-right text-gray-600">SKILL</p>
                                         <p class="font-medium text-right">
                                             @if ($matches->match_details['skill'] == 1)
                                                 Normal Skill
                                             @elseif($matches->match_details['skill'] == 2)
                                                 High Skill
                                             @elseif($matches->match_details['skill'] == 3)
                                                 Very High Skill
                                             @endif
                                         </p>
                                     </div>

                                 </div>

                             </div>

                </div>
                <div class="border-b border-gray-600 flex justify-center mt-4 pb-4">
                     <a href="{{ url('/matches/' . $matches->match_id ) }}" class="text-md font-medium  mr-20 hover:underline
                         {{(Request::is('matches/' . $matches->match_id )) ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Overview</a>
                     <a href="{{ url('/matches/' . $matches->match_id ) }}/skills" class="text-md font-medium text-white mx-10 hover:underline
                         {{(Request::is('matches/' . $matches->match_id . '/skills' )) ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Ability Build</a>
                     <a href="{{ url('/matches/' . $matches->match_id ) }}/performance" class="text-md font-medium text-white ml-20 hover:underline
                         {{(Request::is('matches/' . $matches->match_id . '/performance' )) ? 'text-white border-b-2 border-purple-500 pb-2' : 'text-gray-400'}}">Performance</a>
                 </div>

             </div>

        {{-- bottom --}}
        {{-- radiant --}}
        <div class="flex max-w-6xl flex-col">
                    <div class="bg-dark-100 rounded-lg px-10 py-4 mt-4">
                        <div class="flex items-end">
                                <img src=" {{  asset('img/radiant.png') }}" class="rounded-full w-10 mr-2">
                                <p class="text-xl tracking-wide font-medium text-white">Radiant - Performances</p>
                            </div>
                            <table class="border-collapse w-full table-auto">
                                    <thead class="text-white">
                                            <th class="capitalize border-b border-gray-300 py-4 text-left w-2">PLAYER</th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Longest multi-kill'">MULTI</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Longest killstreak'">STREAK</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Seconds of disable on heroes'">STUNS</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Camps stacked'">STACKED</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Number of buybacks'">BUYBACKS</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Observer and Sentry purchased'">Observer/Sentry</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Lane based on early game position'">LANE</span></th>
                                    </thead>
                                    <tbody class="text-center text-white">
                                    @foreach ($matches->match_details['players'] as $player)
                                    @if($player['isRadiant'] == 1)
                                        @include('users.matches.match_performance_table')
                                    @endif
                                    @endforeach
                                    </tbody>
                            </table>
                    </div>
                    {{-- ability build dire --}}
                    <div class="bg-dark-100 rounded-lg px-10 py-4 mt-4">
                            <div class="flex items-end">
                                    <img src=" {{  asset('img/dire.png') }}" class="rounded-full w-10 mr-2">
                                    <p class="text-xl tracking-wide font-medium text-white">Dire - Performances</p>
                                </div>

                            <table class="border-collapse w-full table-auto">
                                    <thead class="text-white">
                                            <th class="capitalize border-b border-gray-300 py-4 text-left w-2">PLAYER</th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Longest multi-kill'">MULTI</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Longest killstreak'">STREAK</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Seconds of disable on heroes'">STUNS</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Camps stacked'">STACKED</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Number of buybacks'">BUYBACKS</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Observer and Sentry purchased'">Observer/Sentry</span></th>
                                            <th class="capitalize border-b border-gray-300 py-4 "><span v-tooltip.top="'Lane based on early game position'">LANE</span></th>
                                    </thead>
                                    <tbody class="text-center text-white">
                                    @foreach ($matches->match_details['players'] as $player)
                                    @if($player['isRadiant'] == 0)
                                            @include('users.matches.match_performance_table')
                                    @endif
                                    @endforeach
                                    </tbody>
                            </table>
                    </div>
        </div>
            @else
            <p class="font-semibold text-lg mt-5">Wrong match id</p>
            @endif
@endsection
