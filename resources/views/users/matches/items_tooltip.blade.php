
    <div id="{{$item['id']}}{{$random}}" class="tooltip-content">
        <div class="p-1">
                <div class="flex">
                    <div>
                        <img src="http://cdn.dota2.com{{ $item['img'] }}" class="h-12">
                    </div>
                    <div class="flex flex-col ml-2">
                            <p class="uppercase font-medium text-white whitespace-no-wrap">{{$item['dname']}}</p>
                            <div class="flex items-baseline">
                                <div>
                                    <img src=" {{  asset('img/gold.png') }}" class="w-4 mr-1">
                                </div>
                                <p class="font-medium text-yellow-500 text-md">{{$item['cost']}}</p>
                            </div>
                    </div>
                </div>
                @if(array_key_exists("attrib",$item))
                <div class="flex flex-col mt-2 p-1">
                    @foreach($item['attrib'] as $att)
                        <p class="text-md">
                            @if(array_key_exists("header",$att))
                            {{$att['header']}}
                            @endif
                            @if(array_key_exists("value",$att))
                                @if(is_array($att['value']))
                                <span class="font-medium">
                                    @foreach($att['value'] as $v)

                                    @if($loop->last != true)
                                    {{$v}} /
                                    @else
                                    {{$v}}
                                    @endif
                                    @endforeach
                                    </span>
                                @else
                                <span class="font-medium">{{$att['value']}}</span>
                                @endif
                            @endif
                            @if(array_key_exists("footer",$att))
                            {{$att['footer']}}
                            @endif
                        </p>
                    @endforeach
                </div>
                @endif
                @if(array_key_exists("active",$item))
                <div class="flex flex-col mt-2 p-1">
                    @foreach($item['active'] as $active)
                    <div class="bg-gray-700 py-1 pl-2 flex">
                        <div>
                            <p class="font-semibold text-md tracking-wide">Active: {{$active['name']}}</p>
                        </div>
                        <div class="flex justify-end flex-grow pr-2">
                            @if($item['cd'] != false)
                            <div class="mr-2 flex">
                                <div>
                                    <img src="{{  asset('img/cd.png') }}" alt="">
                                </div>
                                <div class="ml-1">
                                    <p>{{$item['cd']}}</p>
                                </div>
                            </div>
                            @endif
                            @if($item['mc'] != false)
                            <div class="mr-2 flex">
                                <div>
                                    <img src="{{  asset('img/mana.png') }}" alt="">
                                </div>
                                <div class="ml-1">
                                <p>{{$item['mc']}}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                    <div class="p-2 bg-gray-800">
                        <p class="text-xs tracking-wide whitespace-pre-line">{{$active['desc']}}</p>
                    </div>
                    @endforeach
                </div>
                @endif
                @if(array_key_exists("passive",$item))
                <div class="flex flex-col mt-2 p-1">
                        @foreach($item['passive'] as $passive)
                        <div class="bg-gray-700 py-1 pl-2">
                            <p class="font-semibold text-md tracking-wide">Passive: {{$passive['name']}}</p>
                        </div>
                        <div class="p-2 bg-gray-800">
                            <p class="text-xs tracking-wide whitespace-pre-line">{{$passive['desc']}}</p>
                        </div>
                        @endforeach
                    </div>
                @endif
                <div class="flex flex-col mt-2 p-2">
                    <p class="text-sm italic text-gray-600">{{$item['lore']}}</p>

                </div>
            </div>

        </div>

