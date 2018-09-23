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
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
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
                echo '<td></td>';
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

    public function classNumber($num) {
        for ($i = 1; $i <= $num; $i++) {
            echo '<div class = "row"';
            echo '<div class = "form-group" style="margin-bottom:15px;">';
            echo '<div class = "col-sm-4">';
            echo '<label for = "cls' . $i . '">Class - ' . $i . '</label>';
            echo '<input type = "text" name = "cls' . $i . '" class = "form-control" id = "cls' . $i . '" readonly="readonly" value = "No - ' . $i . ' Class">';
            echo '</div>';
            echo '<div class = "col-sm-8">';
            echo '<label for = "clstme' . $i . '">Time</label>';
            echo '<input type = "text" name = "clstme' . $i . '" class = "form-control" id = "clstme' . $i . '" placeholder = "Class Time" required="required">';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }

}
