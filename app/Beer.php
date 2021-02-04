<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    public function breweries()
    {
        return $this->belongsToMany(Brewery::class);
    }
}
