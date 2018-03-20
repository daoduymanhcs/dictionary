<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
	protected $table = 'words';
    // check word exist
    public function scopeRow($query,$core_name)
    {
        return $query->where('core_name', '=', $core_name)->get();
    }

    public function scopeTop($query,$number)
    {
        return $query->join('meanings', 'words.id', '=', 'meanings.word_id')
        				->orderBy('words.created_at', 'desc')
				        ->limit($number)
				        ->get();
    }  

    public function scopeAlphabet($query,$first_letter)
    {
        return $query->where('core_name', 'LIKE', $first_letter.'%')->select('core_name', 'updated_at')->get();
    }  
}
