<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['recent_match', 'heroes_played', 'tot_score',];

    protected $casts = [
        'recent_match' => 'array',
        'heroes_played' => 'array',
        'tot_score' => 'array',
    ];

    // public function getJsonField($value)
    // {
    //     return collect($value);
    // }
}
