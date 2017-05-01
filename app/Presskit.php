<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presskit extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'name','history','genre','sound'
    ];
}
