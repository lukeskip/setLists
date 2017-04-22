<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function setlists()
    {
        return $this->belongsTo('App\Setlist');
    }
}
