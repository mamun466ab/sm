<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class RegController extends Controller {

    public function index() {
        $usrInfo = Session::get('usrInfo');
        /* Signin check */
        if ($usrInfo != NULL) {
            return Redirect::to('/');
        }

        $sclRegContent = view('home.sclregcontent');
        return view('homecontainer')->with('content', $sclRegContent);
    }

    public function student() {
        $usrInfo = Session::get('usrInfo');
        /* Signin check */
        if ($usrInfo != NULL) {
            return Redirect::to('/');
        }

        $stdRegContent = view('home.stdnregcontent');
        return view('homecontainer')->with('content', $stdRegContent);
    }

    public function teacher() {
        $usrInfo = Session::get('usrInfo');
        /* Signin check */
        if ($usrInfo != NULL) {
            return Redirect::to('/');
        }

        $tcrRegContent = view('home.tcrregcontent');
        return view('homecontainer')->with('content', $tcrRegContent);
    }
    
    /*
     * School and admin registration
     */

    public function schoolData(Request $request) {
        $sclDataValidate = Validator::make($request->all(), [
                    'scl_nme' => 'required|max:150',
                    'scl_eml' => 'required|max:100|email|unique:sclreg,scleml',
                    'scl_cde' => 'required|max:8|unique:sclreg,sclcde',
                    'scl_adr' => 'required|max:255',
                    'scl_cnt' => 'required|max:30',
                    'scl_dvn' => 'required|max:30',
                    'scl_dst' => 'required|max:30',
                    'scl_thn' => 'required|max:30',
                    'rfr_id' => 'max:30',
                    'adn_nme' => 'required|max:100',
                    'adn_eml' => 'required|max:100|email|unique:usrreg,usreml',
                    'adn_gnr' => 'required',
                    'adn_uid' => 'required|max:30|unique:usrreg,usrid',
                    'adn_psd' => 'required|max:32|min:8',
                    'adn_cpd' => 'same:adn_psd',
                    'adn_rnk' => 'required|max:30',
                    'adn_mbl' => 'required|max:15',
                        ], [
                    'scl_nme.required' => 'You can\'t leave this empty.',
                    'scl_eml.required' => 'You can\'t leave this empty.',
                    'scl_cde.required' => 'You can\'t leave this empty.',
                    'scl_adr.required' => 'You can\'t leave this empty.',
                    'scl_cnt.required' => 'You can\'t leave this empty.',
                    'scl_dvn.required' => 'You can\'t leave this empty.',
                    'scl_dst.required' => 'You can\'t leave this empty.',
                    'scl_thn.required' => 'You can\'t leave this empty.',
                    'rfr_id.required' => 'You can\'t leave this empty.',
                    'adn_nme.required' => 'You can\'t leave this empty.',
                    'adn_eml.required' => 'You can\'t leave this empty.',
                    'adn_uid.required' => 'You can\'t leave this empty.',
                    'adn_psd.required' => 'You can\'t leave this empty.',
                    'adn_rnk.required' => 'You can\'t leave this empty.',
                    'adn_mbl.required' => 'You can\'t leave this empty.',
                    'adn_gnr.required' => 'You can\'t leave without select gender.',
                    'scl_nme.max' => 'Maximum 150 character.',
                    'scl_eml.max' => 'Maximum 100 character.',
                    'scl_cde.max' => 'Maximum 8 character.',
                    'scl_adr.max' => 'Maximum 255 character.',
                    'scl_cnt.max' => 'Maximum 30 character.',
                    'scl_dvn.max' => 'Maximum 30 character.',
                    'scl_dst.max' => 'Maximum 30 character.',
                    'scl_thn.max' => 'Maximum 30 character.',
                    'rfr_id.max' => 'Maximum 30 character.',
                    'adn_nme.max' => 'Maximum 100 character.',
                    'adn_eml.max' => 'Maximum 100 character.',
                    'adn_uid.max' => 'Maximum 30 character.',
                    'adn_psd.max' => 'Maximum 20 character.',
                    'adn_rnk.max' => 'Maximum 30 character.',
                    'adn_psd.min' => 'Minimum 8 character.',
                    'adn_mbl.min' => 'Minimum 15 character.',
                    'adn_cpd.same' => 'Password and confirm password not match.',
                    'scl_eml.email' => 'Please give a valid email.',
                    'adn_eml.email' => 'Please give a valid email.',
                    'scl_eml.unique' => 'Email already exist.',
                    'scl_cde.unique' => 'School code already exist.',
                    'adn_eml.unique' => 'Email already exist',
                    'adn_uid.unique' => 'Username already exist.',
        ]);

        if ($sclDataValidate->passes()) {
            $sclRegInfo = array();
            $sclRegInfo['sclnme'] = ucfirst($request->scl_nme);
            $sclRegInfo['scleml'] = $request->scl_eml;
            $sclRegInfo['sclcde'] = strtoupper($request->scl_cde);
            $sclRegInfo['scladr'] = ucfirst($request->scl_adr);
            $sclRegInfo['cntid'] = $request->scl_cnt;
            $sclRegInfo['dvnid'] = $request->scl_dvn;
            $sclRegInfo['dstid'] = $request->scl_dst;
            $sclRegInfo['thnid'] = $request->scl_thn;
            $sclRegInfo['sclrfr'] = $request->rfr_id;
            $sclRegInfo['jondt'] = date('Y-m-d');
            $sclRegInfo['expdte'] = date('Y-m-d', strtotime('+6 month'));

            $usrRegInfo = array();
            $usrRegInfo['usrnme'] = ucfirst($request->adn_nme);
            $usrRegInfo['usreml'] = $request->adn_eml;
            $usrRegInfo['usrgnr'] = $request->adn_gnr;
            $usrRegInfo['usrtyp'] = "Teacher";
            $usrRegInfo['usrid'] = $request->adn_uid;
            $usrRegInfo['usrpsd'] = md5($request->adn_psd);
            $usrRegInfo['sclcd'] = strtoupper($request->scl_cde);
            $usrRegInfo['usrrnk'] = ucfirst($request->adn_rnk);
            $usrRegInfo['usrpwr'] = 1;
            $usrRegInfo['usrsts'] = 0;
            $usrRegInfo['jondte'] = date('Y-m-d');
            $usrRegInfo['usrmbl'] = $request->adn_mbl;

            DB::table('sclreg')->insert($sclRegInfo);
            DB::table('usrreg')->insert($usrRegInfo);

            return response()->json(['success' => '!!! School Registration Successfully Completed. !!!']);
        } else {
            return response()->json(['errors' => $sclDataValidate->errors()]);
        }
    }

    /*
     * Teacher registration
     */

    public function teacherData(Request $request) {
        $tcrDataValidate = Validator::make($request->all(), [
                    'tcr_nme' => 'required|max:100',
                    'tcr_eml' => 'required|max:100|email|unique:usrreg,usreml',
                    'tcr_gnr' => 'required',
                    'tcr_uid' => 'required|max:30|unique:usrreg,usrid',
                    'tcr_psd' => 'required|max:32|min:8',
                    'tcr_cpd' => 'same:tcr_psd',
                    'tcr_rnk' => 'required|max:30',
                    'scl_cde' => 'required|max:8',
                        ], [
                    'tcr_nme.required' => 'You can\'t leave this empty.',
                    'tcr_eml.required' => 'You can\'t leave this empty.',
                    'tcr_uid.required' => 'You can\'t leave this empty.',
                    'tcr_psd.required' => 'You can\'t leave this empty.',
                    'tcr_rnk.required' => 'You can\'t leave this empty.',
                    'scl_cde.required' => 'You can\'t leave this empty.',
                    'tcr_gnr.required' => 'You can\'t leave without select gender.',
                    'tcr_nme.max' => 'Maximum 100 character.',
                    'tcr_eml.max' => 'Maximum 100 character.',
                    'tcr_uid.max' => 'Maximum 30 character.',
                    'tcr_psd.max' => 'Maximum 20 character.',
                    'tcr_rnk.max' => 'Maximum 30 character.',
                    'scl_cde.max' => 'Maximum 8 character.',
                    'tcr_psd.min' => 'Minimum 8 character.',
                    'tcr_cpd.same' => 'Password and confirm password not match.',
                    'tcr_eml.email' => 'Please give a valid email.',
                    'tcr_eml.unique' => 'Email already exist',
                    'tcr_uid.unique' => 'Username already exist.',
        ]);

        $checkSclCde = Validator::make($request->all(), [
                    'scl_cde' => 'unique:sclreg,sclcde',
        ]);

        if ($tcrDataValidate->passes()) {
            $usrRegInfo = array();
            $usrRegInfo['usrnme'] = ucfirst($request->tcr_nme);
            $usrRegInfo['usreml'] = $request->tcr_eml;
            $usrRegInfo['usrgnr'] = $request->tcr_gnr;
            $usrRegInfo['usrtyp'] = "Teacher";
            $usrRegInfo['usrid'] = $request->tcr_uid;
            $usrRegInfo['usrpsd'] = md5($request->tcr_psd);
            $usrRegInfo['sclcd'] = strtoupper($request->scl_cde);
            $usrRegInfo['usrrnk'] = ucfirst($request->tcr_rnk);
            $usrRegInfo['usrpwr'] = 0;
            $usrRegInfo['usrsts'] = 0;
            $usrRegInfo['jondte'] = date('Y-m-d');

            if ($checkSclCde->passes()) {
                return response()->json(['errors' => array('scl_cde' => 'Invalid school code.')]);
            } else {
                DB::table('usrreg')->insert($usrRegInfo);
            }

            return response()->json(['success' => '!!! Teacher Registration Successfully Completed. !!!']);
        } else {
            return response()->json(['errors' => $tcrDataValidate->errors()]);
        }
    }

    /*
     * Student registration
     */

    public function studentData(Request $request) {
        $stdDataValidate = Validator::make($request->all(), [
                    'std_nme' => 'required|max:100',
                    'std_eml' => 'required|max:100|email|unique:usrreg,usreml',
                    'std_gnr' => 'required',
                    'std_cls' => 'required',
                    'std_rol' => 'required|numeric',
                    'std_uid' => 'required|max:30|unique:usrreg,usrid',
                    'std_psd' => 'required|max:32|min:8',
                    'std_cpd' => 'same:std_psd',
                    'scl_cde' => 'required|max:8',
                    'ssn_yr' => 'required',
                        ], [
                    'std_nme.required' => 'You can\'t leave this empty.',
                    'std_eml.required' => 'You can\'t leave this empty.',
                    'std_uid.required' => 'You can\'t leave this empty.',
                    'std_psd.required' => 'You can\'t leave this empty.',
                    'std_rol.required' => 'You can\'t leave this empty.',
                    'scl_cde.required' => 'You can\'t leave this empty.',
                    'std_gnr.required' => 'You can\'t leave without select gender.',
                    'std_cls.required' => 'You can\'t leave without select gender.',
                    'ssn_yr.required' => 'You can\'t leave without select session.',
                    'std_nme.max' => 'Maximum 100 character.',
                    'std_eml.max' => 'Maximum 100 character.',
                    'std_uid.max' => 'Maximum 30 character.',
                    'std_psd.max' => 'Maximum 20 character.',
                    'scl_cde.max' => 'Maximum 8 character.',
                    'std_psd.min' => 'Minimum 8 character.',
                    'std_cpd.same' => 'Password and confirm password not match.',
                    'std_eml.email' => 'Please give a valid email.',
                    'std_eml.unique' => 'Email already exist',
                    'std_uid.unique' => 'Username already exist.',
                    'std_rol.numeric' => 'Fill with only number.',
        ]);

        $checkSclCde = Validator::make($request->all(), [
                    'scl_cde' => 'unique:sclreg,sclcde',
        ]);

        if ($stdDataValidate->passes()) {
            $usrRegInfo = array();
            $usrRegInfo['usrnme'] = ucfirst($request->std_nme);
            $usrRegInfo['usreml'] = $request->std_eml;
            $usrRegInfo['usrgnr'] = $request->std_gnr;
            $usrRegInfo['usrtyp'] = "Student";
            $usrRegInfo['usrid'] = $request->std_uid;
            $usrRegInfo['usrpsd'] = md5($request->std_psd);
            $usrRegInfo['sclcd'] = strtoupper($request->scl_cde);
            $usrRegInfo['usrrnk'] = 0;
            $usrRegInfo['usrpwr'] = 0;
            $usrRegInfo['usrsts'] = 0;
            $usrRegInfo['jondte'] = date('Y-m-d');

            $clsRol = array();
            $clsRol['stdcls'] = $request->std_cls;
            $clsRol['stdrol'] = $request->std_rol;
            $clsRol['sclcd'] = strtoupper($request->scl_cde);
            $clsRol['yr'] = $request->ssn_yr;

            $clsRolInfo = DB::table('clsrol')
                    ->select('*')
                    ->whereRaw("(sclcd = '$request->scl_cde' AND stdcls = '$request->std_cls' AND stdrol = '$request->std_rol' AND yr = '$request->ssn_yr')")
                    ->first();

            if ($checkSclCde->passes()) {
                return response()->json(['errors' => array('scl_cde' => 'Invalid school code.')]);
            } else {
                if ($clsRolInfo) {
                    return response()->json(['errors' => array('std_rol' => 'This class roll already exists.')]);
                } else {
                    $id = DB::table('usrreg')->insertGetId($usrRegInfo);
                    $clsRol['stdid'] = $id;
                    DB::table('clsrol')->insert($clsRol);
                }
            }

            return response()->json(['success' => '!!! Teacher Registration Successfully Completed. !!!']);
        } else {
            return response()->json(['errors' => $stdDataValidate->errors()]);
        }
    }
}
