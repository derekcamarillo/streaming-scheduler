<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    //
    public function projects() {
        return $this->hasMany('App\Project');
    }
}
