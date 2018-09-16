<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class AdminInsertController extends Controller
{
    public function addSubject(Request $request){
        $subjectValidator = Validator::make($request->all(), [
            'subnme' => 'required|max:30',
            'subcde' => 'required|max:10',
        ],[
            'subnme.required' => 'You can\'t leave this empty.',
            'subcde.required' => 'You can\'t leave this empty.',
            
            'subnme.max' => 'Maximum 30 character.',
            'subcde.max' => 'Maximum 10 character.',
        ]);
        
        if($subjectValidator->passes()){
            $extSub = array();
            $extSub['sclcd'] = Session::get('usrInfo')->sclcd;
            $extSub['exsub'] = ucfirst($request->subnme);
            $extSub['exsubcd'] = $request->subcde;
            
            DB::table('extsub')->insert($extSub);
            return response()->json(['success' => '!!! Extra subject added successfully. !!!']);
        } else {
            return response()->json(['errors' => $subjectValidator->errors()]);
        }
    }
}
