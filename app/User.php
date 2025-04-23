<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use Notifiable;
    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'age', 'state', 'area', 'birthdate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'is_admin' => 'boolean',
    ];

    public function accounts()
    {
        return $this->hasOne(LinkedSteamAccount::class);
    }

    public function team()
    {
        return $this->belongsToMany('App\Team', 'user_team')->withTimestamps();
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament')->withTimestamps();
    }


    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function statistic()
    {
        return $this->hasOne(Statistic::class);
    }

    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    public function knowledge()
    {
        return $this->hasOne(Knowledge::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
