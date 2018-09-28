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
            $addTeacher = view('admin.user.add-teacher');
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
            $addTeacher = view('admin.user.add-student');
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
            $addSubject = view('admin.subject.add-subject');
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
            $selectSubject = view('admin.subject.view-subject')->with('stdSub', $stdSub);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $selectSubject);
    }

    public function changeSubject() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'change-subject') {
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('chngSubject', $activeClass);
            $changeSubject = view('admin.subject.change-subject');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }

    public function classTime() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'class-time') {
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('classTime', $activeClass);
            $changeSubject = view('admin.routine.class-time');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }

    public function createRoutine() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'create-routine') {
            $activeClass = 'class="active"';
        }
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('crtRtn', $activeClass);
            $changeSubject = view('admin.routine.create-routine');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }

    public function activeUser() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'user-activation') {
            $activeClass = 'class="active"';
        }

        $stdSession = date('Y');

        $sclCde = Session::get('usrInfo')->sclcd;
        $sclInfo = DB::table('sclreg')
                ->join('usrdst', 'sclreg.dstid', '=', 'usrdst.id')
                ->join('usrthn', 'sclreg.thnid', '=', 'usrthn.id')
                ->select('sclreg.*', 'usrdst.dst', 'usrthn.thn')
                ->where('sclreg.sclcd', $sclCde)
                ->first();

        $stdInfo = DB::table('usrreg')
                ->select('*')
                ->whereRaw("(sclcd = '$sclCde' AND usrsts = 0)")
                ->orderBy('usrnme')
                ->get();

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('actiovation', $activeClass);
            $changeSubject = view('admin.user.user-activation')
                    ->with('stdInfo', $stdInfo)
                    ->with('sclInfo', $sclInfo);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }
    
    public function blockUnblock() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);
        if ($endParts == 'block-unblock') {
            $activeClass = 'class="active"';
        }

        $stdSession = date('Y');

        $sclCde = Session::get('usrInfo')->sclcd;
        $sclInfo = DB::table('sclreg')
                ->join('usrdst', 'sclreg.dstid', '=', 'usrdst.id')
                ->join('usrthn', 'sclreg.thnid', '=', 'usrthn.id')
                ->select('sclreg.*', 'usrdst.dst', 'usrthn.thn')
                ->where('sclreg.sclcd', $sclCde)
                ->first();
        
        $blkInfo = DB::table('usrreg')
                ->select('*')
                ->whereRaw("(sclcd = '$sclCde' AND usrsts = 2)")
                ->orderBy('usrnme')
                ->get();

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('bldUblk', $activeClass);
            $changeSubject = view('admin.user.block-unblock')
                    ->with('blkInfo', $blkInfo)
                    ->with('sclInfo', $sclInfo);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }

}
