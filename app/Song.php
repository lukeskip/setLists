<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function setlists()
    {
        return $this->belongsToMany('App\Setlist')->withPivot('position');;
    }

    protected $fillable = [
        'name','position','intencity','duration','user_id'
    ];
}
