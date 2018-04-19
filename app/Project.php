<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    public function playlists() {
        return $this->belongsToMany('App\Playlist');
    }

    public function logo() {
        return $this->belongsTo('App\Logo');
    }
}
