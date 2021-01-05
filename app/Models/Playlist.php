<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{

    public function songs()
    {
        return $this->hasMany('App\Models\Song');
    }
}
