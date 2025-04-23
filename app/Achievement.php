<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'tournament_name', 'date', 'place','team'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
