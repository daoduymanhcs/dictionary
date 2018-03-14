<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meaning extends Model
{
    //
    protected $table = 'meanings';

    public function scopeTop($query)
    {
        return $query->join('words', 'meanings.word_id', '=', 'words.id')
        				->join('authors', 'meanings.author_id', '=', 'authors.id')
        				->where('meanings.meaning_status', '=', 1)
        				->orderBy('meanings.updated_at', 'desc')
        				->select('words.word_name', 'words.core_name', 'meanings.meaning_meaning', 'meanings.meaning_like', 'meanings.meaning_dislike', 'meanings.meaning_sex', 'authors.author_name')
				        // ->limit($number)
				        ->paginate(15);
    } 

    public function scopeDetail($query, $core_name)
    {
        return $query->join('words', 'meanings.word_id', '=', 'words.id')
                        ->join('authors', 'meanings.author_id', '=', 'authors.id')
                        ->where('meanings.meaning_status', '=', 1)
                        ->where('words.core_name', '=', $core_name)
                        ->orderBy('meanings.id', 'desc')
                        ->select('words.word_name', 'words.core_name', 'meanings.meaning_meaning', 'meanings.meaning_like', 'meanings.meaning_dislike', 'meanings.meaning_sex', 'authors.author_name')
                        ->get();
    } 

    public function scopeSearch($query, $word_id, $author_id)
    {
        return $query->where('word_id', '=', $word_id)->where('author_id', '=', $author_id)->get();
    }

    // validate
    public function scopeValidate($query)
    {
        return $query->join('words', 'meanings.word_id', '=', 'words.id')
                        ->join('authors', 'meanings.author_id', '=', 'authors.id')
                        ->where('meanings.meaning_status', '=', 0)
                        ->orderBy('meanings.id', 'desc')
                        ->select('words.word_name', 'words.core_name', 'meanings.id','meanings.meaning_meaning', 'meanings.meaning_like', 'meanings.meaning_dislike', 'meanings.meaning_sex', 'authors.author_name')
                        // ->limit($number)
                        ->paginate(15);
    } 

}
