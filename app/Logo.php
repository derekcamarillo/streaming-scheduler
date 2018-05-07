<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = [
        'url', 'position', 'xpos', 'ypos'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    //
    public function projects() {
        return $this->hasMany('App\Project');
    }
}
