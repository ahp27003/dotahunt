@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="pt-2 ml-4 font-medium tracking-wide text-white">
        @if($matches != null)
    <span class="text-sm italic">Home / <a href="/players/{{$matches->user->accounts->dota_id}}/stats"
        class="text-blue-500 no-underline hover:underline">Overview</a> / {{$matches->match_id}}</span>
    </section>

    <div class="container w-full p-4 mx-auto mt-4 font-mono">

        {{-- top --}}
        <div class="flex flex-col justify-between max-w-6xl p-4 rounded-lg shadow-lg bg-dark-100">
           <div class="flex">
                <div class="flex-1">
                        @if($matches->match_details['radiant_win'] == true)
                            <p class="text-3xl font-semibold tracking-wide text-green-500">Radiant Victory</p>
                        @else
                            <p class="text-3xl font-semibold text-red-500">Dire Victory</p>
                        @endif
                        </div>
                        <div class="flex-1 text-white">
                            <p class="text-sm font-medium text-center">RANKED MATCH</p>
                            <div class="flex items-center justify-center">
                                <p class="mr-10 text-4xl font-medium text-green-500">{{$matches->match_details['radiant_score']}}</p>
                                <p class="text-2xl font-medium text-center">@php
                                        $minutes=$matches->match_details['duration'];
                                        $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                                        echo $hours;
                                    @endphp</p>
                                <p class="ml-10 text-4xl font-medium text-red-500">{{$matches->match_details['dire_score']}}</p>
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
           <div class="flex flex-col items-center justify-center text-white cursor-pointer">
                <p>  <span v-tooltip.right="'{{ date('m/d/Y',$matches->match_details['start_time']) }}'">
                ended {{ \Carbon\Carbon::createFromTimeStamp($matches->match_details['start_time'])->diffForHumans()
                    }}</span> </p>
               <a href="{{$matches->match_details['replay_url']}}">
                <div class="flex p-2 hover:bg-gray-700">
                        <i class="mr-1 material-icons">get_app</i>
                        <p>REPLAY</p>
                </div>
                </a>
            </div>
           <div class="flex justify-center pb-4 mt-4 border-b border-gray-600">
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
        <div class="flex flex-col max-w-6xl px-10 py-4 mt-4 rounded-lg shadow-lg bg-dark-100">
            <div class="flex items-end">
                <img src=" {{  asset('img/radiant.png') }}" class="w-10 mr-2 rounded-full">
                <p class="mt-3 text-xl font-medium tracking-wide text-white">Radiant - Overview</p>
            </div>
            <table class="w-full border-collapse table-fixed">
                <thead class="font-normal text-white">
                        <th class="w-3 py-4 font-medium text-left capitalize border-b border-gray-300">PLAYER</th>
                        <th class="w-0 py-4 font-medium text-right capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Level Achieved by Hero'">LVL</span></th>
                        <th class="w-1 py-4 font-medium text-right text-green-600 capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Number of kills by hero'">K</span></th>
                        <th class="w-1 py-4 font-medium text-red-600 capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Number of deaths by hero'">D</span></th>
                        <th class="w-1 py-4 font-medium text-left text-gray-600 capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Number of assists by hero'">A</span></th>
                        <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Number of last hits by hero'">LH</span>
                            /<span v-tooltip.top="'Number of denied creeps'">DN</span></th>
                        <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Amount of damages dealt to heroes'">HD</span></th>
                        <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Amount of damages dealt to towers'">TD</span></th>
                        <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Amount of health restored to heroes'">HH</span></th>
                        <th class="w-1 py-4 font-medium text-left text-yellow-600 capitalize border-b border-gray-300 cursor-pointer">
                        <div class="flex items-center" v-tooltip.top="'Total gold farmed'">
                                <img src="{{  asset('img/gold.png') }}" class="w-4 h-4 mr-1">
                                <span >GOLD</span>
                        </div>
                        </th>
                        <th class="w-4 py-4 font-medium capitalize border-b border-gray-300 cursor-pointer">
                            <span v-tooltip.top="'Items Build'">ITEMS</span></th>
                </thead>
                <tbody class="text-center text-white">
                @foreach ($matches->match_details['players'] as $player)

                @if($player['isRadiant'] == 1)
                    <tr class="border-b border-gray-300 hover:bg-content">
                        @if(array_key_exists("personaname", $player))
                        <td class="w-2/12 py-2">
                            <div class="flex items-center">
                            @include('users.heroes2')
                            <div class="flex flex-col items-start ml-2 truncate">
                                <div class="w-11/12 font-medium text-left truncate">{{$player['personaname']}}</div>
                                @include('users.medal_word')
                            </div>
                            </div>
                        </td>
                        @else
                        <td class="">
                                <div class="flex items-center">
                                @include('users.heroes2')
                                <div class="flex flex-col items-start ml-2">
                                    <div class="font-medium">Anonymous</div>
                                    @include('users.medal_word')
                                </div>
                                </div>
                            </td>
                        @endif
                        <td class="text-right ">{{$player['level']}}</td>
                        <td class="text-right text-green-600 ">{{$player['kills']}}</td>
                        <td class="text-red-600 ">{{$player['deaths']}}</td>
                        <td class="text-left text-gray-600 ">{{$player['assists']}}</td>
                        <td class="text-left ">{{$player['last_hits']}}/{{$player['denies']}}</td>
                        <td class="text-left ">
                            @if($player['hero_damage'] >= 1000)
                            {{round(((float)$player['hero_damage']/1000),1)}}k
                            @else
                            {{$player['hero_damage']}}
                            @endif
                        </td>
                        <td class="text-left ">
                                @if($player['tower_damage'] >= 1000)
                                {{round(((float)$player['tower_damage']/1000),1)}}k
                                @else
                                {{$player['tower_damage']}}
                                @endif
                        </td>
                        <td class="text-left ">
                            @if($player['hero_healing'] >= 1000)
                            {{round(((float)$player['hero_healing']/1000),1)}}k
                            @else
                            {{$player['hero_healing']}}
                            @endif
                        </td>
                        <td class="text-left text-yellow-500 ">
                            @if($player['total_gold'] >= 1000)
                            {{round(((float)$player['total_gold']/1000),1)}}k
                            @else
                            {{$player['total_gold']}}
                            @endif
                        </td>
                        <td>
                            <div class="flex">
                                @include('users.matches.items')
                        </div></td>
                    </tr>
                @endif
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- hero banned --}}
        {{-- <div class="flex justify-center max-w-6xl mt-4">
            @foreach($matches->match_details['picks_bans'] as $ban)
            @if ( $player['hero_id'] == null)
            <img src="
            {{  asset('img/heroes/default.png') }}" class="w-16">
            @else
            <div class="flex flex-col items-center">
            <div class="mx-2 border-2 border-red-600">
                    <img  src="
                    {{  asset('img/heroes/' . $ban['hero_id'] . '.png') }}" class="w-16" style="filter: grayscale(100%);">
                </div>
                <div class="px-3 bg-black ">
                    <p class="tracking-wide text-white font-base">Ban {{$loop->index + 1}}</p>

                </div>
            </div>

            @endif
            @endforeach
        </div> --}}
        {{-- dire --}}

        <div class="flex flex-col max-w-6xl px-10 py-4 mt-4 rounded-lg shadow-lg bg-dark-100">
                <div class="flex items-end">
                    <img src=" {{  asset('img/dire.png') }}" class="w-10 mr-2 rounded-full">
                    <p class="mt-3 text-xl font-medium tracking-wide text-white">Dire - Overview</p>
                </div>
                <table class="w-full border-collapse table-fixed">
                    <thead class="font-normal text-white">
                            <th class="w-3 py-4 font-medium text-left capitalize border-b border-gray-300">PLAYER</th>
                            <th class="w-0 py-4 font-medium text-right capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Level Achieved by Hero'">LVL</span></th>
                            <th class="w-1 py-4 font-medium text-right text-green-600 capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Number of kills by hero'">K</span></th>
                            <th class="w-1 py-4 font-medium text-red-600 capitalize border-b border-gray-300 cursor-pointer">
                                    <span v-tooltip.top="'Number of deaths by hero'">D</span></th>
                            <th class="w-1 py-4 font-medium text-left text-gray-600 capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Number of assists by hero'">A</span></th>
                            <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Number of last hits by hero'">LH</span>
                                /<span v-tooltip.top="'Number of denied creeps'">DN</span></th>
                            <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Amount of damages dealt to heroes'">HD</span></th>
                            <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Amount of damages dealt to towers'">TD</span></th>
                            <th class="w-1 py-4 font-medium text-left capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Amount of health restored to heroes'">HH</span></th>
                            <th class="w-1 py-4 font-medium text-left text-yellow-600 capitalize border-b border-gray-300 cursor-pointer">
                            <div class="flex items-center" v-tooltip.top="'Total gold farmed'">
                                    <img src="{{  asset('img/gold.png') }}" class="w-4 h-4 mr-1">
                                    <span >GOLD</span>
                            </div>
                            </th>
                            <th class="w-4 py-4 font-medium capitalize border-b border-gray-300 cursor-pointer">
                                <span v-tooltip.top="'Items Build'">ITEMS</span></th>
                    </thead>
                    <tbody class="text-center text-white">
                    @foreach ($matches->match_details['players'] as $player)

                    @if($player['isRadiant'] == 0)
                        <tr class="border-b border-gray-300 hover:bg-content">
                            @if(array_key_exists("personaname", $player))
                            <td class="w-2/12 py-2">
                                <div class="flex items-center">
                                @include('users.heroes2')
                                <div class="flex flex-col items-start ml-2 truncate">
                                    <div class="w-11/12 font-medium text-left truncate">{{$player['personaname']}}</div>
                                    @include('users.medal_word')
                                </div>
                                </div>
                            </td>
                            @else
                            <td class="">
                                    <div class="flex items-center">
                                    @include('users.heroes2')
                                    <div class="flex flex-col items-start ml-2">
                                        <div class="font-medium">Anonymous</div>
                                        @include('users.medal_word')
                                    </div>
                                    </div>
                                </td>
                            @endif
                            <td class="text-right ">{{$player['level']}}</td>
                            <td class="text-right text-green-600 ">{{$player['kills']}}</td>
                            <td class="text-red-600 ">{{$player['deaths']}}</td>
                            <td class="text-left text-gray-600 ">{{$player['assists']}}</td>
                            <td class="text-left ">{{$player['last_hits']}}/{{$player['denies']}}</td>
                            <td class="text-left ">
                                @if($player['hero_damage'] >= 1000)
                                {{round(((float)$player['hero_damage']/1000),1)}}k
                                @else
                                {{$player['hero_damage']}}
                                @endif
                            </td>
                            <td class="text-left ">
                                    @if($player['tower_damage'] >= 1000)
                                    {{round(((float)$player['tower_damage']/1000),1)}}k
                                    @else
                                    {{$player['tower_damage']}}
                                    @endif
                            </td>
                            <td class="text-left ">
                                @if($player['hero_healing'] >= 1000)
                                {{round(((float)$player['hero_healing']/1000),1)}}k
                                @else
                                {{$player['hero_healing']}}
                                @endif
                            </td>
                            <td class="text-left text-yellow-500 ">
                                @if($player['total_gold'] >= 1000)
                                {{round(((float)$player['total_gold']/1000),1)}}k
                                @else
                                {{$player['total_gold']}}
                                @endif
                            </td>
                            <td>
                                <div class="flex">
                                    @include('users.matches.items')
                            </div></td>
                        </tr>
                    @endif
                    @endforeach
                    </tbody>
                </table>
            </div>







            @else
            <span class="text-sm italic">Home / Overview / Match</span>
            </section>

            <div class="container max-w-3xl p-8 mt-12 font-mono rounded bg-dark-100">


            <p class="text-lg font-semibold text-white">Generating match details. Please come back again in a few minutes</p>
            </div>
            @endif



