<tr class="border-b border-gray-300 hover:bg-content">
        @if(array_key_exists("personaname", $player))
        <td class="py-2 border-b border-gray-300 w-2/12">
            <div class="flex items-center">
            @include('users.heroes2')
            <div class="flex flex-col items-start ml-2 truncate">
                <div class="w-11/12 truncate text-left font-medium">{{$player['personaname']}}</div>
                @include('users.medal_word')
            </div>
            </div>
        </td>
        @else
        <td class="border-b border-gray-300">
                <div class="flex items-center">
                @include('users.heroes2')
                <div class="flex flex-col items-start ml-2">
                    <div class="font-medium">Anonymous</div>
                    @include('users.medal_word')
                </div>
                </div>
        </td>
        @endif
        @if(empty($player['multi_kills']))
        <td> - </td>
        @else
            @foreach($player['multi_kills'] as $key => $mk)
                @if($loop->last)
                    <td> {{$key}} </td>
                @endif
            @endforeach
        @endif
        @if(empty($player['kill_streaks']))
        <td> - </td>
        @else
            @foreach($player['kill_streaks'] as $key => $mk)
                @if($loop->last)
                    <td> {{$key}} </td>
                @endif
            @endforeach
        @endif
            <td>{{ (round($player['stuns'],2) == 0) ? '-' : round($player['stuns'],2)}}</td>
            <td>{{ ($player['camps_stacked'] == 0) ? '-' : $player['camps_stacked'] }}</td>
            <td>
                    @if($player['buyback_log'] != null)
                {{(count($player['buyback_log']) != 0) ? count($player['buyback_log']) : '-'}}
                @else
                -
                @endif
            </td>
            <td>@if(array_key_exists("purchase_ward_observer", $player))
                {{$player['purchase_ward_observer']}}
                @else
                0
                @endif
                /
                @if(array_key_exists("purchase_ward_sentry", $player))
                {{$player['purchase_ward_sentry']}}
                @else
                0
                @endif
            </td>
            <td>@include('users.matches.roles')</td>
</tr>
