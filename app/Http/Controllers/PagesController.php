<?php

namespace App\Http\Controllers;

use App\DotaJson;
use App\LinkedSteamAccount;
use App\Offer;
use App\Scrimstatus;
use App\Statistic;
use App\Team;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    public function show($player)
    {
        $fetchPlayers =  LinkedSteamAccount::where('dota_id', $player)->firstOrFail();

        $user = $fetchPlayers->user;

        return view('users.profile', compact('fetchPlayers', 'user'));
    }


    public function steam()
    {
        return view('auth.steam');
    }

    public function noti()
    {
        //user noti

        dd('sala');
        $id = auth()->user()->id;
        $receivedTeam = Team::where('captain_id', $id)->first();



        $inviteNotis = Scrimstatus::where('opponent_id', $receivedTeam->id)->get();

        $senderTeam = Team::where('captain_id', $id)->first();
        $acceptedNoti = Scrimstatus::where('team_id', $senderTeam->id)->get();



        return view('users.notificationFeedback', compact('inviteNotis', 'acceptedNoti'));
    }

    public function notiScrim()
    {
        //team noti
        $id = auth()->user()->id;
        $receivedTeam = Team::where('captain_id', $id)->first();

        if ($receivedTeam == null) {
            return view('teams.notification');
        }
        $inviteNotis = Scrimstatus::where('opponent_id', $receivedTeam->id)->get();

        // dd($scrimStatus);

        $senderTeam = Team::where('captain_id', $id)->first();
        $acceptedNoti = Scrimstatus::where('team_id', $senderTeam->id)->get();

        //dd($acceptedNoti->toArray());


        return view('teams.notification', compact('inviteNotis', 'acceptedNoti'));
    }


    public function adminIndex()
    {
        return view('admins.index');
    }

    public function adminTour()
    {
        $tournamen = Tournament::all();

        $tournament = $tournamen->where('end_date', '>', Carbon::now());
        return view('admins.tourList', compact('tournament'));
    }

    public function stats($player)
    {

        $fetchPlayers =  LinkedSteamAccount::where('dota_id', $player)->first();
        $statistics = $fetchPlayers->user->statistic;
        $itemsData = DotaJson::first();
        if ($statistics != null) {
            $items = collect($statistics->recent_match);

            $page = Input::get('page', 1);

            $perPage = 10;

            $pageStats = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page);
            $pageStats->setPath(url()->current());
            //dd(url()->current());
            return view('users.stats', compact('fetchPlayers', 'pageStats', 'itemsData'));
        } else {

            return view('users.stats_none', compact('fetchPlayers'));
        }
    }

    public function heroes($player)
    {
        $fetchPlayers =  LinkedSteamAccount::where('dota_id', $player)->first();
        $statistics = $fetchPlayers->user->statistic;
        $itemsData = DotaJson::first();
        if ($statistics != null) {
            $items = collect($statistics->heroes_played);
            $page = Input::get('page', 1);

            $perPage = 10;
            $pageHeroes = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page);
            $pageHeroes->setPath(url()->current());


            return view('users.stats_heroes', compact('fetchPlayers', 'pageHeroes', 'itemsData'));
        } else {
            return view('users.stats_heroes_none', compact('fetchPlayers'));
        }
    }

    public function totals($player)
    {
        $fetchPlayers =  LinkedSteamAccount::where('dota_id', $player)->first();
        $statistics = $fetchPlayers->user->statistic;

        if ($statistics != null) {
            return view('users.stats_totals', compact('fetchPlayers', 'statistics'));
        } else {
            return view('users.stats_totals_none', compact('fetchPlayers'));
        }
    }
    public function stream()
    {
        $client = new Client(['headers' => ['Client-ID' => 'h3f0ad5gvsiorouqp8c01xjnybz5en']]);
        $response = $client->get('https://api.twitch.tv/helix/streams?game_id=29595&language=en&first=10');
        $streams = json_decode($response->getBody(), true)['data'];

        $items = collect($streams);
        $page = Input::get('page', 1);
        $perPage = 2;
        $pageStream = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page);
        $pageStream->setPath(url()->current());
        //dd(url()->current());
        //dd($pageStream);




        return view('users.streams', compact('pageStream'));
    }
}
