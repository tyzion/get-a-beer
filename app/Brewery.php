<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Brewery extends Model
{

    use Searchable;

    protected $fillable = ['name', 'description', 'img'];

    public function toSearchableArray()
    {
        $birre = $this->beers->pluck('name')->join(', ');

        $array = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'altro' => 'birrerie birra',
            'birre' => $birre,
    ];

        

        return $array;
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function beers()
    {
        return $this->belongsToMany(Beer::class);
    }
}
