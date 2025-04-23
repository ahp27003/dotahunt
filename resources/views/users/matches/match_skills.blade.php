@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / <a href="/players/{{$matches->user->accounts->dota_id}}/stats"
        class="no-underline hover:underline text-blue-500">Overview</a> / {{$matches->match_id}} / Ability</span>
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
                    <div class="flex max-w-6xl flex-col">
                             <div class="flex items-end">
                <img src=" {{  asset('img/radiant.png') }}" class="rounded-full w-10 mr-2">
                <p class="text-xl tracking-wide font-medium mt-3 text-white">Radiant - Ability Build</p>
            </div>
                            <table class="border-collapse w-full table-auto text-white">
                                    <thead class="">
                                            <th class="capitalize border-b border-gray-300 py-4 text-left w-2">PLAYER</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">1</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">2</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">3</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">4</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">5</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">6</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">7</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">8</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">9</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">10</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">11</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">12</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">13</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">14</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">15</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">16</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">18</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">20</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">25</th>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach ($matches->match_details['players'] as $player)
                                    @if($player['isRadiant'] == 1)
                                    <tr class="border-b border-gray-300 hover:bg-content">
                                            @if(array_key_exists("personaname", $player))
                                            <td class="py-2 w-2/12">
                                                <div class="flex items-center">
                                                @include('users.heroes2')
                                                <div class="flex flex-col items-start ml-2 truncate">
                                                    <div class="w-11/12 truncate text-left font-medium">{{$player['personaname']}}</div>
                                                    @include('users.medal_word')
                                                </div>
                                                </div>
                                            </td>
                                            @else
                                            <td>
                                                    <div class="flex items-center">
                                                    @include('users.heroes2')
                                                    <div class="flex flex-col items-start ml-2">
                                                        <div class="font-medium">Anonymous</div>
                                                        @include('users.medal_word')
                                                    </div>
                                                    </div>
                                                </td>
                                            @endif
                                        @include('users.matches.ability')
                                    </tr>
                                    @endif
                                    @endforeach
                                    </tbody>
                            </table>
                    </div>
            </div>

            <div class="bg-dark-100 rounded-lg px-10 py-4 mt-4">
                    <div class="flex max-w-6xl flex-col">
                             <div class="flex items-end">
                <img src=" {{  asset('img/dire.png') }}" class="rounded-full w-10 mr-2">
                <p class="text-xl tracking-wide font-medium mt-3 text-white">Dire - Ability Build</p>
            </div>
                            <table class="border-collapse w-full table-auto text-white">
                                    <thead class="">
                                            <th class="capitalize border-b border-gray-300 py-4 text-left w-2">PLAYER</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">1</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">2</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">3</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">4</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">5</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">6</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">7</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">8</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">9</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">10</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">11</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">12</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">13</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">14</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">15</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">16</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">18</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">20</th>
                                            <th class="capitalize border-b border-gray-300 py-4 ">25</th>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach ($matches->match_details['players'] as $player)
                                    @if($player['isRadiant'] == 0)
                                    <tr class="border-b border-gray-300 hover:bg-content">
                                            @if(array_key_exists("personaname", $player))
                                            <td class="py-2 w-2/12">
                                                <div class="flex items-center">
                                                @include('users.heroes2')
                                                <div class="flex flex-col items-start ml-2 truncate">
                                                    <div class="w-11/12 truncate text-left font-medium">{{$player['personaname']}}</div>
                                                    @include('users.medal_word')
                                                </div>
                                                </div>
                                            </td>
                                            @else
                                            <td>
                                                    <div class="flex items-center">
                                                    @include('users.heroes2')
                                                    <div class="flex flex-col items-start ml-2">
                                                        <div class="font-medium">Anonymous</div>
                                                        @include('users.medal_word')
                                                    </div>
                                                    </div>
                                                </td>
                                            @endif
                                        @include('users.matches.ability')
                                    </tr>
                                    @endif
                                    @endforeach
                                    </tbody>
                            </table>
                    </div>
            </div>

        </div>
            @else
            <p class="font-semibold text-lg mt-5">Wrong match id</p>
            @endif
@endsection
