<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller {
    /*
     * load student-list page for admin
     */

    public function studentList() {
        $usrInfo = Session::get('usrInfo');

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addStdLstActive', 'class="active"');
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

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addTcrActive', 'class="active"');
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

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addStdActive', 'class="active"');
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

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addSubject', 'class="active"');
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
                    ->with('viewSubject', 'class="active"');
            $selectSubject = view('admin.subject.view-subject')->with('stdSub', $stdSub);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $selectSubject);
    }

    public function changeSubject() {
        $usrInfo = Session::get('usrInfo');

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('chngSubject', 'class="active"');
            $changeSubject = view('admin.subject.change-subject');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }

    public function classTime(Request $clsTime) {
        $usrInfo = Session::get('usrInfo');

        if ($clsTime->ttlnum > 0) {
            $ttlNum = $clsTime->ttlnum;
        } else {
            $ttlNum = 0;
        }
        
        if (!empty($clsTime->scltyp)) {
            $scltyp = $clsTime->scltyp;
        } else {
            $scltyp = $usrInfo->scltyp;
        }

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('classTime', 'class="active"');
            $clasTime = view('admin.routine.class-time')->with('ttlNum', $ttlNum)->with('scltyp', $scltyp);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $clasTime);
    }

    public function createRoutine() {
        $usrInfo = Session::get('usrInfo');

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('crtRtn', 'class="active"');
            $changeSubject = view('admin.routine.create-routine');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }

    public function activeUser() {
        $usrInfo = Session::get('usrInfo');

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
            $leftMenu = view('menu.adminmenu')->with('actiovation', 'class="active"');
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
            $leftMenu = view('menu.adminmenu')->with('bldUblk', 'class="active"');
            $changeSubject = view('admin.user.block-unblock')
                    ->with('blkInfo', $blkInfo)
                    ->with('sclInfo', $sclInfo);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }
    
    public function exmTime() {
        $usrInfo = Session::get('usrInfo');
        
        $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->get();
        
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('exmTime', 'class="active"');
            $changeSubject = view('admin.exam.exam-time')->with('exmtm', $exmtm);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }
    
    public function exmRoutine() {
        $usrInfo = Session::get('usrInfo');
        
        $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->get();
        
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('exmRtn', 'class="active"');
            $changeSubject = view('admin.exam.create-routine')->with('exmtmQuery', $exmtm);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }
    
    public function addNumber() {
        $usrInfo = Session::get('usrInfo');
        
        $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->get();
        
        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('addNumber', 'class="active"');
            $changeSubject = view('admin.result.add-number')->with('exmtm', $exmtm);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $changeSubject);
    }

}