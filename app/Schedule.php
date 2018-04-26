<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $fillable = [
        'playlist_id', 'start_time', 'end_time', 'endless', 'days', 'months'
    ];
}
