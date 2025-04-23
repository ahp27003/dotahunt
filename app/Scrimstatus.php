<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scrimstatus extends Model
{
    protected $fillable = [
        'team_id', 'opponent_id', 'status', 'date_time', 'notes'
    ];

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function enemy()
    {
        return $this->belongsTo('App\Team', 'opponent_id');
    }
}
