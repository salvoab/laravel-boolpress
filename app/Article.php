<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'category_id'];

    //Article è in relazione Many to One con Category. Article belongsTo one Category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    //Article è in relazione Many to Many con Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
