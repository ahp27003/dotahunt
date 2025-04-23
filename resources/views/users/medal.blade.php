








@if ( $fetchPlayers->medal == null)

    <div class="rankTierContainer">
        <div class="rankMedal">
            <img class="rankMedal-icon" src="
            {{  asset('img/medal/rank_icon_0.png') }}" alt="">


        </div>
    </div>
@else

    @if($fetchPlayers->medal == 80)

        @if($fetchPlayers->leaderboard_rank <= 1000 and $fetchPlayers->leaderboard_rank > 100)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon" src="
                {{  asset('img/medal/rank_icon_' . $fetchPlayers->medal[0] . '.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-10 font-semibold shadow-md">{{$fetchPlayers->leaderboard_rank}}</span>

            </div>
        </div>
        @elseif($fetchPlayers->leaderboard_rank <= 100 and $fetchPlayers->leaderboard_rank > 10)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon" src="
                {{  asset('img/medal/rank_icon_' . $fetchPlayers->medal[0] . 'b.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-10 font-semibold shadow-md">{{$fetchPlayers->leaderboard_rank}}</span>

            </div>
        </div>
        @elseif($fetchPlayers->leaderboard_rank <= 10 and $fetchPlayers->leaderboard_rank > 1)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon" src="
                {{  asset('img/medal/rank_icon_' . $fetchPlayers->medal[0] . 'c.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-10 font-semibold shadow-md">{{$fetchPlayers->leaderboard_rank}}</span>

            </div>
        </div>
        @elseif($fetchPlayers->leaderboard_rank == 1)
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon" src="
                {{  asset('img/medal/rank_icon_' . $fetchPlayers->medal[0] . 'c.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-10 font-semibold shadow-md">{{$fetchPlayers->leaderboard_rank}}</span>

            </div>
        </div>
        @else
        <div class="rankTierContainer">
            <div class="rankMedal">
                <img class="rankMedal-icon" src="
                {{  asset('img/medal/rank_icon_' . $fetchPlayers->medal[0] . '.png') }}" alt="">
                <span class="text-orange-200 absolute self-center text-lg mt-10 font-semibold shadow-md">{{$fetchPlayers->leaderboard_rank}}</span>
            </div>
        </div>
        @endif

    @else
    <div class="rankTierContainer">
        <div class="rankMedal">
            <img class="rankMedal-icon" src="
            {{  asset('img/medal/rank_icon_' . $fetchPlayers->medal[0] . '.png') }}" alt="">
            <img class="rankMedal-star" src="{{  asset('img/medal/rank_star_' . $fetchPlayers->medal[1] . '.png') }}" alt="">
        </div>
    </div>
    @endif
@endif
