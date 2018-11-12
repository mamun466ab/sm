<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class AdminInsertController extends Controller {

    public function addSubject(Request $request) {
        $subjectValidator = Validator::make($request->all(), [
                    'subnme' => 'required|max:30',
                    'subcde' => 'required|max:10|unique:extsub,exsubcd',
                        ], [
                    'subnme.required' => 'You can\'t leave this empty.',
                    'subcde.required' => 'You can\'t leave this empty.',
                    'subnme.max' => 'Maximum 30 character.',
                    'subcde.max' => 'Maximum 10 character.',
                    'subcde.unique' => 'Subject code already exists.',
        ]);

        if ($subjectValidator->passes()) {
            $extSub = array();
            $extSub['sclcd'] = Session::get('usrInfo')->sclcd;
            $extSub['exsub'] = ucfirst($request->subnme);
            $extSub['exsubcd'] = $request->subcde;

            DB::table('extsub')->insert($extSub);
            return response()->json(['success' => '!!! Extra subject added successfully. !!!']);
        } else {
            return response()->json(['errors' => $subjectValidator->errors()]);
        }
    }

    public function classTime(Request $clstm) {
        $totalNum = $clstm->ttlnum;
        $scltyp = $clstm->scltyp;

        $sclcd = Session::get('usrInfo')->sclcd;

        $insrtdTme = DB::table('clstme')->whereRaw("sclcd = '$sclcd' AND scltyp = '$scltyp'")->get();

        if (count($insrtdTme) > 0):
            DB::table('clstme')->whereRaw("sclcd = '$sclcd' AND scltyp = '$scltyp'")->delete();
            DB::table('clsrtn')->whereRaw("sclcd = '$sclcd' AND scltyp = '$scltyp'")->delete();
        endif;

        for ($i = 1; $i <= $totalNum; $i++) {
            $from = 'from' . $i;
            $to = 'to' . $i;
            $clsTme = array();
            $clsTme['sclcd'] = Session::get('usrInfo')->sclcd;
            $clsTme['clstme'] = $clstm->$from . ' - ' . $clstm->$to;
            $clsTme['clsnum'] = $i;
            $clsTme['scltyp'] = $scltyp;

            DB::table('clstme')->insert($clsTme);
        }
        return Redirect::to('/class-time/');
    }

    public function routineCreate(Request $rtnSub) {
        $ttlCls = $rtnSub->ttlcls;
        $class = $rtnSub->cls;
        $scltyp = $rtnSub->rtncls;
        $sclcd = Session::get('usrInfo')->sclcd;
        $rtnChk = DB::table('clsrtn')->whereRaw("(sclcd = '$sclcd' AND cls = '$class')")->count();

        if ($rtnChk < 1) {
            for ($i = 1; $i <= $ttlCls; $i++) {
                $clstme = 'clstme' . $i;
                $sat = 'sat' . $i;
                $sun = 'sun' . $i;
                $mon = 'mon' . $i;
                $tue = 'tue' . $i;
                $wed = 'wed' . $i;
                $thu = 'thu' . $i;

                $clsRtn = array();
                $clsRtn['sclcd'] = $sclcd;
                $clsRtn['cls'] = $class;
                $clsRtn['clstme'] = $rtnSub->$clstme;
                $clsRtn['sat'] = $rtnSub->$sat;
                $clsRtn['sun'] = $rtnSub->$sun;
                $clsRtn['mon'] = $rtnSub->$mon;
                $clsRtn['tue'] = $rtnSub->$tue;
                $clsRtn['wed'] = $rtnSub->$wed;
                $clsRtn['thu'] = $rtnSub->$thu;
                $clsRtn['scltyp'] = $scltyp;

                DB::table('clsrtn')->insert($clsRtn);
            }
            Session::put('msg', 'Routine created.');
        } else {
            Session::put('errors', 'This class routine already exists.');
        }

        return Redirect::to('/create-routine/');
    }

    public function examTime(Request $time) {
        $sclcd = Session::get('usrInfo')->sclcd;
        $scltyp = $time->scltyp;

        if ($scltyp == 's' OR $scltyp == 'c') {
            $exmtim = DB::table('exmtm')->select('*')->where('sclcd', $sclcd)->get();

            $fsttime = $time->fstetmfrom . ' - ' . $time->fstetmto;


            if (empty($time->sndetmto)) {
                $sndtime = 0;
            } else {
                $sndtime = $time->sndetmfrom . ' - ' . $time->sndetmto;
            }

            $examtime = array();
            $examtime['sclcd'] = $sclcd;
            $examtime['fsttm'] = $fsttime;
            $examtime['sndtm'] = $sndtime;
            $examtime['exmtyp'] = $time->exmTyp;
            $examtime['scltyp'] = $scltyp;

            if (count($exmtim) > 0) {
                DB::table('exmtm')->where('sclcd', $sclcd)->where('scltyp', $scltyp)->delete();
                DB::table('exmrtn')->where('sclcd', $sclcd)->where('scltyp', $scltyp)->delete();
            }
            DB::table('exmtm')->insert($examtime);
            Session::put('msg', 'Exam time added.');
            return Redirect::to('/exam-time/');
        }
    }

    public function crtExmRtn(Request $crtRtn) {
        $sclcd = Session::get('usrInfo')->sclcd;
        $rtnTyp = $crtRtn->rtnTyp;
        $exmTyp = $crtRtn->exmTyp;
        $exmDte = $crtRtn->exmdte;

        if ($rtnTyp == 's') {
            for ($i = 6; $i <= 10; $i++):
                $cls = 'cls' . $i;
                $fstsub = 'fstexm' . $i;
                $sndsub = 'sndexm' . $i;
                
                if(empty($crtRtn->$sndsub)){
                    $sndsunm = 0;
                }else{
                    $sndsunm = implode('/', $crtRtn->$sndsub);
                }

                $exmrtn = array();
                $exmrtn['sclcd'] = $sclcd;
                $exmrtn['cls'] = $crtRtn->$cls;
                $exmrtn['exmdte'] = $exmDte;
                $exmrtn['fstsub'] = implode('/', $crtRtn->$fstsub);
                $exmrtn['sndsub'] = $sndsunm;
                $exmrtn['scltyp'] = $rtnTyp;

                DB::table('exmrtn')->insert($exmrtn);
            endfor;
            Session::put('msg', 'Routine created.');
        }elseif ($rtnTyp == 'c') {
            for ($n = 11; $n <= 12; $n++):
                $cls = 'cls' . $n;
                $fstsub = 'fstexm' . $n;
                $sndsub = 'sndexm' . $n;
                
                if (empty($crtRtn->$sndsub)) {
                    $sndsubnm = 0;
                } else {
                    $sndsubnm = implode('/', $crtRtn->$sndsub);
                }

                $exmrtn = array();
                $exmrtn['sclcd'] = $sclcd;
                $exmrtn['cls'] = $crtRtn->$cls;
                $exmrtn['exmdte'] = $exmDte;
                $exmrtn['fstsub'] = implode('/', $crtRtn->$fstsub);
                $exmrtn['sndsub'] = $sndsubnm;
                $exmrtn['scltyp'] = $rtnTyp;

                DB::table('exmrtn')->insert($exmrtn);
            endfor;
            Session::put('msg', 'Routine created.');
        }

        return Redirect::to('/exam-routine/');
    }

    public function insrtNum(Request $addNumber) {
        $sclcd = Session::get('usrInfo')->sclcd;
        $stdcls = $addNumber->stdcls;
        $stdid = $addNumber->stdid;
        $stdssn = $addNumber->ssn;
        $exmtyp = $addNumber->exmTyp;
        $ttlsub = $addNumber->ttlsub;

        $chkSubNum = DB::table('subnum')->select('*')->where('sclcd', $sclcd)->where('stdid', $stdid)->where('stdcls', $stdcls)->where('ssn', $stdssn)->where('exmtyp', $exmtyp)->get();

        $numSum = 0;

        if (count($chkSubNum) == 0):
            for ($n = 1; $n < $ttlsub; $n++) {
                $sub = 'sub' . $n;
                $num = 'num' . $n;

                $subNumArray = array();
                $subNumArray['sclcd'] = $sclcd;
                $subNumArray['stdid'] = $stdid;
                $subNumArray['stdcls'] = $stdcls;
                $subNumArray['sub'] = $addNumber->$sub;
                $subNumArray['num'] = $addNumber->$num;
                $subNumArray['ssn'] = $stdssn;
                $subNumArray['exmtyp'] = $exmtyp;

                $numSum += $addNumber->$num;

                DB::table('subnum')->insert($subNumArray);
            }

            if (!empty($addNumber->frtnum)) {
                $frtSubNumArray = array();
                $frtSubNumArray['sclcd'] = $sclcd;
                $frtSubNumArray['stdid'] = $stdid;
                $frtSubNumArray['stdcls'] = $stdcls;
                $frtSubNumArray['sub'] = $addNumber->frtsub;
                $frtSubNumArray['num'] = $addNumber->frtnum;
                $frtSubNumArray['ssn'] = $stdssn;
                $frtSubNumArray['exmtyp'] = $exmtyp;
                $frtSubNumArray['sts'] = 4;

                $numSum += $addNumber->frtnum;

                DB::table('subnum')->insert($frtSubNumArray);
            }

            $ttlNumArray = array();
            $ttlNumArray['sclcd'] = $sclcd;
            $ttlNumArray['stdid'] = $stdid;
            $ttlNumArray['stdcls'] = $stdcls;
            $ttlNumArray['ttlnum'] = $numSum;
            $ttlNumArray['ssn'] = $stdssn;
            $ttlNumArray['exmtyp'] = $exmtyp;

            DB::table('ttlnum')->insert($ttlNumArray);

            if (!empty($addNumber->ttlexsub)) {
                $exNumSum = 0;
                for ($en = 1; $en < $addNumber->ttlexsub; $en++) {
                    $exsub = 'exsub' . $en;
                    $exnum = 'exnum' . $en;

                    $exSubNumArray = array();
                    $exSubNumArray['sclcd'] = $sclcd;
                    $exSubNumArray['stdid'] = $stdid;
                    $exSubNumArray['stdcls'] = $stdcls;
                    $exSubNumArray['sub'] = $addNumber->$exsub;
                    $exSubNumArray['num'] = $addNumber->$exnum;
                    $exSubNumArray['ssn'] = $stdssn;
                    $exSubNumArray['exmtyp'] = $exmtyp;
                    $exSubNumArray['sts'] = 3;

                    $exNumSum += $addNumber->$exnum;

                    DB::table('subnum')->insert($exSubNumArray);
                }

                $ttlExNumArray = array();
                $ttlExNumArray['sclcd'] = $sclcd;
                $ttlExNumArray['stdid'] = $stdid;
                $ttlExNumArray['stdcls'] = $stdcls;
                $ttlExNumArray['ttlnum'] = $exNumSum;
                $ttlExNumArray['ssn'] = $stdssn;
                $ttlExNumArray['exmtyp'] = $exmtyp;
                $ttlExNumArray['sts'] = 3;

                DB::table('ttlnum')->insert($ttlExNumArray);
            }

            Session::put('msg', 'Subject number succesfully added.');
            return Redirect::to('/add-number/');
        else:
            Session::put('errors', 'Already inserted.');
            return Redirect::to('/add-number/');
        endif;
    }

}
