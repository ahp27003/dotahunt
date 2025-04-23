<?php

namespace App\Http\Controllers;

use App\Notifications\AcceptScrim;
use App\Notifications\OfferScrim;
use App\Notifications\RejectScrim;
use App\Scrimstatus;
use App\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;

class ScrimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $check = auth()->user()->team->first();
        //dd($myTeam);
        if ($check != null) {

            $myTeam = auth()->user()->team;
            foreach ($myTeam as $t) {
                $teamid = $t->id;
            }
            $teams = Team::where('scrim', true)->get()->except($teamid);
            return view('scrims.index', compact('teams'));
        }

        return view('teams.noteam');
    }

    public function add(Team $team)
    {

        $id = auth()->user()->id;

        $myTeam = Team::where('captain_id', $id)->first();
        //check captain or not
        if ($myTeam == null) {
            return back()->with('captain', 'Only Captain can request for scrims!');
        }
        if ($myTeam->scrim != 1) {
            return back()->with('scrim', 'You need to ready for scrim before can send invitation!');
        }
        return view('scrims.add', compact('team', 'myTeam'));
    }

    public function invite(Request $request)
    {

        $request->validate([
            'team_id' => 'required',
            'opponent_id' => 'required',
            'date_time' => 'required|after_or_equal:now',
            'notes' => 'required',
        ]);



        $inviteScrim = Scrimstatus::create([
            'team_id' => $request['team_id'],
            'opponent_id' => $request['opponent_id'],
            'status' => 'pending',
            'date_time' => $request['date_time'],
            'notes' => $request['notes']
        ]);

        $team = Team::where('id', $request['opponent_id'])->first();

        $user = User::where('id', $team->captain_id)->first();
        //dd($user);
        $user->notify(new OfferScrim($inviteScrim));

        return redirect('/scrims-schedule');
    }

    public function acceptScrim(Scrimstatus $status, DatabaseNotification $noti)
    {




        $id = auth()->user()->id;
        $myTeam = Team::where('captain_id', $id)->first();


        $myTeam->scrims()->attach($status->team_id, ['date_time' => $status->date_time]);

        $opponentTeam = Team::where('id', $status->team_id)->first();

        $opponentTeam->scrims()->attach($status->opponent_id, ['date_time' => $status->date_time]);

        $status->status = 'Accepted';
        $status->save();

        $sender = User::where('id', $opponentTeam->captain_id)->first();

        $sender->notify(new AcceptScrim($status, $myTeam));
        $noti->delete();
        return back()->with('success', 'Scrims added to schedule');
    }

    public function rejectScrim(Scrimstatus $status, DatabaseNotification $noti)
    {

        $id = auth()->user()->id;
        $myTeam = Team::where('captain_id', $id)->first();

        $status->status = 'Rejected';
        $status->save();

        $opponentTeam = Team::where('id', $status->team_id)->first();

        $sender = User::where('id', $opponentTeam->captain_id)->first();

        $sender->notify(new RejectScrim($status, $myTeam));
        $noti->delete();
        return back()->with('reject', 'Scrims is not added to schedule');
    }

    public function scrimList()
    {

        $id = auth()->user()->id;
        // $myTeam = Team::where('captain_id', $id)->first();


        $myT = auth()->user()->team;
        foreach ($myT as $t) {
            $teamid = $t->id;
        }
        $myTeam = Team::find($teamid);

        $scrims = $myTeam->scrims()->where('date_time', '>', Carbon::now())->get();
        //dd($myTeam->scrims->pivot);

        // $scrimTable = Scrimstatus::where('team_id', $myTeam->id)->get();

        //dd($myTeam);

        $scrimStatus = $myTeam->scrimStatus()->where('status', '!=', "Accepted")->where('date_time', '>', Carbon::now())->get();
        //dd($scrimStatus);

        return view('scrims.scrimlist', compact('scrims', 'scrimStatus'));
    }

    public function details($scrimid)
    {
        $scrimTable = DB::table('team_scrim')->find($scrimid);
        //dd($scrimTable);

        $myTeam = Team::find($scrimTable->team_id);
        $oppTeam = Team::find($scrimTable->opponent_id);

        //dd($oppTeam);
        return view('scrims.scrimDetails', compact('myTeam', 'oppTeam'));
    }

    public function status()
    {
        //buat nanti

        return view('scrims.status', compact('myTeam', 'oppTeam'));
    }
}
