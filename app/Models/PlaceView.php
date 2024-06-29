<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceView extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'place_id',
        'user_id',
    ];
}
