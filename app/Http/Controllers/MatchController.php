<?php

namespace App\Http\Controllers;

use App\DotaJson;
use App\Match;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show($match)
    {

        $matches = Match::where('match_id', $match)->first();

        //dd($matches->match_id);

        $itemsData = DotaJson::first();
        //dd($matches->match_details['chat']);

        //  foreach ($matches->match_details['players'] as $m)
        //  {
        //     if(array_key_exists("personaname", $m)){
        //         echo $m['personaname'];
        //         echo "<br>";
        //     }
        //  }


        return view('users.matches.match', compact('matches', 'itemsData'));
    }

    public function skills($match)
    {
        $matches = Match::where('match_id', $match)->first();
        $itemsData = DotaJson::first();
        return view('users.matches.match_skills', compact('matches', 'itemsData'));
    }

    public function performance($match)
    {
        $matches = Match::where('match_id', $match)->first();
        $itemsData = DotaJson::first();
        return view('users.matches.match_performance', compact('matches', 'itemsData'));
    }
}
