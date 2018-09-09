<?php

namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class SigninController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usrInfo = Session::get('usrInfo');
        /* Signin check */
        if($usrInfo == NULL){
            return Redirect::to('/login/');
        }
        
        $adminContent = "";
        $leftMenu = "";
        
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu');
            $adminContent = view('dashboard.admin');
        } elseif ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.teachermenu');
            $adminContent = view('dashboard.teacher');
        } elseif ($usrInfo->usrtyp == 'Student' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.studentmenu');
            $adminContent = view('dashboard.student');
        }
        
        
        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $adminContent);
    }
    
    public function login() {
        $usrInfo = Session::get('usrInfo');
        /* Signin check */
        if ($usrInfo != NULL) {
            return Redirect::to('/');
        }
        
        $loginContent = view('home.logincontent');
        return view('homecontainer')->with('content', $loginContent);
    }

    public function usrLogin(Request $request) {
        $usrName = $request->usr_nme;
        $usrPsd = md5($request->usr_psd);

        $usrInfo = DB::table('usrreg')
                ->join('sclreg', 'usrreg.sclcd', '=', 'sclreg.sclcde')
                ->select('usrreg.*', 'sclreg.sclnme', 'sclreg.scleml', 'sclreg.sclcde', 'sclreg.sclrfr', 'sclreg.jondt', 'sclreg.expdte')
                ->whereRaw("(usrreg.usrid = '$usrName' AND usrreg.usrpsd = '$usrPsd') OR (usrreg.usreml = '$usrName' AND usrreg.usrpsd = '$usrPsd')")
                ->first();

        if ($usrInfo) {
            if (date('Y-m-d') < $usrInfo->expdte) {
                if($usrInfo->usrsts == 0 && $usrInfo->usrpwr == 1){
                    Session::put('errors', 'This school is not approved. Please contact to service provider.');
                    return Redirect::to('/login/');
                }else{
                    if($usrInfo->usrsts == 2 && $usrInfo->usrpwr == 1){
                        Session::put('errors', 'Your account is blocked. Please contact to service provider.');
                        return Redirect::to('/login/');
                    }else{
                        if($usrInfo->usrsts == 2){
                            Session::put('errors', 'Your account is blocked. Please contact to school admin.');
                            return Redirect::to('/login/');
                        }else{
                            if ($usrInfo->usrsts == 1) {
                                Session::put('usrInfo', $usrInfo);
                                return Redirect::to('/');
                            } else {
                                Session::put('errors', 'Your account is not approved.');
                                return Redirect::to('/login/');
                            }
                        }
                    }
                }
            } else {
                Session::put('errors', 'Your school out of valid date.');
                return Redirect::to('/login/');
            }
        } else {
            Session::put('errors', 'Username/email or password not match!!');
            return Redirect::to('/login/');
        }
    }
    
    
    public function signOut(){
        Session::forget('usrInfo');
        return Redirect::to('/login/');
    }
}
