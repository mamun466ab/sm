<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;

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
    
    public function editProfile(){
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
