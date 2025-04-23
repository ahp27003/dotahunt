@if ( $player['rank_tier'] == null)
<div>Unknown</div>
@else
    @if(substr($player['rank_tier'], 0, 1) == 1)
    <div>Herald[{{substr($player['rank_tier'], 1, 1)}}]</div>
    @elseif(substr($player['rank_tier'], 0, 1) == 2)
    <div>Guardian[{{substr($player['rank_tier'], 1, 1)}}]</div>
    @elseif(substr($player['rank_tier'], 0, 1) == 3)
    <div>Crusader[{{substr($player['rank_tier'], 1, 1)}}]</div>
    @elseif(substr($player['rank_tier'], 0, 1) == 4)
    <div>Archon[{{substr($player['rank_tier'], 1, 1)}}]</div>
    @elseif(substr($player['rank_tier'], 0, 1) == 5)
    <div>Legend[{{substr($player['rank_tier'], 1, 1)}}]</div>
    @elseif(substr($player['rank_tier'], 0, 1) == 6)
    <div>Ancient[{{substr($player['rank_tier'], 1, 1)}}]</div>
    @elseif(substr($player['rank_tier'], 0, 1) == 7)
    <div>Divine[{{substr($player['rank_tier'], 1, 1)}}]</div>
    @else
    <div>Immortal</div>
    @endif
@endif
