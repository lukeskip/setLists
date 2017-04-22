<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setlist extends Model
{
	public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function songs()
    {
        return $this->hasMany('App\Song');
    }


}
