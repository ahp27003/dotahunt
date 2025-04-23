<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedSteamAccount extends Model
{

    protected $fillable = ['provider_name', 'provider_id','avatar_url','dota_id',
    'profile_url','steam_name', 'mmr', 'win_lose',  'medal', 'country',
    'leaderboard_rank'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMedal()
    {
        //dd($this->medal[0]);
        if($this->medal[0] == null)
        {
            return "uncalibrated";
        }
        elseif($this->medal[0] == 1)
        {
            return "herald";
        }
        elseif($this->medal[0] == 2)
        {
            return "guardian";
        }
        elseif($this->medal[0] == 3)
        {
            return "crusader";
        }
        elseif($this->medal[0] == 4)
        {
            return "archon";
        }
        elseif($this->medal[0] == 5)
        {
            return "legend";
        }
        elseif($this->medal[0] == 6)
        {
            return "ancient";
        }
        elseif($this->medal[0] == 7)
        {
            return "divine";
        }
        elseif($this->medal[0] == 8)
        {
            return "immortal";
        }
    }

    protected $casts = [
        'win_lose' => 'json'];

}
