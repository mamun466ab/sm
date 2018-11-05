<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class AjaxController extends Controller {

    public function listStudent($id) {
        $sclCde = Session::get('usrInfo')->sclcd;
        $stdCls = $id;
        $stdSession = date('Y');
        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte', 'usrreg.usrsts')
                ->whereRaw("(clsrol.sclcd = '$sclCde' AND clsrol.stdcls = '$stdCls' AND clsrol.yr = '$stdSession')")
                ->orderBy('clsrol.stdcls')
                ->orderBy('clsrol.stdrol')
                ->get();
        if (!empty($stdInfo)) {
            foreach ($stdInfo as $val):
                echo '<tr>';
                echo '<td>' . $val->stdrol . '</td>';
                echo '<td>' . $val->usrnme . '</td>';
                echo '<td>';
                if ($val->stdcls == 6):
                    echo 'Six';
                elseif ($val->stdcls == 7):
                    echo 'Seven';
                elseif ($val->stdcls == 8):
                    echo 'Eight';
                elseif ($val->stdcls == 9):
                    echo 'Nine';
                elseif ($val->stdcls == 10):
                    echo 'Ten';
                elseif ($val->stdcls == 11):
                    echo 'Enter 1st Year';
                elseif ($val->stdcls == 12):
                    echo 'Enter 2nd Year';
                endif;
                echo '</td>';
                echo '<td>' . $val->usreml . '</td>';
                echo '<td>' . $val->usrmbl . '</td>';
                echo '<td>' . $val->jondte . '</td>';
                echo '<td>';
                if ($val->usrsts == 1):
                    echo '<span style="color: #3390FF;">Active</span>';
                elseif ($val->usrsts == 2):
                    echo '<span style="color: #FF9933;">Blocked</span>';
                else:
                    echo '<span style="color: #FF3633;">Inactive</span>';
                endif;
                echo '</td>';
                echo '</tr>';
            endforeach;
        }else {
            echo '<tr>';
            echo '<td>';
            echo 'No data found.';
            echo '</td>';
            echo '</tr>';
        }
    }

    public function unblockBlock($usrid) {
        $sclCde = Session::get('usrInfo')->sclcd;
        $stdCls = $usrid;
        $stdInfo = DB::table('usrreg')
                ->select('*')
                ->whereRaw("(usrnme LIKE '%$stdCls%' OR usreml LIKE '%$stdCls%' OR usrid LIKE '%$stdCls%' OR usrmbl LIKE '%$stdCls%') AND (sclcd = '$sclCde')")
                ->orderBy('usrnme')
                ->get();
        if (!empty($stdInfo)) {
            foreach ($stdInfo as $val):
                echo '<tr>';
                echo '<td>' . $val->usrnme . '</td>';
                echo '<td>' . $val->usreml . '</td>';
                echo '<td>' . $val->usrid . '</td>';
                echo '<td>' . $val->usrtyp . '</td>';
                echo '<td>' . $val->usrmbl . '</td>';
                echo '<td>' . $val->jondte . '</td>';
                echo '<td>';
                if ($val->usrsts == 2):
                    echo '<a class="btn btn-success btn-sm" href="' . url("/unblock/$val->id") . '">Unblock</a>';
                else:
                    if ($val->usrpwr != 1):
                        echo '<a class="btn btn-danger btn-sm" href="' . url("/block/$val->id") . '">Block</a>';
                    else:
                        echo '';
                    endif;
                endif;
                echo '</td>';
                echo '</tr>';
            endforeach;
        }else {
            echo '<tr>';
            echo '<td>';
            echo 'No data found.';
            echo '</td>';
            echo '</tr>';
        }
    }

    public function listStudentOption($id) {
        $sclCde = Session::get('usrInfo')->sclcd;
        $stdCls = $id;
        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->select('clsrol.*', 'usrreg.id', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
                ->whereRaw("(clsrol.sclcd = '$sclCde' AND clsrol.stdcls = '$stdCls')")
                ->orderBy('usrreg.usrnme')
                ->orderBy('clsrol.stdrol')
                ->get();
        if (!empty($stdInfo)) {
            echo '<option value="">Select Student</option>';
            foreach ($stdInfo as $lst):
                echo '<option value="' . $lst->id . '">' . $lst->usrnme . ' (Roll - ' . $lst->stdrol . ')</option>';
            endforeach;
        }
    }

    public function subjectView($id) {
        $sclCde = Session::get('usrInfo')->sclcd;
        $stdCls = $id;
        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->join('stdsub', 'clsrol.stdid', '=', 'stdsub.stdid')
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte', 'stdsub.sub', 'stdsub.frthsub', 'stdsub.extsub')
                ->whereRaw("(clsrol.sclcd = '$sclCde' AND clsrol.stdcls = '$stdCls')")
                ->orderBy('clsrol.stdcls')
                ->orderBy('clsrol.stdrol')
                ->get();
        if (!empty($stdInfo)) {
            foreach ($stdInfo as $val):
                echo '<tr>';
                echo '<td>' . $val->stdrol . '</td>';
                echo '<td>' . $val->usrnme . '</td>';
                echo '<td>';
                if ($val->stdcls == 6):
                    echo 'Six';
                elseif ($val->stdcls == 7):
                    echo 'Seven';
                elseif ($val->stdcls == 8):
                    echo 'Eight';
                elseif ($val->stdcls == 9):
                    echo 'Nine';
                elseif ($val->stdcls == 10):
                    echo 'Ten';
                elseif ($val->stdcls == 11):
                    echo 'Enter 1st Year';
                elseif ($val->stdcls == 12):
                    echo 'Enter 2nd Year';
                endif;
                echo '</td>';
                echo '<td>';
                $i = 1;
                $subArray = explode(',', $val->sub);
                foreach ($subArray as $subVal):
                    $subName = DB::table('subject')->select('sub')->where('subcd', $subVal)->first();
                    echo '<strong>' . $i . '.</strong> ' . $subName->sub . '&nbsp;&nbsp;&nbsp;';
                    if ($i % 5 == 0) {
                        echo '<br />';
                    }
                    $i++;
                endforeach;
                echo '</td>';
                echo '<td>';
                if ($val->frthsub) {
                    $i = 1;
                    $frthSubArray = explode(',', $val->frthsub);
                    foreach ($frthSubArray as $frthSsubVal):
                        $subName = DB::table('subject')->select('sub')->where('subcd', $frthSsubVal)->first();
                        echo '<strong>' . $i . '.</strong> ' . $subName->sub . '&nbsp;&nbsp;&nbsp;';
                        $i++;
                    endforeach;
                } else {
                    echo '<font color="red">Nill</font>';
                }
                echo '</td>';
                echo '<td>';
                if ($val->extsub) {
                    $i = 1;
                    $exsubArray = explode(',', $val->extsub);
                    foreach ($exsubArray as $exsubVal):
                        $exsubName = DB::table('extsub')->select('exsub')->where('exsubcd', $exsubVal)->first();
                        echo '<strong>' . $i . '.</strong> ' . $exsubName->exsub . '&nbsp;&nbsp;&nbsp;';
                        $i++;
                    endforeach;
                } else {
                    echo '<font color="red">Nill</font>';
                }
                echo '</td>';
                echo '<td></td>';
                echo '</tr>';
            endforeach;
        } else {
            echo '<tr>';
            echo '<td>';
            echo 'No data found.';
            echo '</td>';
            echo '</tr>';
        }
    }

    public function selectedSubject($id) {
        echo '<div class = "form-group">';
        $stdid = $id;
        $stdSub = DB::table('stdsub')->select('*')->where('stdid', $stdid)->first();
        $stsub = explode(',', $stdSub->sub);
        $exstsub = explode(',', $stdSub->extsub);
        $frtstsub = explode(',', $stdSub->frthsub);
        $cmnSub = DB::table('subject')->select('*')->get();
        $sclcd = Session::get('usrInfo')->sclcd;
        $extSub = DB::table('extsub')->select('*')->where('sclcd', $sclcd)->get();
        echo '<label for="cmnsub">Common Subject</label>';
        echo '<div id="cmnsub" style="color:blue;">';
        foreach ($cmnSub as $sub):
            if (in_array($sub->subcd, $stsub)) {
                $chcked = 'checked="checked"';
            } else {
                $chcked = '';
            }
            echo '<label class="checkbox-inline">';
            echo '<input type="checkbox"' . $chcked . 'name="cmnsub[]" id="inlineCheckbox1" value="' . $sub->subcd . '">' . $sub->sub;
            echo '</label>';
        endforeach;
        echo '</div>';
        echo '</div>';

        if (count($extSub) > 0):
            echo '<div class="form-group">';
            echo '<label for="extsub">Extra Subject</label>';
            echo '<div id="extsub" style="color:#229954;">';
            foreach ($extSub as $exsub):
                if (in_array($exsub->exsubcd, $exstsub)) {
                    $chcked = 'checked="checked"';
                } else {
                    $chcked = '';
                }
                echo '<label class="checkbox-inline">';
                echo '<input type="checkbox"' . $chcked . 'name="extsub[]" id="inlineCheckbox1" value="' . $exsub->exsubcd . '">' . $exsub->exsub;
                echo '</label>';
            endforeach;
            echo '</div>';
            echo '</div>';
        endif;

        echo '<div class="form-group">';
        $forthsub = DB::table('subject')->select('*')->where('sts', 4)->get();
        echo '<label for="frtsub">Forth Subject</label>';
        echo '<div id="frtsub" style="color:#D35400;">';
        foreach ($forthsub as $frsub):
            if (in_array($frsub->subcd, $frtstsub)) {
                $chcked = 'checked="checked"';
            } else {
                $chcked = '';
            }
            echo '<label class="checkbox-inline">';
            echo '<input type="checkbox"' . $chcked . 'name="frtsub" id="inlineCheckbox1" value="' . $frsub->subcd . '">' . $frsub->sub;
            echo '</label>';
        endforeach;
        echo '</div>';
        echo '</div>';
    }

    public function exmRtn($num) {
        $usrInfo = Session::get('usrInfo');
        $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->first();
        if ($num == 's') {
            $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->where('scltyp', 's')->first();
        } elseif ($num == 'c') {
            $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->where('scltyp', 'c')->first();
        }
        $sclsub = DB::table('subject')->select('*')->orderBy('sub')->get();
        $clgsub = DB::table('clgsub')->select('*')->orderBy('clgsub')->get();
        $extsub = DB::table('extsub')->select('*')->where('sclcd', $usrInfo->sclcd)->orderBy('exsub')->get();
        if ($num == 's') {
            echo '<div class="form-group">
                    <label for="exmTyp">Exam Type *</label>
                    <input name="exmTyp" id="exmTyp" type="text" class="form-control default-date-picker" onkeydown="return false" value = "' . $exmtm->exmtyp . '">
                 </div>';
            for ($n = 6; $n <= 10; $n++) {
                echo '<div class="form-group col-md-4">
                      <label for = "cls' . $n . '" class="control-label" style = "color:#FF6C60;">Class</label>
                      <input type="text" name = "cls' . $n . '" id = "cls' . $n . '" value = "';
                if ($n == 6) {
                    echo 'Six';
                } else if ($n == 7) {
                    echo 'Seven';
                } else if ($n == 8) {
                    echo 'Eight';
                } else if ($n == 9) {
                    echo 'Nine';
                } else if ($n == 10) {
                    echo 'Ten';
                }
                echo '" class="form-control" onkeydown="return false;">
                      </div>

                      <div class="';
                if ($exmtm->sndtm != 0) {
                    echo 'form-group col-md-4';
                } else {
                    echo 'form-group col-md-8';
                }
                echo '">
                      <label for = "fstexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->fsttm . '</label>
                      <div class="form-group">
                      <select name="fstexm' . $n . '" class="form-control" id="fstexm' . $n . '" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($sclsub as $sclsubval) {
                    echo '<option value="' . $sclsubval->sub . '">' . $sclsubval->sub . '</option>';
                }
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extsub as $sclexsubval) {
                    echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                }
                echo '</optgroup>';
                echo '</select>
                      </div>
                      </div>';

                if ($exmtm->sndtm != 0) {
                    echo '<div class="form-group col-md-4">
                      <label for = "sndexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->sndtm . '</label>
                      <div class="form-group">
                      <select name="sndexm' . $n . '" id = "sndexm' . $n . '" class="form-control" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                    echo '<optgroup label="Common Subject">';
                    foreach ($sclsub as $sclsubval) {
                        echo '<option value="' . $sclsubval->sub . '">' . $sclsubval->sub . '</option>';
                    }
                    echo '</optgroup>';

                    echo '<optgroup label="Extra Subject">';
                    foreach ($extsub as $sclexsubval) {
                        echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                    }
                    echo '</optgroup>';
                    echo '</select>
                      </div>
                      </div>';
                }
            }
        } else if ($num == 'c') {
            echo '<div class="form-group">
                    <label for="exmTyp">Exam Type *</label>
                    <input name="exmTyp" id="exmTyp" type="text" class="form-control default-date-picker" onkeydown="return false" value = "' . $exmtm->exmtyp . '">
                 </div>';
            for ($n = 11; $n <= 12; $n++) {
                echo '<div class="form-group col-md-4">
                      <label for = "cls' . $n . '" class="control-label" style = "color:#FF6C60;">Class</label>
                      <input type="text" name = "cls' . $n . '" id = "cls' . $n . '" value = "';
                if ($n == 11) {
                    echo 'Enter 1st Year';
                } else if ($n == 12) {
                    echo 'Enter 2nd Year';
                }
                echo '" class="form-control" onkeydown="return false;" placeholder="Class Number">
                      </div>

                      <div class="';
                if ($exmtm->sndtm != 0) {
                    echo 'form-group col-md-4';
                } else {
                    echo 'form-group col-md-8';
                }
                echo '">
                      <label for = "fstexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->fsttm . '</label>
                      <div class="form-group">
                      <select name="fstexm' . $n . '" class="form-control" id="fstexm' . $n . '" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($clgsub as $clgsubval) {
                    echo '<option value="' . $clgsubval->clgsub . '">' . $clgsubval->clgsub . '</option>';
                }
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extsub as $sclexsubval) {
                    echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                }
                echo '</optgroup>';
                echo '</select>
                      </div>
                      </div>';

                if ($exmtm->sndtm != 0) {
                    echo '<div class="form-group col-md-4">
                      <label for = "sndexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->sndtm . '</label>
                      <div class="form-group">
                      <select name="sndexm' . $n . '" id = "sndexm' . $n . '" class="form-control" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                    echo '<optgroup label="Common Subject">';
                    foreach ($clgsub as $clgsubval) {
                        echo '<option value="' . $clgsubval->clgsub . '">' . $clgsubval->clgsub . '</option>';
                    }
                    echo '</optgroup>';

                    echo '<optgroup label="Extra Subject">';
                    foreach ($extsub as $sclexsubval) {
                        echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                    }
                    echo '</optgroup>';
                    echo '</select>
                      </div>
                      </div>';
                }
            }
        }
    }

    public function clsRtn($num) {

        $sclcd = Session::get('usrInfo')->sclcd;
        if ($num == 6 OR $num == 7 OR $num == 8 OR $num == 9 OR $num == 10) {
            $clstme = DB::table('clstme')->select('*')->whereRaw("sclcd = '$sclcd' AND scltyp = 's'")->get();
        } elseif ($num == 11 or $num == 12) {
            $clstme = DB::table('clstme')->select('*')->whereRaw("sclcd = '$sclcd' AND scltyp = 'c'")->get();
        }

        if ($num == 6 OR $num == 7 OR $num == 8 OR $num == 9 OR $num == 10) {
            $subject = DB::table('subject')->select('*')->orderBy('sub')->get();
        } elseif ($num == 11 or $num == 12) {
            $subject = DB::table('clgsub')->select('*')->orderBy('clgsub')->get();
        }

        $extSub = DB::table('extsub')->select('*')->where('sclcd', $sclcd)->orderBy('exsub')->get();
        $i = 1;

        echo '<input type="hidden" name="ttlcls" value="' . count($clstme) . '">';
        echo '<div class="row" style="margin-bottom:15px; color: rgb(121, 121, 121); font-weight: bold; text-align: center;">';
        echo '<div class="col-sm-12">';
        echo '<div class="width14 text-info">Class Time</div>';
        echo '<div class="width14 text-info">Saturday</div>';
        echo '<div class="width14 text-info">Sunday</div>';
        echo '<div class="width14 text-info">Monday</div>';
        echo '<div class="width14 text-info">Tuesday</div>';
        echo '<div class="width14 text-info">Wednesday</div>';
        echo '<div class="width14 text-info">Thursday</div>';
        echo '</div>';
        echo '</div>';


        if (count($clstme) > 0):
            foreach ($clstme as $clsTm):

                echo '<div class = "row" style="margin-bottom:15px;">';
                echo '<div class = "form-group">';
                echo '<div class = "width14">';
                echo '<input type = "text" name = "clstme' . $i . '" class = "form-control" id = "clstme' . $i . '" readonly="readonly" value = "' . $clsTm->clstme . '">';
                echo '</div>';
                echo '<div class = "width14">';
                echo '<select name="sat' . $i . '" class="form-control" id="sat' . $i . '" required="required" style="color:#000;">';
                echo '<option value="">Subject</option>';
                echo '<option value="Tiffin Time">Tiffin Time</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($subject as $cmnSub):
                    if (empty($cmnSub->sub)) {
                        $allsub = $cmnSub->clgsub;
                    } else {
                        $allsub = $cmnSub->sub;
                    }
                    echo '<option value="' . $allsub . '">' . $allsub . '</option>';
                endforeach;
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extSub as $exSub):
                    echo '<option value="' . $exSub->exsub . '">' . $exSub->exsub . '</option>';
                endforeach;
                echo '</optgroup>';
                echo '</select>';
                echo '</div>';
                echo '<div class = "width14">';
                echo '<select name="sun' . $i . '" class="form-control" id="sun' . $i . '" required="required" style="color:#000;">';
                echo '<option value="">Subject</option>';
                echo '<option value="Tiffin Time">Tiffin Time</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($subject as $cmnSub):
                    if (empty($cmnSub->sub)) {
                        $allsub = $cmnSub->clgsub;
                    } else {
                        $allsub = $cmnSub->sub;
                    }
                    echo '<option value="' . $allsub . '">' . $allsub . '</option>';
                endforeach;
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extSub as $exSub):
                    echo '<option value="' . $exSub->exsub . '">' . $exSub->exsub . '</option>';
                endforeach;
                echo '</optgroup>';
                echo '</select>';
                echo '</div>';
                echo '<div class = "width14">';
                echo '<select name="mon' . $i . '" class="form-control" id="mon' . $i . '" required="required" style="color:#000;">';
                echo '<option value="">Subject</option>';
                echo '<option value="Tiffin Time">Tiffin Time</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($subject as $cmnSub):
                    if (empty($cmnSub->sub)) {
                        $allsub = $cmnSub->clgsub;
                    } else {
                        $allsub = $cmnSub->sub;
                    }
                    echo '<option value="' . $allsub . '">' . $allsub . '</option>';
                endforeach;
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extSub as $exSub):
                    echo '<option value="' . $exSub->exsub . '">' . $exSub->exsub . '</option>';
                endforeach;
                echo '</optgroup>';
                echo '</select>';
                echo '</div>';
                echo '<div class = "width14">';
                echo '<select name="tue' . $i . '" class="form-control" id="tue' . $i . '" required="required" style="color:#000;">';
                echo '<option value="">Subject</option>';
                echo '<option value="Tiffin Time">Tiffin Time</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($subject as $cmnSub):
                    if (empty($cmnSub->sub)) {
                        $allsub = $cmnSub->clgsub;
                    } else {
                        $allsub = $cmnSub->sub;
                    }
                    echo '<option value="' . $allsub . '">' . $allsub . '</option>';
                endforeach;
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extSub as $exSub):
                    echo '<option value="' . $exSub->exsub . '">' . $exSub->exsub . '</option>';
                endforeach;
                echo '</optgroup>';
                echo '</select>';
                echo '</div>';
                echo '<div class = "width14">';
                echo '<select name="wed' . $i . '" class="form-control" id="wed' . $i . '" required="required" style="color:#000;">';
                echo '<option value="">Subject</option>';
                echo '<option value="Tiffin Time">Tiffin Time</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($subject as $cmnSub):
                    if (empty($cmnSub->sub)) {
                        $allsub = $cmnSub->clgsub;
                    } else {
                        $allsub = $cmnSub->sub;
                    }
                    echo '<option value="' . $allsub . '">' . $allsub . '</option>';
                endforeach;
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extSub as $exSub):
                    echo '<option value="' . $exSub->exsub . '">' . $exSub->exsub . '</option>';
                endforeach;
                echo '</optgroup>';
                echo '</select>';
                echo '</div>';
                echo '<div class = "width14">';
                echo '<select name="thu' . $i . '" class="form-control" id="thu' . $i . '" required="required" style="color:#000;">';
                echo '<option value="">Subject</option>';
                echo '<option value="Tiffin Time">Tiffin Time</option>';
                echo '<optgroup label="Common Subject">';
                foreach ($subject as $cmnSub):
                    if (empty($cmnSub->sub)) {
                        $allsub = $cmnSub->clgsub;
                    } else {
                        $allsub = $cmnSub->sub;
                    }
                    echo '<option value="' . $allsub . '">' . $allsub . '</option>';
                endforeach;
                echo '</optgroup>';

                echo '<optgroup label="Extra Subject">';
                foreach ($extSub as $exSub):
                    echo '<option value="' . $exSub->exsub . '">' . $exSub->exsub . '</option>';
                endforeach;
                echo '</optgroup>';
                echo '</select>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                $i++;
            endforeach;
        endif;
    }

    public function addNumber($stdid) {
        $stdSub = DB::table('stdsub')->select('sub', 'frthsub', 'extsub')->where('stdid', $stdid)->first();
        $subuArray = explode(',', $stdSub->sub);
        $extsubuArray = explode(',', $stdSub->extsub);
        $sn = 1;

        foreach ($subuArray as $subVal):
            $sub = DB::table('subject')->select('sub')->where('subcd', $subVal)->first();
            echo '<div class = "row">';
            echo '<div class = "form-group col-md-6">';
//            echo '<label for = "sub' . $sn . '" class = "control-label">Subject</label>';
            echo '<input type = "text" name = "sub' . $sn . '" id = "sub' . $sn . '" class = "form-control" onkeydown = "return false;" value = "' . $sub->sub . '">';
            echo '</div>';

            echo '<div class = "form-group col-md-6">';
//            echo '<label for = "num' . $sn . '" class = "control-label">Number</label>';
            echo '<input type = "text" name = "num' . $sn . '" id = "num' . $sn . '" placeholder = "33" class = "form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" required="required"" maxlength="3">';
            echo '</div>';
            echo '</div>';
            $sn++;
        endforeach;

        if (!empty($stdSub->extsub)):
            echo '<div class = "form-group col-md-12">';
            echo '<label for = "num' . $sn . '" class = "control-label" style="color:#FCB322;"><u>Extra Subject</u></label>';
            echo '</div>';
            echo '</div>';

            foreach ($extsubuArray as $extsubVal):
                $extsub = DB::table('extsub')->select('exsub')->where('exsubcd', $extsubVal)->first();
                echo '<div class = "row">';
                echo '<div class = "form-group col-md-6">';
//            echo '<label for = "sub' . $sn . '" class = "control-label">Subject</label>';
                echo '<input type = "text" name = "sub' . $sn . '" id = "sub' . $sn . '" class = "form-control" onkeydown = "return false;" value = "' . $extsub->exsub . '">';
                echo '</div>';

                echo '<div class = "form-group col-md-6">';
//            echo '<label for = "num' . $sn . '" class = "control-label">Number</label>';
                echo '<input type = "text" name = "num' . $sn . '" id = "num' . $sn . '" placeholder = "33" class = "form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" required="required"" maxlength="3">';
                echo '</div>';
                echo '</div>';
                $sn++;
            endforeach;
        endif;
        echo '<input type="hidden" name="ttlsub" value="' . $sn . '" />';

        if (!empty($stdSub->frthsub)):
            echo '<div class = "form-group col-md-12">';
            echo '<label for = "num' . $sn . '" class = "control-label" style="color:#FCB322;"><u>Forth Subject</u></label>';
            echo '</div>';
            echo '</div>';

            $frtsub = DB::table('subject')->select('sub')->where('subcd', $stdSub->frthsub)->first();
            echo '<div class = "row">';
            echo '<div class = "form-group col-md-6">';
//            echo '<label for = "frtsub" class = "control-label">Subject</label>';
            echo '<input type = "text" name = "frtsub" id = "frtsub" class = "form-control" onkeydown = "return false;" value = "' . $frtsub->sub . '">';
            echo '</div>';

            echo '<div class = "form-group col-md-6">';
//            echo '<label for = "frtnum" class = "control-label">Number</label>';
            echo '<input type = "text" name = "frtnum" id = "frtnum" placeholder = "33" class = "form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" required="required" " maxlength="3">';
            echo '</div>';
            echo '</div>';
        endif;
    }

}
