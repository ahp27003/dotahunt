<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function index()
    {
        abort(403);
    }

    public function show(User $user)
    {
        $dotas = auth()->user();
        //dd($dotas->accounts->dota_id);
        //dd($dotas->accounts->toArray()); keluarkan accounts

        $player_id = $dotas->accounts->dota_id;

        $client = new Client(['base_uri'
        => 'https://api.opendota.com/api/']);

        $response = $client->get("players/$player_id");
        $playerInfos = json_decode($response->getBody(), true);

        return view('users.profile', compact('dotas', 'playerInfos'));
    }

    public function edit(User $user)
    {
        abort_if($user->id !== auth()->id(), 403);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'before:now'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255']
        ]);

        $age = Carbon::parse($request['birthdate'])->age;


        $user->name = $request['name'];
        $user->birthdate = $request['birthdate'];
        $user->age = $age;
        $user->area = $request['city'];
        $user->state = $request['state'];
        $user->save();

        $url = $user->accounts->dota_id;
        return back()->with('profile', 'Sucessfully update profile');
    }

    public function list()
    {
        $users = User::all();
        $filter = DB::table('users')
            ->join('linked_steam_accounts', 'users.id', '=', 'linked_steam_accounts.user_id')
            ->select('users.*')
            ->where('users.id', '!=', auth()->id())
            ->get();

        $players = collect();

        foreach ($filter as $f) {
            $user = $users->find($f->id);
            $players->push($user);
        }

        $page = Input::get('page', 1);

        $perPage = 6;
        $pagePlayers = new LengthAwarePaginator($players->forPage($page, $perPage), $players->count(), $perPage, $page);
        $pagePlayers->setPath(url()->current());

        return view('users.search_result', compact('players', 'pagePlayers'));
    }
}
