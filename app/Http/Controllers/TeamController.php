<?php

namespace App\Http\Controllers;

use App\Notifications\KickPlayer;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$teams = DB::table('teams')->get();

        $myTeam = Auth()->user()->team->first();

        //dd($myTeam->id);
        if ($myTeam != null) {
            $captain = User::find($myTeam->captain_id);
            $players = DB::table('user_team')->where('team_id', $myTeam->id)->get();
            //dd($myTeam);
            $userid = Arr::pluck($players, 'user_id');
            $teamMembers = User::find($userid);

            return view('teams.myteam', compact('myTeam', 'teamMembers', 'captain'));
        }

        return view('teams.noteam');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = auth()->user()->id;

        return view('teams.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'captain_id' => 'required',
            'name' => 'required|unique:teams',
            'area' => 'required',
            'qtty_member' => 'required',
            'image' => 'required|image|max:1999',
            'description' => 'required|max:255',
            'state' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->storeAs('public/pics', $filename);
            $request->image = $filename;
        }


        //dd($request->image);
        try {
            $team = Team::create([
                'captain_id' => $request['captain_id'],
                'name' => $request['name'],
                'area' => $request['area'],
                'qtty_member' => $request['qtty_member'],
                'image' => $request->image,
                'state' => $request['state'],
                'description' => $request['description']
            ]);

            //dd($team->id);

            $user = auth()->user();
            $user->team()->attach($team->id);

            $path = $team->id;
            return redirect("teams");
        } catch (\Illuminate\Database\QueryException $e) {

            return back()->withError('You must leave your current team first before creating new one!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {

        //$myTeam = Auth()->user()->team->first();

        $captain = User::find($team->captain_id);
        //dd($captain);


        $players = DB::table('user_team')->where('team_id', $team->id)->get();
        //dd($myTeam);
        $userid = Arr::pluck($players, 'user_id');
        $teamMembers = User::find($userid);

        return view('teams.show', compact('team', 'teamMembers', 'captain'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //dd($team);
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //dd($request);
        if (auth()->user()->id == $team->captain_id) {
            $request->validate([
                'name' => 'required|unique:teams',
                'area' => 'required',
                'image' => 'required|image|max:1999',
                'description' => 'required|max:255',
                'state' => 'required'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $image->storeAs('public/pics', $filename);
                $request->image = $filename;
            }


            $team->name = $request['name'];
            $team->area = $request['area'];
            $team->state = $request['state'];
            $team->description = $request['description'];
            $team->image = $request->image;
            $team->sponsor = $request['sponsor'];
            $team->save();

            return redirect("teams");
        } else {
            return back()->with('cannot', 'Only Captain can edit team');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $id = auth()->user()->id;

        if ($id == $team->captain_id) {

            $team->delete();
        } else {
            return back()->with('cannot', 'Only Captain can delete team');
        }
        //return redirect('/teams');
    }

    public function readyScrim(Team $team)
    {
        $id = auth()->user()->id;

        // if($id == $team->captain_id){

        // $team->delete();
        //     }
        // else{
        //     return back()->with('cannot', 'Only Captain can delete team');
        // }
        if ($team->qtty_member < 5) {
            return back()->with('scrim', 'You need 5 players to scrim with others');
        }

        $team->scrim = true;
        $team->save();

        return back();
    }

    public function notReadyScrim(Team $team)
    {
        $id = auth()->user()->id;
        $team->scrim = false;
        $team->save();

        return back();
    }

    public function kick(User $user, Team $team)
    {

        $user->team()->detach($team->id);
        $team->qtty_member = $team->qtty_member - 1;
        $team->save();

        if ($team->scrim == true and $team->qtty_member < 5) {
            $team->scrim = false;
            $team->save();
        }

        $user->notify(new KickPlayer($team));
        //return back()->with('kick', 'The user has been kick!');
    }

    public function list()
    {
        $teams = Team::all();

        return view('teams.list', compact('teams'));
    }
}
