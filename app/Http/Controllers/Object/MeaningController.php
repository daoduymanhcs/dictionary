<?php

namespace App\Http\Controllers\Object;

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
        $reponseArray = array('status' => true, 'id' => $id);
        echo json_encode($reponseArray);
	}
}
