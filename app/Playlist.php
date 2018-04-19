<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    //
    public function message() {
        return $this->belongsTo('App\Message');
    }

    public function schedule() {
        return $this->hasOne('App\Schedule');
    }

    public function videoclips() {
        return $this->belongsToMany('App\Videoclip');
    }
}
