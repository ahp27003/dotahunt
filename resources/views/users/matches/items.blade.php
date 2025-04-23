{{-- {{$player['item_0']}} {{$player['item_1']}} {{$player['item_2']}}
                    {{$player['item_3']}} {{$player['item_4']}} {{$player['item_5']}} --}}
    {{-- {{dd($itemsData->items["broadsword"])}} --}}
    {{-- dd($itemsData->items[$itemsData->item_id[$player['item_0']]]); --}}

    {{-- @php
    $random = rand();

        if($player['item_0'] != 0){
            $item = $itemsData->items[$itemsData->item_id[$player['item_0']]];
        }
        if($player['item_1'] != 0){
            $item2 = $itemsData->items[$itemsData->item_id[$player['item_1']]];
        }
        if($player['item_2'] != 0){
         $item3 = $itemsData->items[$itemsData->item_id[$player['item_2']]];
        }
        if($player['item_3'] != 0){
         $item4 = $itemsData->items[$itemsData->item_id[$player['item_3']]];
        }
        if($player['item_4'] != 0){
         $item5 = $itemsData->items[$itemsData->item_id[$player['item_4']]];
        }
        if($player['item_5'] != 0){
         $item6 = $itemsData->items[$itemsData->item_id[$player['item_5']]];
        }
    @endphp --}}
    @if($player['item_0'] != 0)
        @php
        $random = rand();

            if($player['item_0'] != 0){
                $item = $itemsData->items[$itemsData->item_id[$player['item_0']]];
            }

        @endphp
        <div class="flex flex-col relative cursor-pointer" v-tooltip.bottom="{ html: '{{$item['id']}}{{$random}}' }">
                <div>
                    <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10" >
                </div>
                <div class="bg-trans absolute bottom-0 right-0">
                        @if(array_key_exists('first_purchase_time', $player))
                        @if(array_key_exists($itemsData->item_id[$player['item_0']],$player['first_purchase_time']))
                        @php
                            $seconds = $player['first_purchase_time'][$itemsData->item_id[$player['item_0']]];
                            $minutes = floor($seconds/60);
                            $secondsleft = $seconds%60;
                            if($minutes<10)
                                $minutes = "0" . $minutes;
                            if($secondsleft<10)
                                $secondsleft = "0" . $secondsleft;
                        @endphp
                    <p class="text-sm"><span class="text-white">{{$minutes}}:{{$secondsleft}}</span></p>
                @endif
                @endif
                </div>
                </div>
    @include('users.matches.items_tooltip')
    @endif

    @if($player['item_1'] != 0)
    @php
        $random = rand();

            if($player['item_1'] != 0){
                $item = $itemsData->items[$itemsData->item_id[$player['item_1']]];
            }

        @endphp
        <div class="flex flex-col relative cursor-pointer" v-tooltip.bottom="{ html: '{{$item['id']}}{{$random}}' }">
        <div>
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10" >
        </div>
        <div class="bg-trans absolute bottom-0 right-0">
                @if(array_key_exists('first_purchase_time', $player))
                @if(array_key_exists($itemsData->item_id[$player['item_1']],$player['first_purchase_time']))
                @php
                    $seconds = $player['first_purchase_time'][$itemsData->item_id[$player['item_1']]];
                    $minutes = floor($seconds/60);
                    $secondsleft = $seconds%60;
                    if($minutes<10)
                        $minutes = "0" . $minutes;
                    if($secondsleft<10)
                        $secondsleft = "0" . $secondsleft;
                @endphp
            <p class="text-sm"><span class="text-white">{{$minutes}}:{{$secondsleft}}</span></p>
        @endif
        @endif
        </div>
        </div>
    @include('users.matches.items_tooltip')
    @endif

    @if($player['item_2'] != 0)
    @php
        $random = rand();
        if($player['item_2'] != 0){
            $item = $itemsData->items[$itemsData->item_id[$player['item_2']]];
        }
    @endphp
    <div class="flex flex-col relative cursor-pointer" v-tooltip.bottom="{ html: '{{$item['id']}}{{$random}}' }">
        <div>
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10" >
        </div>
        <div class="bg-trans absolute bottom-0 right-0">
                @if(array_key_exists('first_purchase_time', $player))
                @if(array_key_exists($itemsData->item_id[$player['item_2']],$player['first_purchase_time']))
                @php
                    $seconds = $player['first_purchase_time'][$itemsData->item_id[$player['item_2']]];
                    $minutes = floor($seconds/60);
                    $secondsleft = $seconds%60;
                    if($minutes<10)
                        $minutes = "0" . $minutes;
                    if($secondsleft<10)
                        $secondsleft = "0" . $secondsleft;
                @endphp
            <p class="text-sm"><span class="text-white">{{$minutes}}:{{$secondsleft}}</span></p>
        @endif
        @endif
        </div>
        </div>
    @include('users.matches.items_tooltip')
    @endif

    @if($player['item_3'] != 0)
    @php
        $random = rand();
        if($player['item_3'] != 0){
            $item = $itemsData->items[$itemsData->item_id[$player['item_3']]];
        }
    @endphp
    <div class="flex flex-col relative cursor-pointer" v-tooltip.bottom="{ html: '{{$item['id']}}{{$random}}' }">
        <div>
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10" >
        </div>
        <div class="bg-trans absolute bottom-0 right-0">
                @if(array_key_exists('first_purchase_time', $player))
                @if(array_key_exists($itemsData->item_id[$player['item_3']],$player['first_purchase_time']))
                @php
                    $seconds = $player['first_purchase_time'][$itemsData->item_id[$player['item_3']]];
                    $minutes = floor($seconds/60);
                    $secondsleft = $seconds%60;
                    if($minutes<10)
                        $minutes = "0" . $minutes;
                    if($secondsleft<10)
                        $secondsleft = "0" . $secondsleft;
                @endphp
            <p class="text-sm"><span class="text-white">{{$minutes}}:{{$secondsleft}}</span></p>
        @endif
        @endif
        </div>
        </div>
    @include('users.matches.items_tooltip')
    @endif

    @if($player['item_4'] != 0)
        @php
        $random = rand();
        if($player['item_4'] != 0){
            $item = $itemsData->items[$itemsData->item_id[$player['item_4']]];
        }
    @endphp
    <div class="flex flex-col relative cursor-pointer" v-tooltip.bottom="{ html: '{{$item['id']}}{{$random}}' }">
        <div>
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10" >
        </div>
        <div class="bg-trans absolute bottom-0 right-0">
                @if(array_key_exists('first_purchase_time', $player))
                @if(array_key_exists($itemsData->item_id[$player['item_4']],$player['first_purchase_time']))
                @php
                    $seconds = $player['first_purchase_time'][$itemsData->item_id[$player['item_4']]];
                    $minutes = floor($seconds/60);
                    $secondsleft = $seconds%60;
                    if($minutes<10)
                        $minutes = "0" . $minutes;
                    if($secondsleft<10)
                        $secondsleft = "0" . $secondsleft;
                @endphp
            <p class="text-sm"><span class="text-white">{{$minutes}}:{{$secondsleft}}</span></p>
        @endif
        @endif
        </div>
        </div>
    @include('users.matches.items_tooltip')
    @endif

    @if($player['item_5'] != 0)
    @php
        $random = rand();
        if($player['item_5'] != 0){
            $item = $itemsData->items[$itemsData->item_id[$player['item_5']]];
        }
    @endphp
    <div class="flex flex-col relative cursor-pointer" v-tooltip.bottom="{ html: '{{$item['id']}}{{$random}}' }">
        <div>
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10" >
        </div>
        <div class="bg-trans absolute bottom-0 right-0">
                @if(array_key_exists('first_purchase_time', $player))
                @if(array_key_exists($itemsData->item_id[$player['item_5']],$player['first_purchase_time']))
                @php
                    $seconds = $player['first_purchase_time'][$itemsData->item_id[$player['item_5']]];
                    $minutes = floor($seconds/60);
                    $secondsleft = $seconds%60;
                    if($minutes<10)
                        $minutes = "0" . $minutes;
                    if($secondsleft<10)
                        $secondsleft = "0" . $secondsleft;
                @endphp
            <p class="text-sm"><span class="text-white">{{$minutes}}:{{$secondsleft}}</span></p>
        @endif
        @endif
        </div>
        </div>
   @include('users.matches.items_tooltip')
    @endif


    {{-- @foreach($itemsData->items as $indexKey => $item)
    @php

    @endphp

        @if($item['id'] == $player['item_0'])
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10 cursor-pointer" v-tooltip.bottom="{ html: '{{$indexKey}}{{$item['id']}}{{$random}}' }">

            <div id="{{$indexKey}}{{$item['id']}}{{$random}}" class="tooltip-content">
                @include('users.matches.items_tooltip')
            </div>

        @elseif($item['id'] == $player['item_1'])
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10 cursor-pointer" v-tooltip.bottom="{ html: '{{$indexKey}}{{$item['id']}}{{$random}}' }">
            <div id="{{$indexKey}}{{$item['id']}}{{$random}}" class="tooltip-content">
                    @include('users.matches.items_tooltip')
            </div>

        @elseif($item['id'] == $player['item_2'])
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10 cursor-pointer" v-tooltip.bottom="{ html: '{{$indexKey}}{{$item['id']}}{{$random}}' }">
            <div id="{{$indexKey}}{{$item['id']}}{{$random}}" class="tooltip-content">
                    @include('users.matches.items_tooltip')
            </div>

        @elseif($item['id'] == $player['item_3'])
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10 cursor-pointer" v-tooltip.bottom="{ html: '{{$indexKey}}{{$item['id']}}{{$random}}' }">
            <div id="{{$indexKey}}{{$item['id']}}{{$random}}" class="tooltip-content">
                    @include('users.matches.items_tooltip')
            </div>

        @elseif($item['id'] == $player['item_4'])
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10 cursor-pointer" v-tooltip.bottom="{ html: '{{$indexKey}}{{$item['id']}}{{$random}}' }">
            <div id="{{$indexKey}}{{$item['id']}}{{$random}}" class="tooltip-content">
                @include('users.matches.items_tooltip')
            </div>

        @elseif($item['id'] == $player['item_5'])
            <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-10 cursor-pointer" v-tooltip.bottom="{ html: '{{$indexKey}}{{$item['id']}}{{$random}}' }">
            <div id="{{$indexKey}}{{$item['id']}}{{$random}}" class="tooltip-content">
                    @include('users.matches.items_tooltip')
            </div>
        @endif

    @endforeach --}}

