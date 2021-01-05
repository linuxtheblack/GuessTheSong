<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function playlist()
    {
        return $this->belongsTo('App\Models\Playlist');
    }
}
