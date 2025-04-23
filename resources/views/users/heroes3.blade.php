{{-- {{dd($itemsData->heroes)}} --}}
{{-- @foreach($itemsData->heroes as $hero)
    @if($hero['id'] == $player['hero_id'])
        {{ dd($hero['img'])}}
    @endif
@endforeach --}}
@foreach($itemsData->heroes as $hero)
@if ( $player['hero_id'] == null)
            <img src="
            {{  asset('img/heroes/default.png') }}" class="h-10">
@else
        @if($hero['id'] == $player['hero_id'])
        {{-- {{ dd($hero['img'])}} --}}

        <img  src="http://cdn.dota2.com{{$hero['img']}}" class="h-10">

        @endif


@endif
@endforeach

