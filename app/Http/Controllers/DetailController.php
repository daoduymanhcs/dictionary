<?php

namespace App\Http\Controllers;

use App\Meaning;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    public function index(Request $request, $slug)
    {
    	$word = ucfirst(str_replace("-"," ",$slug));
    	$data = Meaning::detail($slug);
    	return view('detail')->with('datas', $data)
    							->with('word', $word);
    }
}
