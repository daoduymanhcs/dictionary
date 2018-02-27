<?php

namespace App\Http\Controllers;

use App\Word;
use App\Meaning;
use App\Author;

use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index()
	{
	    $data = Meaning::top(12);
	    return view('index')->with('datas', $data);
	    dd($data);
	}
}
