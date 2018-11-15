<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Session;

class AdminUpdateController extends Controller {

    public function subjectChange(Request $subAll) {
        $changeSubValidator = Validator::make($subAll->all(), [
                    'stdid' => 'required',
                    'cmnsub' => 'required',
                        ], [
                    'stdid.required' => 'You can\'t leave this empty.',
                    'cmnsub.required' => 'You can\'t leave this empty.',
        ]);

        if ($changeSubValidator->passes()) {
            $cmnsub = implode(',', $subAll->cmnsub);
            if (!empty($subAll->extsub)) {
                $extsub = implode(',', $subAll->extsub);
            } else {
                $extsub = NULL;
            }
            
            $slctSub = array();
            $slctSub['sub'] = "$cmnsub";
            $slctSub['frthsub'] = $subAll->frtsub;
            $slctSub['extsub'] = $extsub;

            if (DB::table('stdsub')->where('stdid', $subAll->stdid)->update($slctSub)) {
                return response()->json(['success' => '!!! Student subject Changed successfull. !!!']);
            } else {
                return response()->json(['success' => '!!! Connection Error. !!!']);
            }
        } else {
            return response()->json(['errors' => $changeSubValidator->errors()]);
        }
    }

    public function userActivate($usrid) {
        $slctSub = array();
        $slctSub['usrsts'] = 1;
        DB::table('usrreg')->where('id', $usrid)->update($slctSub);
        return Redirect::to('/user-activation/');
    }
    
    public function userBlock($usrid) {
        $slctSub = array();
        $slctSub['usrsts'] = 2;
        DB::table('usrreg')->where('id', $usrid)->update($slctSub);
        return Redirect::to('/block-unblock/');
    }
    
    public function userUnblock($usrid) {
        $slctSub = array();
        $slctSub['usrsts'] = 1;
        DB::table('usrreg')->where('id', $usrid)->update($slctSub);
        return Redirect::to('/block-unblock/');
    }
    
    public function clsRtnEdt(Request $rtnSub){
        $rtnid = $rtnSub->rtnid;
        $edtedrtn = array();
        $edtedrtn['sat'] = $rtnSub->sat;
        $edtedrtn['sun'] = $rtnSub->sun;
        $edtedrtn['mon'] = $rtnSub->mon;
        $edtedrtn['tue'] = $rtnSub->tue;
        $edtedrtn['wed'] = $rtnSub->wed;
        $edtedrtn['thu'] = $rtnSub->thu;
        DB::table('clsrtn')->where('id', $rtnid)->update($edtedrtn);
        return Redirect::to('/view-routine/');
    }
    
    public function exmRtnEdt(Request $exmsub){
        $rtnid = $exmsub->exmid;
        $edtedrtn = array();
        $edtedrtn['fstsub'] = $exmsub->fstsub;
        $edtedrtn['sndsub'] = $exmsub->sndsub;
        DB::table('exmrtn')->where('id', $rtnid)->update($edtedrtn);
        return Redirect::to('/view-exam-routine/');
    }

}
