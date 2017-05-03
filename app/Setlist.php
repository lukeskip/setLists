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
        return $this->belongsToMany('App\Song')->withPivot('position')->orderBy('setlist_song.position', 'asc');
    }


}
