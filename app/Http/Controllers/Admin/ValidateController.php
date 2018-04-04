<?php

namespace App\Http\Controllers\Admin;

use App\Meaning;
use App\Word;

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
        $meanings = $datas->items();
        $meaningIds = array();
        foreach ($meanings as $key => $meaning) {
            array_push($meaningIds, $meaning->id);
        }
        $ids = implode (",", $meaningIds);
/*        $array = explode(',', $str);
        dd($array);*/
    	return view('admin.validate.validate')->with('datas', $datas)->with('ids', $ids);
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
    /*update all page meaning status*/
    public function updatePageMeaningStatus(Request $request) {
        $idMeaningArray = $request->input('id_meaning_array');
        Meaning::whereIn('id', $idMeaningArray)->update(['meaning_status' => 1]);
        $reponseArray = array('status' => true, 'id_meaning_array' => $idMeaningArray);
        echo json_encode($reponseArray);
    }

    public function searchWord(Request $request) {
        if ($request->isMethod('get')) {
            return view('admin.validate.search');
        }
        $validatedData = $request->validate([
            'word' => 'required',
        ]);
        $word = $request->input('word');
        $word_name = vi_slug($word);
        $data = Word::searchByWord($word_name);
        return view('admin.validate.search')->with('datas', $data);
    }

    // edit word and meaning
}
