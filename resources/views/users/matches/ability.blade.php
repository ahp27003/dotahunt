@foreach ($player['ability_upgrades_arr'] as $ability)

{{-- coding panjang --}}
{{-- {{dd($itemsData->ability_id)}} --}}
    {{-- {{dd($itemsData->abilities[$itemsData->ability_id[$ability]]["img"])}} --}}

    {{-- @foreach ($itemsData->ability_id as $key => $id)
        @if($ability == $key)
            @foreach ($itemsData->abilities as $key2 => $item)

                @if($id == $key2)
                    @foreach($item  as $key3 => $img)
                    @if($key3 == "img")
                    <td class="border-b border-gray-300 "><img src="http://cdn.dota2.com{{$img}}" class="w-10"></td>
                    @endif
                    @endforeach

                @endif

            @endforeach



        @break
        @endif

    @endforeach --}}

    {{-- coding pendek --}}
    @php
            $random = rand();
        @endphp
    @if(array_key_exists("img",$itemsData->abilities[$itemsData->ability_id[$ability]]))
        @php
            $ab = $itemsData->abilities[$itemsData->ability_id[$ability]];
            //dd($ab);
        @endphp
            <td ><img src="http://cdn.dota2.com{{$ab['img']}}" class="w-10 cursor-pointer"
                v-tooltip.bottom="{ html: '{{$random}}' }"></td>
            <div id="{{$random}}" class="tooltip-content">
                <div class="p-2">

                <div class="flex items-center">
                    <div>
                        <img src="http://cdn.dota2.com{{$ab['img']}}" class="w-14">
                    </div>
                    <div class="ml-2">
                            <p class="text-lg font-semibold tracking-wide">{{$ab['dname']}}</p>

                    </div>
                </div>
                <div class="p-2 bg-gray-900">
                    @if(array_key_exists("behavior",$ab))
                    @if(is_array($ab['behavior']))
                    <p class="text-medium">TARGET:
                    @foreach($ab['behavior'] as $bh)
                        @if($loop->last != true)
                        {{$bh}} /
                        @else
                        {{$bh}}
                        @endif
                    @endforeach
                    </p>
                    @else
                    <p class="text-medium">TARGET: {{$ab['behavior']}}</p>
                    @endif
                    @endif
                    @if(array_key_exists("dmg_type",$ab))
                        @if(is_array($ab['dmg_type']))
                        <p class="text-medium">DAMAGE TYPE:
                        @foreach($ab['dmg_type'] as $d)
                            @if($loop->last != true)
                            {{$d}} /
                            @else
                            {{$d}}
                            @endif
                        @endforeach
                        </p>
                        @else
                        <p class="text-medium">DAMAGE TYPE: {{$ab['dmg_type']}}</p>
                        @endif
                    @endif
                    @if(array_key_exists("bkbpierce",$ab))
                    <p class="text-medium">PIERCES SPELL IMMUNITY: {{$ab['bkbpierce']}}</p>
                    @endif
                </div>
                <div class="mt-2">
                        <p class="text-sm italic text-gray-500">{{$ab['desc']}}</p>
                </div>
                <div class="mt-2">
                    @foreach($ab['attrib'] as $att)

                <p class="text-medium">{{$att['header']}}
                    @if(is_array($att['value']))
                        @foreach($att['value'] as $v)
                        @if($loop->last != true)
                        {{$v}} /
                        @else
                        {{$v}}
                        @endif
                        @endforeach
                    @else
                    {{$att['value']}}
                    @endif
                </p>

                    @endforeach
                </div>

                <div class="flex mt-2">
                    <img src="{{  asset('img/mana.png') }}" alt="">
                    @if(array_key_exists("mc",$ab))
                        @if(is_array($ab['mc']))
                            @foreach($ab['mc'] as $m)
                            @if($loop->last != true)
                            {{$m}} /
                            @else
                            {{$m}}
                            @endif
                            @endforeach
                        @else
                            {{$ab['mc']}}
                        @endif
                    @endif
                    @if(array_key_exists("cd",$ab))
                    <img src="{{  asset('img/cd.png') }}" alt="" class="ml-4">
                    @if(is_array($ab['cd']))
                            @foreach($ab['cd'] as $c)
                            @if($loop->last != true)
                            {{$c}} /
                            @else
                            {{$c}}
                            @endif
                            @endforeach
                        @else
                        {{$ab['cd']}}
                        @endif

                    @endif
                </div>

            </div>

            </div>
        {{-- {{dd($img)}} --}}


    @else
        <td>
        <img src="{{asset('img/talent.jpg')}}" class="w-10">
        </td>
    @endif

@endforeach
     {{-- @if(array_key_exists(0,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][0]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(1,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][1]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(2,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][2]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(3,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][3]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(4,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][4]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(5,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][5]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(6,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][6]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(7,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][7]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(8,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][8]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(9,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][9]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(10,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][10]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(11,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][11]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(12,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][12]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(13,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][13]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(14,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][14]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        @if(array_key_exists(15,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][15]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        <td class="border-b border-gray-300 "></td>
        @if(array_key_exists(16,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][16]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        <td class="border-b border-gray-300 "></td>
        @if(array_key_exists(17,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][17]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif
        <td class="border-b border-gray-300 "></td>
        <td class="border-b border-gray-300 "></td>
        <td class="border-b border-gray-300 "></td>
        <td class="border-b border-gray-300 "></td>
        @if(array_key_exists(18,$player['ability_upgrades_arr']))
        <td class="border-b border-gray-300 ">{{$player['ability_upgrades_arr'][18]}}</td>
        @else
        <td class="border-b border-gray-300 "></td>
        @endif --}}


