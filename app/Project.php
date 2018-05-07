<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    //
    public function playlists() {
        return $this->belongsToMany('App\Playlist', 'project_playlist');
    }

    public function activatedPlaylist() {
        return $this->belongsToMany('App\Playlist', 'project_playlist')->wherePivot('activated', 1);
    }

    public function logo() {
        return $this->belongsTo('App\Logo');
    }
}
