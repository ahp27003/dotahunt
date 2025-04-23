<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {;

        if (Auth::user()->accounts()->exists() == true) {

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

            $count = count($players);

            $teams = count(Team::all());

            return view('home', compact('count', 'teams'));
        } else {
            return view('auth.steam');
        }
    }
}
