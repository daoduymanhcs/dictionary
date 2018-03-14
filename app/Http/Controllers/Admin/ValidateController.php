<?php

namespace App\Http\Controllers\Admin;

use App\Meaning;

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

    /*delete meaning*/
    public function deleteMeaning(Request $request) {
        // Encoding array in JSON format
        $id = $request->input('meaning_id');
        $meaning = Meaning::find($id);
        $meaning->delete();
        $reponseArray = array('status' => true, 'id' => $id);
        echo json_encode($reponseArray);
    }

    /*update meaning status*/
    public function updateMeaningStatus(Request $request) {
        $id = $request->input('meaning_id');
        $meaning = Meaning::find($id);
        $meaning->meaning_status = 1;
        $meaning->save();    
        $reponseArray = array('status' => true, 'id' => $id);
        echo json_encode($reponseArray);    
    }
}
