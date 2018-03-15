<?php

namespace App\Http\Controllers\Object;

use App\Meaning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeaningController extends Controller
{
    //
	/*
		update meaning like
	*/
	public function updateMeaningLike(Request $request) {
		$id = $request->input('meaning_id');
		$meaning = Meaning::incrementLike($id);
		// dd($meaning);
        $reponseArray = array('status' => true, 'id' => $id);
        echo json_encode($reponseArray);
	}

	// update meaning dislike
	public function updateMeaningDislike(Request $request) {
		$id = $request->input('meaning_id');
		$meaning = Meaning::incrementDisLike($id);
		// dd($meaning);
        $reponseArray = array('status' => true, 'id' => $id);
        echo json_encode($reponseArray);		
	}
}
