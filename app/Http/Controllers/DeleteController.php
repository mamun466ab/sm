<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class DeleteController extends Controller {

    public function deleteClassTime($sclcd) {
        DB::table('clstme')->where('sclcd', '=', $sclcd)->delete();
        return Redirect::to('/class-time/');
    }

}
