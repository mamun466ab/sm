<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class CommonController extends Controller {

    public function studentList() {
        $usrInfo = Session::get('usrInfo');

        $stdSession = date('Y');

        $sclCde = Session::get('usrInfo')->sclcd;
        $sclInfo = DB::table('sclreg')
                ->join('usrdst', 'sclreg.dstid', '=', 'usrdst.id')
                ->join('usrthn', 'sclreg.thnid', '=', 'usrthn.id')
                ->select('sclreg.*', 'usrdst.dst', 'usrthn.thn')
                ->where('sclreg.sclcd', $sclCde)
                ->first();

        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte', 'usrreg.usrsts')
                ->whereRaw("(clsrol.sclcd = '$sclCde' AND clsrol.yr = '$stdSession')")
                ->orderBy('clsrol.stdcls')
                ->orderBy('clsrol.stdrol')
                ->get();

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('stdLst', 'class="active"');
            $addTeacher = view('common.list.student-list')
                    ->with('stdInfo', $stdInfo)
                    ->with('sclInfo', $sclInfo);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addTeacher);
    }

    public function teacherList() {
        $usrInfo = Session::get('usrInfo');

        $stdSession = date('Y');

        $sclCde = Session::get('usrInfo')->sclcd;
        $sclInfo = DB::table('sclreg')
                ->join('usrdst', 'sclreg.dstid', '=', 'usrdst.id')
                ->join('usrthn', 'sclreg.thnid', '=', 'usrthn.id')
                ->select('sclreg.*', 'usrdst.dst', 'usrthn.thn')
                ->where('sclreg.sclcd', $sclCde)
                ->first();

        $tcrInfo = DB::table('usrreg')
                ->select('*')
                ->whereRaw("(sclcd = '$sclCde' AND usrtyp = 'Teacher')")
                ->orderBy('usrnme')
                ->get();

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('tcrLst', 'class="active"');
            $addTeacher = view('common.list.teacher-list')
                    ->with('tcrInfo', $tcrInfo)
                    ->with('sclInfo', $sclInfo);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addTeacher);
    }

    public function selectSubject() {
        $usrInfo = Session::get('usrInfo');

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('slctSubject', 'class="active"');
            $selectSubject = view('common.subject.select-subject');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $selectSubject);
    }

    public function viewRoutine() {
        $usrInfo = Session::get('usrInfo');

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('viewRtn', 'class="active"');
            $selectSubject = view('common.routine.view-routine');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $selectSubject);
    }

    public function viewExmRoutine() {
        $usrInfo = Session::get('usrInfo');

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('vwExmRtn', 'class="active"');
            $selectSubject = view('common.exam.view-exam-routine');
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $selectSubject);
    }

    public function viewResult(Request $stdInfo) {
        $usrInfo = Session::get('usrInfo');

        if (!empty($stdInfo->std_cls)):
            $stdcls = $stdInfo->std_cls;
        else:
            $stdcls = NULL;
        endif;

        if (!empty($stdInfo->stdrol)):
            $stdrol = $stdInfo->stdrol;
        else:
            $stdrol = NULL;
        endif;

        if (!empty($stdInfo->std_ssn)):
            $ssn = $stdInfo->std_ssn;
        else:
            $ssn = NULL;
        endif;

        if (!empty($stdInfo->exm_typ)):
            $exmtyp = $stdInfo->exm_typ;
        else:
            $exmtyp = NULL;
        endif;
        
        $ttlnumquery = DB::table('ttlnum')
                ->select('*')
                ->where('sclcd', $usrInfo->sclcd)
                ->where('stdcls', $stdcls)
                ->where('ssn', $ssn)
                ->where('exmtyp', $exmtyp)
                ->orderBy('ttlnum', 'DESC')
                ->get();

        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->join('usrpro', 'clsrol.stdid', '=', 'usrpro.usrid')
                ->select('clsrol.stdcls', 'clsrol.stdid', 'clsrol.yr', 'clsrol.stdrol', 'usrreg.usrnme', 'usrpro.fthr', 'usrpro.mthr', 'usrpro.dob')
                ->where('clsrol.sclcd', $usrInfo->sclcd)
                ->where('clsrol.stdcls', $stdcls)
                ->where('clsrol.stdrol', $stdrol)
                ->where('clsrol.yr', $ssn)
                ->first();

        if(!empty($stdInfo->stdid)):
            $stdid = $stdInfo->stdid;
        else:
            $stdid = NULL;
        endif;

        $rsltInfo = DB::table('subnum')
                ->select('*')
                ->where('stdid', $stdid)
                ->where('stdcls', $stdcls)
                ->where('ssn', $ssn)
                ->where('exmtyp', $exmtyp)
                ->where('sts', NULL)
                ->get();

        $rsltFrthInfo = DB::table('subnum')
                ->select('*')
                ->where('stdid', $stdid)
                ->where('stdcls', $stdcls)
                ->where('ssn', $ssn)
                ->where('exmtyp', $exmtyp)
                ->where('sts', 4)
                ->first();

        $rsltExtInfo = DB::table('subnum')
                ->select('*')
                ->where('stdid', $stdid)
                ->where('stdcls', $stdcls)
                ->where('ssn', $ssn)
                ->where('exmtyp', $exmtyp)
                ->where('sts', 3)
                ->get();

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')->with('vwrslt', 'class="active"');
            $selectSubject = view('common.result.view-result')
                    ->with('stdInfo', $stdInfo)
                    ->with('rstInfo', $rsltInfo)
                    ->with('rsltFrthInfo', $rsltFrthInfo)
                    ->with('rsltExtInfo', $rsltExtInfo)
                    ->with('exmtyph', $exmtyp)
                    ->with('ttlnumquery', $ttlnumquery);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $selectSubject);
    }

}
