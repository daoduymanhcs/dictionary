<?php

namespace App\Http\Controllers;

use App\Word;
use App\Meaning;
use App\Author;

use Cookie;

use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index()
	{
		//dd($_SERVER);
	    $data = Meaning::top();
	    return view('index')->with('datas', $data);
	}
}
