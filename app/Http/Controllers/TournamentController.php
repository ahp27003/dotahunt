<?php

namespace App\Http\Controllers;

use App\Events\TournamentAdded;
use App\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournamen = Tournament::where('status', '=', 0)->get();

        $tournament = $tournamen->where('end_date', '>', Carbon::now());

        return view('tournaments.index', compact('tournament'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.tourCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->image);
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after_or_equal:now',
            'venue' => 'required|regex:/^[\pL\s\-]+$/u',
            'state' => 'required',
            'prizepool' => 'required|numeric|digits_between:1,9',
            'organizer' => 'required',
            'image' => 'required|image|max:1999'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->storeAs('public/tour', $filename);
            $request->image = $filename;
        }

        // dd($request->image);


        $t = Tournament::create([
            'name' => $request['name'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'venue' => $request['venue'],
            'state' => $request['state'],
            'prizepool' => $request['prizepool'],
            'organizer' => $request['organizer'],
            'image' => $request->image
        ]);
        //dd($t->id);

        event(new TournamentAdded($t));

        return redirect('/admin/tournaments');
    }

    public function interested(Tournament $tournament)
    {

        $id = auth()->user()->id;

        $tournament->users()->attach($id);

        return back()->with('interest', 'Added to interest list');
    }

    public function notInterested(Tournament $tournament)
    {

        $id = auth()->user()->id;

        $tournament->users()->detach($id);

        return back()->with('notInterest', 'Remove from interest list');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        return view('admins.tourEdit', compact('tournament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'venue' => 'required|regex:/^[\pL\s\-]+$/u',
            'state' => 'required|regex:/^[\pL\s\-]+$/u',
            'prizepool' => 'required|numeric|digits_between:1,9',
            'organizer' => 'required|regex:/^[\pL\s\-]+$/u',
            'image' => 'image|max:1999'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->storeAs('public/tour', $filename);
            $request->image = $filename;
        } else {
            $request->image = $tournament->image;
        }

        $tournament->name = $request['name'];
        $tournament->image = $request->image;
        $tournament->start_date = $request['start_date'];
        $tournament->end_date = $request['end_date'];
        $tournament->venue = $request['venue'];
        $tournament->state = $request['state'];
        $tournament->prizepool = $request['prizepool'];
        $tournament->organizer = $request['organizer'];
        $tournament->save();
        return redirect('/admin/tournaments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        //
    }

    public function status(Tournament $tournament)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $tournament->status = 1;
        $tournament->save();
        return redirect('/admin/tournaments');
    }
}
