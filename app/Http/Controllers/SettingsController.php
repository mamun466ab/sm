<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;

class SettingsController extends Controller {

    public function settings() {
        $usrInfo = Session::get('usrInfo');
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu');
            $settings = view('common.settings.settings');
        } elseif ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.teachermenu');
            $settings = view('common.settings.settings');
        } elseif ($usrInfo->usrtyp == 'Student' AND $usrInfo->usrpwr == 0) {
            $leftMenu = view('menu.studentmenu');
            $settings = view('common.settings.settings');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $settings);
    }

}
