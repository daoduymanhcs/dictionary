<?php

namespace App\Http\Controllers\Admin;

use App\Word;
use App\Meaning;
use App\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
    	$datas = Meaning::validate();
    	return view('admin.validate.validate')->with('datas', $datas);
    	dd($data);
    }
}
