<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{

    protected $fillable = [
        'name', 'start_date','end_date', 'venue', 'state', 'prizepool', 'organizer' , 'image'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();;
    }
}
