<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class CommonController extends Controller {

    public function studentList() {
        $usrInfo = Session::get('usrInfo');
        $url = url()->current();
        $urlParts = explode('/', $url);
        $endParts = end($urlParts);

        if ($endParts == 'student-list') {
            $activeClass = 'class="active"';
        }

        $sclCde = Session::get('usrInfo')->sclcd;
        $sclInfo = DB::table('sclreg')
                ->join('usrdst', 'sclreg.dstid', '=', 'usrdst.id')
                ->join('usrthn', 'sclreg.thnid', '=', 'usrthn.id')
                ->select('sclreg.*', 'usrdst.dst', 'usrthn.thn')
                ->where('sclreg.sclcde', $sclCde)
                ->first();

        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
                ->where('clsrol.sclcd', $sclCde)
                ->orderBy('clsrol.stdcls')
                ->orderBy('clsrol.stdrol')
                ->get();

        if ($usrInfo->usrtyp == 'Teacher' AND $usrInfo->usrpwr == 1) {
            $leftMenu = view('menu.adminmenu')
                    ->with('addStdLstActive', $activeClass);
            $addTeacher = view('common.student-list')
                    ->with('stdInfo', $stdInfo)
                    ->with('sclInfo', $sclInfo);
        } else {
            return Redirect::to('/');
        }

        return view('dboardcontainer')->with('leftmenu', $leftMenu)->with('content', $addTeacher);
    }

}
