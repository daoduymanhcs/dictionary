<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //

    public function scopeSearch($query,$author_name)
    {
        return $query->where('author_name', '=', $author_name)->get();
    }
}
