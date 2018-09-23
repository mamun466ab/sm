<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Session;

class CommonInsertController extends Controller {

    public function selectSubject(Request $request) {
        $selectSubValidator = Validator::make($request->all(), [
                    'stdid' => 'required|unique:stdsub,stdid',
                    'cmnsub' => 'required',
                        ], [
                    'stdid.required' => 'You can\'t leave this empty.',
                    'stdid.unique' => 'Already added this student.',
                    'cmnsub.required' => 'You can\'t leave this empty.',
        ]);

        if ($selectSubValidator->passes()) {
            $cmnsub = implode(',', $request->cmnsub);
            if ($request->extsub) {
                $extsub = implode(',', $request->extsub);
            } else {
                $extsub = "";
            }
            $slctSub = array();
            $slctSub['stdid'] = $request->stdid;
            $slctSub['sclcd'] = Session::get('usrInfo')->sclcd;
            $slctSub['sub'] = "$cmnsub";
            $slctSub['frthsub'] = $request->frtsub;
            $slctSub['extsub'] = $extsub;

            DB::table('stdsub')->insert($slctSub);
            return response()->json(['success' => '!!! Student subject added successfully. !!!']);
        } else {
            return response()->json(['errors' => $selectSubValidator->errors()]);
        }
    }

}
