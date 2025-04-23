

    @if ( $player->accounts['medal'] == null)

    <div class="rankTierContainer">
        <div class="rankMedal">
            <img class="rankMedal-icon w-24 h-auto" src="
            {{  asset('img/medal/rank_icon_0.png') }}" alt="">
        </div>
    </div>
@else

    @if($player->accounts['medal'] == 80)

        @if($player->accounts->leaderboard_rank <= 1000 and $player->accounts->leaderboard_rank > 100)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon w-24 h-auto" src="
                {{  asset('img/medal/rank_icon_' . $player->accounts->medal[0] . '.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-8 font-semibold shadow-md">{{$player->accounts->leaderboard_rank}}</span>

            </div>
        </div>
        @elseif($player->accounts->leaderboard_rank <= 100 and $player->accounts->leaderboard_rank > 10)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon w-24 h-auto" src="
                {{  asset('img/medal/rank_icon_' . $player->accounts->medal[0] . 'b.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-8 font-semibold shadow-md">{{$player->accounts->leaderboard_rank}}</span>

            </div>
        </div>
        @elseif($player->accounts->leaderboard_rank <= 10 and $player->accounts->leaderboard_rank > 1)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon w-24 h-auto" src="
                {{  asset('img/medal/rank_icon_' . $player->accounts->medal[0] . 'c.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-8 font-semibold shadow-md">{{$player->accounts->leaderboard_rank}}</span>

            </div>
        </div>
        @elseif($player->accounts->leaderboard_rank == 1)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon w-24 h-auto" src="
                {{  asset('img/medal/rank_icon_' . $player->accounts->medal[0] . 'c.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-8 font-semibold shadow-md">{{$player->accounts->leaderboard_rank}}</span>

            </div>
        </div>
        @else
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon w-24 h-auto" src="
                {{  asset('img/medal/rank_icon_' . $player->accounts->medal[0] . '.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-8 font-semibold shadow-md">{{$player->accounts->leaderboard_rank}}</span>
            </div>
        </div>
        @endif

    @else
    <div class="rankTierContainer">
        <div class="rankMedal">
            <img class="rankMedal-icon w-24 h-auto" src="
            {{  asset('img/medal/rank_icon_' . $player->accounts->medal[0] . '.png') }}" alt="">
            <img class="rankMedal-star mt-3" src="{{  asset('img/medal/rank_star_' . $player->accounts->medal[1] . '.png') }}" alt="">
        </div>
    </div>
    @endif
@endif
