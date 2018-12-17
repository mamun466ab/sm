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
                ->select('clsrol.stdrol', 'usrreg.id', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
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

    public function listStudentOptionRol($cls) {
        $sclCde = Session::get('usrInfo')->sclcd;
        $stdCls = $cls;
        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->select('clsrol.stdrol', 'usrreg.id', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
                ->whereRaw("(clsrol.sclcd = '$sclCde' AND clsrol.stdcls = '$stdCls')")
                ->orderBy('usrreg.usrnme')
                ->orderBy('clsrol.stdrol')
                ->get();
        if (!empty($stdInfo)) {
            echo '<option value="">Select Student</option>';
            foreach ($stdInfo as $lst):
                echo '<option value="' . $lst->stdrol . '">' . $lst->usrnme . ' (Roll - ' . $lst->stdrol . ')</option>';
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

    public function addExmTme($scltyp) {
        if ($scltyp == 's') {
            echo '<div class="form-group">';
            echo '<label for="exmTyp">Exam Type *</label>';
            echo '<select name="exmTyp" id="exmTyp" class="form-control" required="required">';
            echo '<option value="">Select Exam Type</option>';
            echo '<option value="1st Term">1st Term</option>';
            echo '<option value="2nd Term">2nd Term</option>';
            echo '<option value="3rd Term">3rd Term</option>';
            echo '<option value="Final">Final</option>';
            echo '<option value="Test">Test</option>';
            echo '</select>';
            echo '</div>';
        } else {
            echo '<div class="form-group">';
            echo '<label for="exmTyp">Exam Type *</label>';
            echo '<select name="exmTyp" id="exmTyp" class="form-control" required="required">';
            echo '<option value="">Select Exam Type</option>';
            echo '<option value="Half Yearly">Half Yearly</option>';
            echo '<option value="Yearly">Yearly</option>';
            echo '<option value="Pre Test">Pre Test</option>';
            echo '<option value="Test">Test</option>';
            echo '</select>';
            echo '</div>';
        }
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
        echo '<input type="hidden" name="ttlsub" value="' . $sn . '" />';

        if (!empty($stdSub->extsub)):
            echo '<div class = "form-group col-md-12">';
            echo '<label class = "control-label" style="color:#FCB322;"><u>Extra Subject</u></label>';
            echo '</div>';
            echo '</div>';
            $en = 1;

            foreach ($extsubuArray as $extsubVal):
                $extsub = DB::table('extsub')->select('exsub')->where('exsubcd', $extsubVal)->first();
                echo '<div class = "row">';
                echo '<div class = "form-group col-md-6">';
//            echo '<label for = "sub' . $en . '" class = "control-label">Subject</label>';
                echo '<input type = "text" name = "exsub' . $en . '" id = "exsub' . $en . '" class = "form-control" onkeydown = "return false;" value = "' . $extsub->exsub . '">';
                echo '</div>';

                echo '<div class = "form-group col-md-6">';
//            echo '<label for = "num' . $en . '" class = "control-label">Number</label>';
                echo '<input type = "text" name = "exnum' . $en . '" id = "exnum' . $en . '" placeholder = "33" class = "form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" required="required"" maxlength="3">';
                echo '</div>';
                echo '</div>';
                $en++;
            endforeach;
            echo '<input type="hidden" name="ttlexsub" value="' . $en . '" />';
        endif;

        if (!empty($stdSub->frthsub)):
            echo '<div class = "form-group col-md-12">';
            echo '<label for = "frtsub" class = "control-label" style="color:#FCB322;"><u>Forth Subject</u></label>';
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

    public function editClassRoutine($rtnid) {
        $edtablertn = DB::table('clsrtn')->select('*')->where('id', $rtnid)->first();
        echo '<div class = "row" style = "margin-bottom:15px; color: rgb(121, 121, 121); font-weight: bold; text-align: center;">';
        echo '<div class = "col-lg-2 text-info">';
        echo 'Class Time';
        echo '</div>';
        echo '<div class = "col-lg-10">';
        echo '<div class = "col-lg-2 text-info">Saturday</div>';
        echo '<div class = "col-lg-2 text-info">Sunday</div>';
        echo '<div class = "col-lg-2 text-info">Monday</div>';
        echo '<div class = "col-lg-2 text-info">Tuesday</div>';
        echo '<div class = "col-lg-2 text-info">Wednesday</div>';
        echo '<div class = "col-lg-2 text-info">Thursday</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class = "row" style="margin-bottom:15px;">';
        echo '<div class="col-lg-2">';
        echo '<input type="hidden" name="rtnid" value = "' . $rtnid . '" />';
        echo '<input type="text" name="clstme" class="form-control" id="clstme" readonly="readonly" value = "' . $edtablertn->clstme . '" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-md-10">';
        echo '<div class="col-lg-2">';
        echo '<input type="text" class="form-control" name="sat" value="' . $edtablertn->sat . '"" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-lg-2">';
        echo '<input type="text" class="form-control" name="sun" value="' . $edtablertn->sun . '"" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-lg-2">';
        echo '<input type="text" class="form-control" name="mon" value="' . $edtablertn->mon . '"" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-lg-2">';
        echo '<input type="text" class="form-control" name="tue" value="' . $edtablertn->tue . '"" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-lg-2">';
        echo '<input type="text" class="form-control" name="wed" value="' . $edtablertn->wed . '"" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-lg-2">';
        echo '<input type="text" class="form-control" name="thu" value="' . $edtablertn->thu . '"" style="color:#000;" />';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function editExamRoutine($exmid) {
        $edtexmrtn = DB::table('exmrtn')->select('*')->where('id', $exmid)->first();
        echo '<div class = "row" style = "margin-bottom:15px; color: rgb(121, 121, 121); font-weight: bold; text-align: center;">';
        echo '<div class = "col-lg-3 text-info">';
        echo 'Exam Date';
        echo '</div>';
        echo '<div class = "col-lg-9">';
        echo '<div class = "col-lg-6 text-info">First Exam</div>';
        echo '<div class = "col-lg-6 text-info">Seccond Exam</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class = "row" style="margin-bottom:15px;">';
        echo '<div class="col-lg-3">';
        echo '<input type="hidden" name="exmid" value = "' . $exmid . '" />';
        echo '<input type="text" name="clstme" class="form-control" id="clstme" readonly="readonly" value = "' . $edtexmrtn->exmdte . '" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-md-9">';
        echo '<div class="col-lg-6">';
        echo '<input type="text" class="form-control" name="fstsub" value="' . $edtexmrtn->fstsub . '"" style="color:#000;" />';
        echo '</div>';
        echo '<div class="col-lg-6">';
        echo '<input type="text" class="form-control" name="sndsub" value="' . $edtexmrtn->sndsub . '"" style="color:#000;" />';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function resultSystem($exmid) {
        $sclCde = Session::get('usrInfo')->sclcd;
        if ($exmid == TRUE):
            if ($exmid == 'Yes'):
                $sttng = 1;
                $rssttng = array();
                $rssttng['sttng'] = $sttng;
                DB::table('sttng')->where('sclcd', $sclCde)->where('sttngnm', 'rs')->update($rssttng);
                echo '<select class="btn btn-info btn-sm" style="padding: 0px; font-weight: bold;" onchange="ajaxGET(\'rslt\',\'' . url('/settings-rslt-sstm/\'') . '+this.value)">
                    <option value="Yes" selected="selected">Yes</option>
                    <option value="No">No</option>
                </select>';
            endif;
            if ($exmid == 'No'):
                $sttng = 0;
                $rssttng = array();
                $rssttng['sttng'] = $sttng;
                DB::table('sttng')->where('sclcd', $sclCde)->where('sttngnm', 'rs')->update($rssttng);
                echo '<select class="btn btn-danger btn-sm" style="padding: 0px; font-weight: bold;" onchange="ajaxGET(\'rslt\',\'' . url('/settings-rslt-sstm/\'') . '+this.value)">
                    <option value="Yes">Yes</option>
                    <option value="No" selected="selected">No</option>
                </select>';
            endif;
        else:
            echo '###';
        endif;
    }

}
