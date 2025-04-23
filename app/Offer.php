<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'team_id', 'user_id', 'status'
    ];

    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
