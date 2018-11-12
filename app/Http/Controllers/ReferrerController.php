<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use DB;
use Session;

session_start();


class ReferrerController extends Controller
{
 	public function __construct() {
        $referrerId = Session::get('referrerId');
    }

    public function index() {
        $referrerId = Session::get('referrerId');
        /* Signin check */
        if ($referrerId != NULL) {
            return Redirect::to('/referrer-dashboard');
        }

        $content = view('referrer.login');
        return view('homecontainer')->with('content', $content);
    }

    public function referrer_registration() {
        $referrerId = Session::get('referrerId');
        /* Signin check */
        if ($referrerId != NULL) {
            return Redirect::to('/referrer-dashboard');
        }

        $content = view('referrer.ref_reg_content');
        return view('homecontainer')->with('content', $content);
    }

    // public function teacher() {
    //     $usrInfo = Session::get('usrInfo');
    //     /* Signin check */
    //     if ($usrInfo != NULL) {
    //         return Redirect::to('/');
    //     }

    //     $tcrRegContent = view('home.tcrregcontent');
    //     return view('homecontainer')->with('content', $tcrRegContent);
    // }
    
    /*
     * School and admin registration
     */

    public function referrer_data(Request $request) {
        $refDataValidate = Validator::make($request->all(), [
                    'ref_nme' => 'required|max:150',
                    'ref_usrname' => 'required|max:100|unique:refreg,ref_usrname',
                    'ref_eml' => 'required|max:100|email|unique:refreg,ref_eml',
                    'ref_adr' => 'required|max:255',
                    'ref_cnt' => 'required|max:30',
                    'ref_dvn' => 'required|max:30',
                    'ref_dst' => 'required|max:30',
                    'ref_thn' => 'required|max:30',
                    'ref_gnr' => 'required',
                    'ref_psd' => 'required|max:32|min:8',
                    'ref_cpd' => 'same:ref_psd',
                    'ref_mbl' => 'required|max:15',
                    'check_policy' => 'required',
                        ], [
                    'ref_nme.required' => 'You can\'t leave this empty.',
                    'ref_usrname.required' => 'You can\'t leave this empty.',
                    'ref_eml.required' => 'You can\'t leave this empty.',
                    'ref_adr.required' => 'You can\'t leave this empty.',
                    'ref_cnt.required' => 'You can\'t leave this empty.',
                    'ref_dvn.required' => 'You can\'t leave this empty.',
                    'ref_dst.required' => 'You can\'t leave this empty.',
                    'ref_thn.required' => 'You can\'t leave this empty.',
                    'ref_mbl.required' => 'You can\'t leave this empty.',
                    'ref_gnr.required' => 'You can\'t leave without select gender.',
                    'check_policy.required' => 'Please Check Here',
                    'ref_nme.max' => 'Maximum 150 character.',
                    'ref_usrname.max' => 'Maximum 100 character.',
                    'ref_eml.max' => 'Maximum 100 character.',
                    'ref_adr.max' => 'Maximum 255 character.',
                    'ref_cnt.max' => 'Maximum 30 character.',
                    'ref_dvn.max' => 'Maximum 30 character.',
                    'ref_dst.max' => 'Maximum 30 character.',
                    'ref_thn.max' => 'Maximum 30 character.',
                    'ref_nme.max' => 'Maximum 100 character.',
                    'ref_eml.max' => 'Maximum 100 character.',
                    'ref_mbl.min' => 'Minimum 15 character.',
                    'ref_cpd.same' => 'Password and confirm password not match.',
                    'ref_eml.email' => 'Please give a valid email.',
                    'ref_eml.unique' => 'Email already exist.',
                    'ref_usrname.unique' => 'Username already exist.',
        ]);

        if ($refDataValidate->passes()) {
            $refRegInfo = array();
            $refRegInfo['ref_nme'] = ucfirst($request->ref_nme);
            $refRegInfo['ref_usrname'] = ucfirst($request->ref_usrname);
            $refRegInfo['ref_eml'] = $request->ref_eml;
            $refRegInfo['cntid'] = $request->ref_cnt;
            $refRegInfo['dvnid'] = $request->ref_dvn;
            $refRegInfo['dstid'] = $request->ref_dst;
            $refRegInfo['thnid'] = $request->ref_thn;
            $refRegInfo['ref_adr'] = ucfirst($request->ref_adr);
            $refRegInfo['joindt'] = date('Y-m-d');
            $refRegInfo['refgnr'] = $request->ref_gnr;
            $refRegInfo['refmbl'] = $request->ref_mbl;
            $refRegInfo['refpsd'] = md5($request->ref_psd);

            DB::table('refreg')->insert($refRegInfo);

            return response()->json(['success' => '!!! Referrer Registration Successfully Completed. !!!']);
        } else {
            return response()->json(['errors' => $refDataValidate->errors()]);
        }
    }



    public function referrerLogin(Request $request) {
        $ref_usrname = $request->ref_usrname;
        $refpsd = md5($request->refpsd);

        $CheckRefQuery = DB::table('refreg')
                ->where('ref_usrname', $ref_usrname)
                ->where('refpsd', $refpsd)
                ->first();
        if ($CheckRefQuery) {
            Session::put('RefName', $CheckRefQuery->ref_nme);
            Session::put('referrerId', $CheckRefQuery->id);

            return Redirect::to('/referrer-dashboard/');
        } else {
            Session::put('errors', 'Username or password not match!!');
            return Redirect::to('/referrer/');
        }
    }


    public function referrer_dashboard() {
        $referrerId = Session::get('referrerId');
        if ($referrerId == Null) {
            return Redirect::to('/referrer/')->send();
        }
        //$referrerAdmin = DB::table('referrer_admin')->get();
        $totalUser = DB::table('usrreg')->count();
        $totalTeacher = DB::table('usrreg')->where('usrtyp', 'Teacher')->count();
        $totalStudent = DB::table('usrreg')->where('usrtyp', 'Student')->count();

        $index_content = view('referrer.index_content')
                        ->with('totalUser', $totalUser)
                        ->with('totalTeacher', $totalTeacher)
                        ->with('totalStudent', $totalStudent);
        return view('referrer.index')
                ->with('content', $index_content);
    }


    public function admin_req_view(){

       $ref_admin_reqs = DB::table('usrreg')       
                    ->leftJoin('sclreg', 'usrreg.sclcd', '=', 'sclreg.sclcd')
                    ->where('usrpwr', '0')
                    ->orderBy('usrreg.id', 'desc')
                    ->select('usrreg.*', 'sclreg.sclnme')
                    ->get();

        $index_content = view('super.admin_request')
                ->with('scl_admin_reqs', $scl_admin_reqs);

        return view('super.index')
                        ->with('content', $index_content);
    }   
}
