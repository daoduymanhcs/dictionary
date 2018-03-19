<?php

namespace App\Http\Controllers;

use App\Meaning;
use App\Word;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    //
	public function index()
	{
		$alphebet = range('a','z');
	  	return response()->view('sitemap.index',[
						  		'alphabet' => $alphebet
						  	])->header('Content-Type', 'text/xml');
	}

	public function alphabet($a) {
		$data = Word::alphabet($a);
/*		foreach ($data as $key => $value) {
			echo $value->core_name.'<br>';
		} die;*/
		return response()->view('sitemap.alphabet',[
						        'data' => $data,
						    ])->header('Content-Type', 'text/xml');
	}

	public function common() {
	  	return response()->view('sitemap.common')->header('Content-Type', 'text/xml');		
	}
}
