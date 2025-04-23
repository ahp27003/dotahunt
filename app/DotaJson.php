<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DotaJson extends Model
{
    protected $casts = [
        'items' => 'array',
        'heroes' => 'array',
        'hero_roles' => 'array',
        'region' => 'array',
        'abilities' => 'array',
        'ability_id' => 'array',
        'item_id' => 'array',
    ];
}
