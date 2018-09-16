<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class AdiminController extends Controller {
    /*
     * load student-list page for admin
     */

    public function studentList() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'student-list') {
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addStdLstActive', $activeClass);
            $addTeacher = view('admin.student-list');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addTeacher);
    }

    /*
     * load add-teacher page for admin
     */

    public function addTeacher() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'add-teacher') {
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addTcrActive', $activeClass);
            $addTeacher = view('admin.add-teacher');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addTeacher);
    }

    /*
     * load add-student page for admin
     */

    public function addStudent() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'add-student') {
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addStdActive', $activeClass);
            $addTeacher = view('admin.add-student');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addTeacher);
    }

    /*
     * Add school extra subject
     */

    public function addSubject() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'add-subject') {
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addSubject', $activeClass);
            $addSubject = view('admin.add-subject');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addSubject);
    }

    /*
     * function for view subject
     */

    public function viewSubject() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);

        if ($endParts == 'view-subject') {
            $activeClass = 'class="active"';
        }
        
        $sclCde = Session::get('usrInfo')->sclcd;
        $stdSub = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->join('stdsub', 'clsrol.stdid', '=', 'stdsub.stdid')
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte', 'stdsub.sub', 'stdsub.frthsub', 'stdsub.extsub')
                ->whereRaw("(clsrol.sclcd = '$sclCde' AND clsrol.stdrol = 1)")
                ->orderBy('clsrol.stdcls')
                ->orderBy('clsrol.stdrol')
                ->get();

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')
                    ->with('viewSubject', $activeClass);
            $selectSubject = view('common.view-subject')->with('stdSub', $stdSub);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $selectSubject);
    }

}
