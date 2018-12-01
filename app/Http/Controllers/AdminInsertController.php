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
    
    public function classTime(Request $clstm){
        $totalNum = $clstm->ttlnum;
        for($i = 1; $i <= $totalNum; $i++){
            $field = 'clstme' . $i;
            $clsTme = array();
            $clsTme['sclcd'] = Session::get('usrInfo')->sclcd;
            $clsTme['clstme'] = $clstm->$field;
            $clsTme['clsnum'] = $i;
            
            DB::table('clstme')->insert($clsTme);
        }
        return Redirect::to('/class-time/');
    }
    
    public function routineCreate(Request $rtnSub){
        $ttlCls = $rtnSub->ttlcls;
        for($i = 1; $i <= $ttlCls; $i++){
            $clstme = 'clstme' . $i;
            $sat = 'sat' . $i;
            $sun = 'sun' . $i;
            $mon = 'mon' . $i;
            $tue = 'tue' . $i;
            $wed = 'wed' . $i;
            $thu = 'thu' . $i;
            
            $clsRtn = array();
            $clsRtn['sclcd'] = Session::get('usrInfo')->sclcd;
            $clsRtn['cls'] = $rtnSub->cls;
            $clsRtn['clstme'] = $rtnSub->$clstme;
            $clsRtn['sat'] = $rtnSub->$sat;
            $clsRtn['sun'] = $rtnSub->$sun;
            $clsRtn['mon'] = $rtnSub->$mon;
            $clsRtn['tue'] = $rtnSub->$tue;
            $clsRtn['wed'] = $rtnSub->$wed;
            $clsRtn['thu'] = $rtnSub->$thu;
            
            DB::table('clsrtn')->insert($clsRtn);
        }
        return Redirect::to('/create-routine/');
    }
}
