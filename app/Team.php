<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'captain_id', 'name', 'area', 'age', 'qtty_member', 'image', 'state', 'sponsor', 'description'
    ];

    protected $casts = [
        'scrim' => 'boolean',

    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_team')->withTimestamps();
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function scrims()
    {
        return $this->belongsToMany(Team::class, 'team_scrim', 'team_id', 'opponent_id')->withPivot('id', 'date_time')->withTimestamps()->orderBy('date_time');;
    }

    public function scrimStatus()
    {
        return $this->hasMany('App\Scrimstatus');
    }
}
