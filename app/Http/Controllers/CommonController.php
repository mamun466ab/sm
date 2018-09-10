<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class CommonController extends Controller
{
    public function studentList(){
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if($endParts == 'student-list'){
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addStdLstActive', $activeClass);
            $addTeacher = view('common.student-list');
        } else{
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addTeacher);
    }
}