{{-- <div class="px-5 mx-5 my-5 container-fuild">

@if($matches != null)

<div class="text-center"><h3><b>ALLL DRAFT</b></h3>
    <h1>Radiant <span class="text-success">{{$matches->match_details['radiant_score']}}</span> :
    <span class="text-danger">{{$matches->match_details['dire_score']}}</span> Dire</h1>
    @if($matches->match_details['radiant_win'] == true)
    <h2><span class="text-success">Radiant Victory
            @php
            $minutes=$matches->match_details['duration'];
            $hours = intdiv($minutes, 60).':'. ($minutes % 60);
            echo "(" . $hours . ")";
        @endphp
        </span></h2>
    @else
    <h2><span class="text-danger">Dire Victory
            @php
            $minutes=$matches->match_details['duration'];
            $hours = intdiv($minutes, 60).':'. ($minutes % 60);
            echo "(" . $hours . ")";
        @endphp
    </span></h2>
    @endif

</div>

<table class="table text-center table-striped"><h3>Radiant - Overview</h3>
  <thead>
    <tr>
      <th scope="col">PLAYER</th>
      <th scope="col">LVL</th>
      <th scope="col">KDA</th>
      <th scope="col">LH/DN</th>
      <th scope="col">GPM/XPM</th>
      <th scope="col">HERO DAMAGES</th>
      <th scope="col">TOWER DAMAGES</th>
      <th scope="col">HERO HEALED</th>
      <th scope="col">GOLD</th>
      <th scope="col">ITEMS</th>
      <th scope="col">CAMPS STACKED</th>
      <th scope="col">OBSERVER/SENTRY PLACED</th>
      <th scope="col">LANE</th>


    </tr>
  </thead>
  <tbody>

@foreach ($matches->match_details['players'] as $player)

    @if($player['isRadiant'] == 1)

        @if(array_key_exists("personaname", $player))
                <tr>
                <td>{{$player['personaname']}}<br>@include('users.heroes2')@include('users.medal3') </td>
                <td>{{$player['level']}}</td>
                <td>{{$player['kills']}} / {{$player['deaths']}} / {{$player['assists']}}</td>
                <td>{{$player['last_hits']}} / {{$player['denies']}}</td>
                <td>{{$player['gold_per_min']}} / {{$player['xp_per_min']}}</th>
                <td>{{$player['hero_damage']}}</td>
                <td>{{$player['tower_damage']}}</td>
                <td>{{$player['hero_healing']}}</td>
                <td>{{$player['total_gold']}}</td>
                <td>@include('users.matches.items')</td>
                <td>{{$player['camps_stacked']}}</td>
                <td>@include('users.matches.wards')</td>
                <td>@include('users.matches.roles')</td>
                </tr>
        @else
        <tr>
                <td>Unknown<br>@include('users.heroes2'){{$player['rank_tier']}}</td>
                <td>{{$player['level']}}</td>
                <td>{{$player['kills']}} / {{$player['deaths']}} / {{$player['assists']}}</td>
                <td>{{$player['last_hits']}} / {{$player['denies']}}</td>
                <td>{{$player['gold_per_min']}} / {{$player['xp_per_min']}}</th>
                <td>{{$player['hero_damage']}}</td>
                <td>{{$player['tower_damage']}}</td>
                <td>{{$player['hero_healing']}}</td>
                <td>{{$player['total_gold']}}</td>
                <td>@include('users.matches.items')</td>
                <td>{{$player['camps_stacked']}}</td>
                <td>@include('users.matches.wards')</td>
                <td>@include('users.matches.roles')</td>
                </tr>
            @endif
    @endif

            @endforeach
  </tbody>
</table>

<table class="table mt-3 text-center table-striped"><h3>Dire - Overview</h3>
    <thead>
      <tr>
        <th scope="col">PLAYER</th>
        <th scope="col">LVL</th>
        <th scope="col">KDA</th>
        <th scope="col">LH/DN</th>
        <th scope="col">GPM/XPM</th>
        <th scope="col">HERO DAMAGES</th>
        <th scope="col">TOWER DAMAGES</th>
        <th scope="col">HERO HEALED</th>
        <th scope="col">GOLD</th>
        <th scope="col">ITEMS</th>
        <th scope="col">CAMPS STACKED</th>
        <th scope="col">OBSERVER/SENTRY PLACED</th>
        <th scope="col">LANE</th>
      </tr>
    </thead>
    <tbody>

  @foreach ($matches->match_details['players'] as $player)

      @if($player['isRadiant'] == 0)

          @if(array_key_exists("personaname", $player))


                  <tr>
                  <td>{{$player['personaname']}} <br>@include('users.heroes2')  @include('users.medal3') </td>
                  <td>{{$player['level']}}</td>
                  <td>{{$player['kills']}} / {{$player['deaths']}} / {{$player['assists']}}</td>
                  <td>{{$player['last_hits']}} / {{$player['denies']}}</td>
                  <td>{{$player['gold_per_min']}} / {{$player['xp_per_min']}}</th>
                  <td>{{$player['hero_damage']}}</td>
                  <td>{{$player['tower_damage']}}</td>
                  <td>{{$player['hero_healing']}}</td>
                  <td>{{$player['total_gold']}}</td>
                  <td>@include('users.matches.items')</td>
                  <td>{{$player['camps_stacked']}}</td>
                  <td>@include('users.matches.wards')</td>
                  <td>@include('users.matches.roles')</td>

                  </tr>
          @else
          <tr>
                  <td>Unknown<br>@include('users.heroes2')@include('users.medal3')</td>
                  <td>{{$player['level']}}</td>
                  <td>{{$player['kills']}} / {{$player['deaths']}} / {{$player['assists']}}</td>
                  <td>{{$player['last_hits']}} / {{$player['denies']}}</td>
                  <td>{{$player['gold_per_min']}} / {{$player['xp_per_min']}}</th>
                  <td>{{$player['hero_damage']}}</td>
                  <td>{{$player['tower_damage']}}</td>
                  <td>{{$player['hero_healing']}}</td>
                  <td>{{$player['total_gold']}}</td>
                  <td>@include('users.matches.items')</td>
                  <td>{{$player['camps_stacked']}}</td>
                  <td>@include('users.matches.wards')</td>
                  <td>@include('users.matches.roles')</td>
                  </tr>
              @endif
      @endif

              @endforeach
    </tbody>
  </table>
  @else
  <p class="mt-5 text-lg font-semibold ">Processing Match details... Comeback back again in minutes</p>
  @endif
</div>
    </div> --}}
@endsection
