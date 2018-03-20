<?php

namespace App\Http\Controllers;

use App\User;
use Session;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // return view('admin.layouts.login');
        if ($request->isMethod('post')) {
            //
            $key = env('APP_KEY', 'forge');
            $data = User::row($request->input('email'), md5($request->input('password').$key));
            if($data->isEmpty()) {
                echo "Hello";
            } else {
                $data = $data->toArray();
                Session::put('userSession',$data[0]);
                Session::save();
            }
        }
        if ($request->isMethod('get')) {
            //
            return view('admin.layouts.login');
        }
    }
}
