<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Session;

class AdminUpdateController extends Controller
{
    public function subjectChange(Request $subAll){
        $changeSubValidator = Validator::make($subAll->all(), [
                    'stdid' => 'required',
                    'cmnsub' => 'required',
                        ], [
                    'stdid.required' => 'You can\'t leave this empty.',
                    'cmnsub.required' => 'You can\'t leave this empty.',
        ]);

        if ($changeSubValidator->passes()) {
            $cmnsub = implode(',', $subAll->cmnsub);
            if ($subAll->extsub) {
                $extsub = implode(',', $subAll->extsub);
            } else {
                $extsub = "";
            }
            $slctSub = array();
            $slctSub['sub'] = "$cmnsub";
            $slctSub['frthsub'] = $subAll->frtsub;
            $slctSub['extsub'] = $extsub;

            if(DB::table('stdsub')->where('stdid', $subAll->stdid)->update($slctSub)){
                return response()->json(['success' => '!!! Student subject Changed successfull. !!!']);
            } else {
                return response()->json(['success' => '!!! Connection Error. !!!']);
            }
        } else {
            return response()->json(['errors' => $changeSubValidator->errors()]);
        }
    }
}