<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'mid',
        'carry',
        'roamer',
        'support',
        'offlaner',
        'winrate',
        'gpm',
        'xppm',
        'lasthit',
        'hero_dmg',
        'tower_dmg',
        'ward',
        'deward',
        'kills',
        'assists',
        'death',
        'matches'

    ];


    public function mainRole()
    {

        $current = $this->mid;
        //dd($current);
        $role = 'mid';
        if ($this->carry > $current) {
            $current = $this->carry;
            $role = 'carry';
        }
        if ($this->support > $current) {
            $current = $this->support;
            $role = 'support';
        }
        if ($this->roamer > $current) {
            $current = $this->roamer;
            $role = 'roamer';
        }
        if ($this->offlaner > $current) {
            $current = $this->offlaner;
            $role = 'offlaner';
        }

        return $role;
    }
}
