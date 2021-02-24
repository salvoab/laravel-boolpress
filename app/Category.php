<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    // Category in relazione One to Many con Article. Ogni Category hasMany Article 
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
