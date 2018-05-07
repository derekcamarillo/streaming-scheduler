<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    //
    public function playlists() {
        return $this->belongsToMany('App\Playlist', 'project_playlist');
    }

    public function activatedPlaylist() {

    }

    public function logo() {
        return $this->belongsTo('App\Logo');
    }
}
