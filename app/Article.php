<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body'];

    //Article è in relazione Many to One con Category. Article belongsTo one Category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
