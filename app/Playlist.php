<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'title'
    ];

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
