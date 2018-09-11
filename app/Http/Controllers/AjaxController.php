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
        $stdInfo = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
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

}
