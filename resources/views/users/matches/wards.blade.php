@if($player['obs_placed'] === null and $player['sen_placed'] === null)
    Not recorded
@else
{{$player['obs_placed']}} / {{$player['sen_placed']}}
@endif
