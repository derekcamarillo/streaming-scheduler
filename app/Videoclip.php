<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videoclip extends Model
{
    //
    protected $fillable = [
        'title', 'url'
    ];

    public function message() {
        return $this->belongsTo('App\Message');
    }
}
