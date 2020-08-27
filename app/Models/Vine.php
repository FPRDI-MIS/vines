<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vine extends Model
{
    public function pictures()
    {
        return $this->hasMany('App\Models\Picture');
    }
}
