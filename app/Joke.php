<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joke extends Model
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'value'
    ];
}
