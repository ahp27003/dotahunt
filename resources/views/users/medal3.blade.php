



@if ( $player['rank_tier'] == null)

<div class="rankTierContainer">
        <div class="rankMedal-small">
            <img class="rankMedal-icon" src="
            {{  asset('img/medal/rank_icon_0.png') }}" alt="">


        </div>
    </div>
@else
<div class="rankTierContainer">
        <div class="rankMedal-small">
            <img class="rankMedal-icon" src="
            {{  asset('img/medal/rank_icon_' . substr($player['rank_tier'], 0, 1) . '.png') }}" alt="">
            <img class="rankMedal-star" src="{{  asset('img/medal/rank_star_' . substr($player['rank_tier'], 1, 1) . '.png') }}" alt="">

        </div>
    </div>
@endif
