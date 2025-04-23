
@if(array_key_exists("lane_role",$player))

    @if ($player['lane_role'] == 1)
        Safe
    @elseif($player['lane_role'] == 2)
    Mid
    @elseif($player['lane_role'] == 3)
    Off
    @elseif($player['lane_role'] == 4)
    Jungle
    @else
    Unknown
    @endif
@else
    Unknown
@endif
