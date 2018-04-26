<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videoclip extends Model
{
    //
    protected $fillable = [
        'title', 'url'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function message() {
        return $this->belongsTo('App\Message');
    }
}
