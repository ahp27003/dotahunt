<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\LinkedSteamAccount;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index($player)
    {


        $steam = LinkedSteamAccount::where('dota_id', $player)->first();
        $users = $steam->user;
        $achievements = $users->achievements()->paginate(7);

        // $achievements = $users->achievements;
        //dd($achievements);
        //$achievements = auth()->user()->achievements;

        return view('users.achievement.index', compact('achievements', 'users'));
    }

    public function get($player)
    {

        $steam = LinkedSteamAccount::where('dota_id', $player)->first();
        $users = $steam->user;
        //$achievements = $users->achievements;

        $achievements = Achievement::where('user_id', $users->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        //dd($achievements);
        return response()->json($achievements);
    }

    public function create()
    {
        $id = auth()->user()->accounts->dota_id;
        return view('users.achievement.create', compact('id'));
    }

    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'tournament_name' => 'required',
            'date' => 'required|before_or_equal:now',
            'place' => 'required',
            'team' => 'required'
        ]);

        //dd(auth()->user());

        $achievement = auth()->user()->achievements()->create([
            'tournament_name' => $request['tournament_name'],
            'date' => $request['date'],
            'place' => $request['place'],
            'team' => $request['team'],
        ]);

        $id = auth()->user()->accounts->dota_id;

        return redirect('/players/' . $id . '/achievements');
    }

    public function update(Request $request, Achievement $achievement)
    {
        //dd($request->tournament_name);



        $achievement->tournament_name = $request->tournament_name;
        $achievement->team = $request->team;
        $achievement->date = $request->date;
        $achievement->place = $request->place;
        $achievement->save();
    }

    public function destroy($player, Achievement $achievement)
    {

        $achievement->delete();


        return back()->with('success', 'Successfully delete the achievement');
    }
}
