<?php

namespace App\Http\Controllers;


use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RecommendationController extends Controller
{
    //finder properties - what kind of player, finder want to find
    //product properties - stats player
    //constraint -
    //filter conditions - Mid player -> kill banyak, duit banyak, lane mid. etc


    //idea knowledge - player banyak duit -> tambah lagi prob dia core
    //               - player stack camp,wards -> tambah lagi supports dan maybe player tu versatile
    public function index()
    {
        $tours = Tournament::where('status', '=', 0)->get();
        return view('users.recommendation', compact('tours'));
    }


    public function search(Request $request)
    {
        //dd($request['rank']);

        //validation code
        $request->validate([
            'player_role' => ['required', Rule::in(['core', 'support']),],
            'position' => ['required', Rule::in(['carry', 'mid', 'offlaner', 'roamer', 'support']),],
            'rank' => 'required',
            'experience' => 'required',
            'tournament' => 'required',
            'winrate' => 'nullable|integer',
            'gpm' => [Rule::in([0, 200, 400, 600, 800])],
            'xppm' => [Rule::in([0, 200, 400, 600, 800])],
            'lasthit' => [Rule::in([0, 100, 200, 300, 400])],
            'tower_dmg' => [Rule::in([0, 3000, 6000, 9000])],
            'hero_dmg' => [Rule::in([0, 10000, 20000, 30000])],
            'ward' => [Rule::in([0, 5, 10, 15, 20])],
            'deward' => [Rule::in([0, 5, 10, 15, 20])],
            'kills' => [Rule::in([0, 5, 10, 15, 20])],
            'death' => [Rule::in([0, 5, 10, 15, 20])],
            'assists' => [Rule::in([0, 5, 10, 15, 20])],
        ]);

        //Constraints (cr)
        //player role = core -> position != roamer/support
        //player role = support -> position != carry/mid/offlaner

        if ($request['player_role'] == "core") {

            if ($request['position'] == "roamer" or $request['position'] == "support") {
                return back()->with('constraint', 'This position is not for core role');
            }
        } elseif ($request['player_role'] == "support") {

            if ($request['position'] == "carry" or $request['position'] == "mid" or $request['position'] == "offlaner") {
                return back()->with('constraint', 'This position is not for support role');
            }
        }

        $players = User::all();


        $userSteam = DB::table('users')
            ->join('linked_steam_accounts', 'users.id', '=', 'linked_steam_accounts.user_id')
            ->select('users.*')
            ->where('users.id', '!=', auth()->id())
            ->get();

        //dapatkan user yg dah connect steam
        $users = collect();
        foreach ($userSteam as $s) {
            $user = $players->find($s->id);
            $users->push($user);
        }


        //cf = Filter Conditions



        $result = collect(); //output player yg satisfied semua

        //find main role
        foreach ($users as $user) {

            $current = $user->knowledge['mid'];
            $role = 'mid';
            if ($user->knowledge['carry'] > $current) {
                $current = $user->knowledge['carry'];
                $role = 'carry';
            }
            if ($user->knowledge['support'] > $current) {
                $current = $user->knowledge['support'];
                $role = 'support';
            }
            if ($user->knowledge['roamer'] > $current) {
                $current = $user->knowledge['roamer'];
                $role = 'roamer';
            }
            if ($user->knowledge['offlaner'] > $current) {
                $current = $user->knowledge['offlaner'];
                $role = 'offlaner';
            }

            $medal = $user->accounts->getMedal();
            //cf
            //finder user have achievements or not
            $exp = DB::table('achievements')
                ->where('user_id', $user->id)
                ->count() > 0;

            $tour = Tournament::find($request['tournament']);
            $exists = $tour->users->contains($user->id);    //check whether user interested to join specific tournament
            //dd($exists);
            if ($request['position'] == $role) {

                foreach ($request['rank'] as $rank) {
                    if ($rank ==  $medal) {

                        if ($exists == true) {

                            //user`s winrate is more than requested winrate and user`s gpm/xppm/lasthit >= equal requested gpm/xppm/lasthit or requested gpm/xppm/lasthit = any
                            if (
                                $user->knowledge['winrate'] >= $request['winrate']
                                and ($user->knowledge['gpm'] >= $request['gpm'] or $request['gpm'] == 0)
                                and ($user->knowledge['xppm'] >= $request['xppm'] or $request['xppm'] == 0)
                                and ($user->knowledge['lasthit'] >= $request['lasthit'] or $request['lasthit'] == 0)
                                and ($user->knowledge['hero_dmg'] >= $request['hero_dmg'] or $request['hero_dmg'] == 0)
                                and ($user->knowledge['tower_dmg'] >= $request['tower_dmg'] or $request['tower_dmg'] == 0)
                                and ($user->knowledge['ward'] >= $request['ward'] or $request['ward'] == 0)
                                and ($user->knowledge['deward'] >= $request['deward'] or $request['deward'] == 0)
                                and ($user->knowledge['kills'] >= $request['kills'] or $request['kills'] == 0)
                                and ($user->knowledge['assists'] >= $request['assists'] or $request['assists'] == 0)
                                and ($user->knowledge['death'] >= $request['death'] or $request['death'] == 0)
                            ) {

                                if ($request['experience'] == 1 and $exp == true) {
                                    $result->push($user);
                                } elseif ($request['experience'] == 2 and $exp == false) {
                                    $result->push($user);
                                } elseif ($request['experience'] == 0 and ($exp == true or $exp == false)) {
                                    $result->push($user);
                                }
                            }
                        }
                    }
                }
            }
        }
        //dd($result[0]->knowledge);
        $pos = $request['position'];
        return view('users.recommendationResult', compact('result', 'pos'));
    }

    // Vc (finder properties/requiremet) =
    //     player role -> core or support (optional = kasi pos apa 1/2/3/4/5)
    //     position -> carry/mid/offlaner or roamer/support (1/2/3/4/5)
    //     rank -> archon -> or more
    //     exp -> yes or no
    //     tournament -> nama tournament apa nak join tu;

    // vprod (product properties) =
    //     name
    //     position = calculate whether dia bayak main support or core (utk optional amik dari input user)
    //     experience = yes/no

    // cr - example:
    //                 player role = core -> position != roamer/support
    //                 player role = support -> position != carry/mid/offlaner

    // cf - example:
    //                 player role = core -> position =  carry/mid/offlaner *reserve
    //                 player role = support -> position =  roamer/support *reserve
    //                 exp = yes -> experiece = yes

    // cprod - list player yg mematuhi semua constraint

    //buat scheduler untuk generate user tu core or support player.

}
