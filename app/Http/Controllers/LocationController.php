<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LocationController extends Controller
{
    public function location() {
        $index_content = view('super.location');
        return view('super.index')->with('page_content', $index_content);
    }

    public function division($id) {
        $country_id = $id;
        $division = DB::table('usrdvn')->where('cntid', $country_id)->orderBy('dvn', 'ASC')->get();
        echo '<option value="">Select Country</option>';
        foreach ($division as $dvn):
            echo '<option value="' . $dvn->id . '">' . $dvn->dvn . '</option>';
        endforeach;
    }

    public function district($id) {
        $divesion_id = $id;
        $district = DB::table('usrdst')->where('dvnid', $divesion_id)->orderBy('dst', 'ASC')->get();
        echo '<option value="">Select District</option>';
        foreach ($district as $dist):
            echo '<option value="' . $dist->id . '">' . $dist->dst . '</option>';
        endforeach;
    }

    public function thana($id) {
        $thana = DB::table('usrthn')->where('dstid', $id)->orderBy('thn', 'ASC')->get();
        echo '<option value="">Select Thana</option>';
        foreach ($thana as $thn):
            echo '<option value="' . $thn->id . '">' . $thn->thn . '</option>';
        endforeach;
    }

    public function country_create(Request $request) {
        $country = $request->country;


        $create_country = DB::table('country')->insert([
            'country_name' => $country
        ]);
        if ($create_country) {
            Session::put('message', 'Country added successfully');
            return Redirect::to('/location');
        } else {
            Session::put('message', 'Country not added!');
        }
    }

    public function division_create(Request $request) {
        $division_name = $request->division_name;
        $country_id = $request->country_id;


        $create = DB::table('division')->insert([
            'division_name' => $division_name,
            'country_id' => $country_id,
        ]);
        if ($create) {
            Session::put('message', 'Division added successfully');
            return Redirect::to('/location');
        } else {
            Session::put('message', 'Division not added!');
        }
    }

    public function district_create(Request $request) {
        $district_name = $request->district_name;
        $division_id = $request->division_id;


        $create = DB::table('district')->insert([
            'district_name' => $district_name,
            'division_id' => $division_id,
        ]);
        if ($create) {
            Session::put('message', 'District added successfully');
            return Redirect::to('/location');
        } else {
            Session::put('message', 'District not added!');
        }
    }

    public function selectAjax(Request $request) {
        if ($request->ajax()) {
            $states = DB::table('district')->where('division_id', $request->division_id)->all();
            $data = view('ajax-select', compact('states'))->render();
            return response()->json(['options' => $data]);
        }
    }

    public function thana_create(Request $request) {

        $crt_thana_validator = Validator::make($request->all(), [
                    'country_id' => 'required',
                    'create_thana_division_id' => 'required',
                    'create_thana_dist_id' => 'required',
                    'thana' => 'required|unique:thana,thana_name',
                        ], [
                    'country_id.required' => 'You can\'t leave this empty.',
                    'create_thana_division_id.required' => 'You can\'t leave this empty.',
                    'create_thana_dist_id.required' => 'You can\'t leave this empty.',
                    'thana.required' => 'You can\'t leave this empty.',
                    'thana.unique' => 'This police station already added.',
        ]);

        if ($crt_thana_validator->passes()):
            $thanaInfo = array();
            $thanaInfo['thana_name'] = $request->thana;
            $thanaInfo['district_id'] = $request->create_thana_dist_id;
            
            DB::table('thana')->insert($thanaInfo);
            
            return response()->json(['success' => '!!! Police Station successfully added. !!!']);
        else:
            return response()->json(['errors' => $crt_thana_validator->errors()]);
        endif;



//        $thana_name = $request->thana_name;
//        $thana_id = $request->thana_id;
//
//
//        $create = DB::table('thana')->insert([
//                    'thana_name' => $thana_name,
//                    'thana_id' => $thana_id,
//                ]);
//        if($create){
//            Session::put('message', 'Thana added successfully');
//            return Redirect::to('/location');
//        }else{
//            Session::put('message', 'Thana not added!');
//        }
    }
}
