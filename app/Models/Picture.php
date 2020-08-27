<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function vines()
    {
        return $this->belongsTo('App\Models\Vine');
    }
}
