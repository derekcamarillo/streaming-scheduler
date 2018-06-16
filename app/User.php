<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects() {
        return $this->hasMany('App\Project');
    }

    public function playlists() {
        return $this->hasMany('App\Playlist');
    }

    public function videoclips() {
        return $this->hasMany('App\Videoclip');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function logos() {
        return $this->hasMany('App\Logo');
    }

    public function histories() {
        return $this->hasMany('App\History');
    }
}
