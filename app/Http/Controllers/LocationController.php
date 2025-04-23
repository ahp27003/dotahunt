<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.map');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = request()->all();
        //dd($input);
        try {
            $loc = new Location();
            
            // Handle different database drivers
            if (DB::connection()->getDriverName() === 'mysql') {
                // For MySQL, use the Point class from the spatial package
                $pointClass = '\Grimzy\LaravelMysqlSpatial\Types\Point';
                $loc->coordinate = new $pointClass($input['latitude'], $input['longitude']);    // (lat, lng)
            } else {
                // For PostgreSQL, store as array
                $loc->coordinate = [
                    'lat' => $input['latitude'],
                    'lng' => $input['longitude']
                ];
            }
            
            $loc->user_id = $input['user_id'];
            $loc->address = $input['address'];
            $loc->save();


            return response()->json([
                'status' => 'success',
                'msg'    => 'Okay',
            ], 201);
        } catch (QueryException $exception) {

            return response()->json([
                'status' => 'error',
                'msg'    => 'You already set your location',
                // 'errors' => $exception->errors(),
            ], 422);
        }
        //dd($lol);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(location $location)
    {
        //
    }

    public function search()
    {

        if (auth()->user()->location == null) {
            return view('users.map');
        }
        $users = User::where('id', '!=', auth()->user()->id)->get();

        $locations = \collect([]);
        $owner = \collect([]);
        $accounts = \collect([]);

        foreach ($users as $user) {
            if ($user->location != null) {
                $locations->push($user->location);
                $owner->push($user);
                $accounts->push($user->accounts);
            }
        }

        $myLoc = location::where('user_id', '=', auth()->user()->id)->first();
        return view('users.map_search', compact('owner', 'locations', 'accounts', 'myLoc'));
    }
    public function json()
    {
        //$locations = location::where('user_id', '!=', auth()->user()->id)->get();
        $users = User::where('id', '!=', auth()->user()->id)->get();

        $locations = \collect([]);
        $owner = \collect([]);
        $accounts = \collect([]);

        foreach ($users as $user) {
            if ($user->location != null) {
                $locations->push($user->location);
                $owner->push($user);
                $accounts->push($user->accounts);
            }
        }

        $my = location::where('user_id', '=', auth()->user()->id)->first();
        
        // Handle different database drivers for coordinate access
        $center = null;
        if ($my) {
            if (DB::connection()->getDriverName() === 'pgsql') {
                // For PostgreSQL, access latitude and longitude directly
                $center = [
                    'lat' => $my->latitude,
                    'lng' => $my->longitude
                ];
            } else {
                // For MySQL, access through the spatial object
                $center = $my->coordinate;
            }
        }
        
        return response()->json([
            'center' => $center,
            'users' => $owner,
            'locations' => $locations,
            'accounts' => $accounts
        ], 201);
    }
}
