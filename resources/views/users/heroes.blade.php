{{-- @if ( $recent['hero_id'] == null)
            <img src="
            {{  asset('img/heroes/default.png') }}" alt="">
@else
            <img  src="
            {{  asset('img/heroes/' . $recent['hero_id'] . '.png') }}" alt="">
@endif --}}


@foreach($itemsData->heroes as $hero)
@php
$random = rand();
@endphp
@if ( $recent['hero_id'] == null)
            <img src="
            {{  asset('img/heroes/default.png') }}" class="w-24">
@else
        @if($hero['id'] == $recent['hero_id'])
        {{-- {{ dd($hero['img'])}} --}}

        <img  src="http://cdn.dota2.com{{$hero['img']}}" class="w-24 cursor-pointer" v-tooltip.right="{ html: '{{$random}}{{$hero['id']}}' }">
        <div id="{{$random}}{{$hero['id']}}" class="tooltip-content">
            <div class="p-2">
                <div class="flex">
                    <div>
                            <img  src="http://cdn.dota2.com{{$hero['icon']}}" class="h-10" v-tooltip.right="{ html: '{{$hero['id']}}' }">
                        </div>
                        <div class="ml-2 flex flex-col items-start">
                            <p class="font-medium capitalize text-md">{{$hero['localized_name']}}</p>
                            @if($hero['primary_attr'] == "int")
                            <p class="flex items-center text-xs">Intelligence Hero <img src="{{ asset('img/int.png')}}" class=" ml-1 w-6"></p>
                            @elseif($hero['primary_attr'] == "agi")
                            <p class="flex items-center text-xs">Agility Hero <img src="{{ asset('img/agi.png')}}"  class=" ml-1 w-6"></p>
                            @else
                            <p class="flex items-center text-xs">Strength Hero <img src="{{ asset('img/str.png')}}"  class=" ml-1 w-6"></p>
                            @endif
                            <p class="text-xs"><span class="font-medium">{{$hero['attack_type']}}</span> -
                            @foreach($hero['roles'] as $role)
                            {{$role}}
                            @endforeach
                            </p>
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <img src="{{ asset('img/int.png')}}" class="w-8">
                        <p class="text-xs">{{$hero['base_int']}} + {{$hero['int_gain']}}</p>
                    </div>
                    <div>
                        <img src="{{ asset('img/agi.png')}}" class="w-8">
                        <p class="text-xs">{{$hero['base_agi']}} + {{$hero['agi_gain']}}</p>
                    </div>
                    <div>
                        <img src="{{ asset('img/str.png')}}" class="w-8">
                        <p class="text-xs">{{$hero['base_str']}} + {{$hero['str_gain']}}</p>
                    </div>

                </div>
                <div class="flex flex-col items-center">
                        <p class="text-xs"><span class="font-medium">{{$hero['move_speed']}}</span> movement speed</p>
                        <p class="text-xs"><span class="font-medium">{{$hero['base_attack_min']}} - {{$hero['base_attack_max']}}</span> base attack</p>
                        <p class="text-xs"><span class="font-medium">{{$hero['attack_range']}}</span> attack range</p>
                    </div>
                </div>
            </div>
        @endif


@endif
@endforeach


