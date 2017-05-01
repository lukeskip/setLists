<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presskit_data extends Model
{
    public function presskits()
    {
        return $this->belongsTo('App\Presskit');
    }

    protected $fillable = [
        'section','label','value','sound','icon'
    ];
}
