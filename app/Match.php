<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['match_id','match_details'];

    protected $casts = [

        'match_details' => 'array'
    ];

}
