<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'text', 'effect', 'speed', 'xpos', 'ypos', 'fonttype', 'fontsize', 'fontcolor'
    ];
}
