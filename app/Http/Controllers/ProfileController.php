<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;

class ProfileController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usrInfo = Session::get('usrInfo');
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu');
            $usrProfile = view('pages.usrprofile');
        } elseif ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.teachermenu');
            $usrProfile = view('pages.usrprofile');
        } elseif ($usrInfo->usrtyp == 'Student' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.studentmenu');
            $usrProfile = view('pages.usrprofile');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $usrProfile);
    }

    public function editProfile() {
        $usrInfo = Session::get('usrInfo');
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu');
            $editProfile = view('pages.profile-edit');
        } elseif ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.teachermenu');
            $editProfile = view('pages.profile-edit');
        } elseif ($usrInfo->usrtyp == 'Student' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.studentmenu');
            $editProfile = view('pages.profile-edit');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $editProfile);
    }

    public function updateProfile(Request $request) {
        $usrId = Session::get('usrInfo')->id;
        $sclCd = Session::get('usrInfo')->sclcd;

        $proInfo = DB::table('usrpro')->select('*')->where('usrid', $usrId)->first();

        $proDataValidate = Validator::make($request->all(), [
                    'abt' => 'required|max:255',
                    'fthr' => 'required|max:30',
                    'mthr' => 'required|max:30',
                    'cnt' => 'required',
                    'dvn' => 'required',
                    'dst' => 'required',
                    'thn' => 'required',
                    'adrs' => 'required|max:255',
                    'rlgn' => 'required',
                    'dob' => 'required|max:10',
                    'mbl' => 'max:15',
                    'skl' => 'max:255',
                        ], [
                    'abt.required' => 'You can\'t leave this empty.',
                    'fthr.required' => 'You can\'t leave this empty.',
                    'mthr.required' => 'You can\'t leave this empty.',
                    'cnt.required' => 'Select your Contry.',
                    'dvn.required' => 'Select your Division.',
                    'dst.required' => 'Select your District.',
                    'thn.required' => 'Select your Thana.',
                    'adrs.required' => 'You can\'t leave this empty.',
                    'rlgn.required' => 'Select your Relegion.',
                    'dob.required' => 'You can\'t leave this empty.',
                    'abt.max' => 'Maximum 255 character.',
                    'fthr.max' => 'Maximum 30 character.',
                    'mthr.max' => 'Maximum 30 character.',
                    'adrs.max' => 'Maximum 255 character.',
                    'dob.max' => 'Maximum 10 character.',
                    'mbl.max' => 'Maximum 20 character.',
                    'skl.max' => 'Maximum 255 character.',
        ]);

        if ($proDataValidate->passes()) {
            $proEdtInfo = array();
            $proEdtInfo['usrid'] = $usrId;
            $proEdtInfo['sclcd'] = $sclCd;
            $proEdtInfo['abt'] = $request->abt;
            $proEdtInfo['fthr'] = $request->fthr;
            $proEdtInfo['mthr'] = $request->mthr;
            $proEdtInfo['cntid'] = $request->cnt;
            $proEdtInfo['dvnid'] = $request->dvn;
            $proEdtInfo['dstid'] = $request->dst;
            $proEdtInfo['thnid'] = $request->thn;
            $proEdtInfo['adr'] = $request->adrs;
            $proEdtInfo['rlgn'] = $request->rlgn;
            $proEdtInfo['dob'] = $request->dob;
            $proEdtInfo['mbl'] = $request->mbl;
            $proEdtInfo['skl'] = $request->skl;
            
            if ($proInfo) {
                DB::table('usrpro')->where('usrid', $usrId)->update($proEdtInfo);
            } else {
                DB::table('usrpro')->insert($proEdtInfo);
            }

            return response()->json(['success' => '!!! User information successfully updated. !!!']);
        } else {
            return response()->json(['errors' => $proDataValidate->errors()]);
        }
    }

    public function cngPsd() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
