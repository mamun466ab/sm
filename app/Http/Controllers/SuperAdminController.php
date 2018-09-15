<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use DB;
use Session;

session_start();

class SuperAdminController extends Controller {

    public function __construct() {
        $superAdminId = Session::get('superAdminId');
    }

    public function index() {
        $superAdminId = Session::get('superAdminId');
        if ($superAdminId != Null) {
            return Redirect::to('/super-dashboard/')->send();
        }
        return view('super.login');
    }

    public function super_dashboard() {
        $superAdminId = Session::get('superAdminId');
        if ($superAdminId == Null) {
            return Redirect::to('/sm-super-admin/')->send();
        }
        //$superAdmin = DB::table('super_admin')->get();
        $totalUser = DB::table('usrreg')->count();
        $totalTeacher = DB::table('usrreg')->where('usrtyp', 'Teacher')->count();
        $totalStudent = DB::table('usrreg')->where('usrtyp', 'Student')->count();

        $index_content = view('super.index_content')
                        ->with('totalUser', $totalUser)
                        ->with('totalTeacher', $totalTeacher)
                        ->with('totalStudent', $totalStudent);
        return view('super.index')
                ->with('content', $index_content);
    }

    public function superAdminLogin(Request $request) {
        $username = $request->username;
        $password = md5($request->password);

        $superAdminQuery = DB::table('super_admin')
                ->where('username', $username)
                ->where('password', $password)
                ->first();
        if ($superAdminQuery) {
            Session::put('SuperAdminName', $superAdminQuery->name);
            Session::put('superAdminId', $superAdminQuery->id);

            return Redirect::to('/super-dashboard/');
        } else {
            Session::put('errors', 'Username and password not match!!');
            return Redirect::to('/sm-super-admin/');
        }
    }


    public function admin_req_view(){

       $scl_admin_reqs = DB::table('usrreg')       
                    ->leftJoin('sclreg', 'usrreg.sclcd', '=', 'sclreg.sclcd')
                    ->where('usrpwr', '0')
                    ->orderBy('usrreg.id', 'desc')
                    ->select('usrreg.*', 'sclreg.sclnme')
                    ->get();

        $index_content = view('super.admin_request')
                ->with('scl_admin_reqs', $scl_admin_reqs);

        return view('super.index')
                        ->with('content', $index_content);
    }


    public function school_req_view(){

       $scl_admin_reqs = DB::table('usrreg')       
                    ->leftJoin('sclreg', 'usrreg.sclcd', '=', 'sclreg.sclcd')
                    ->where('usrpwr', '0')
                    ->orderBy('usrreg.id', 'desc')
                    ->select('usrreg.*', 'sclreg.sclnme')
                    ->get();

        $index_content = view('super.admin_request')
                ->with('scl_admin_reqs', $scl_admin_reqs);

        return view('super.index')
                        ->with('content', $index_content);
    }

    public function admin_active_view(){

       $scl_admin_reqs = DB::table('usrreg')       
                    ->leftJoin('sclreg', 'usrreg.sclcd', '=', 'sclreg.sclcd')
                    ->where('usrpwr', '1')
                    ->orderBy('usrreg.id', 'desc')
                    ->select('usrreg.*', 'sclreg.sclnme')
                    ->get();

        $index_content = view('super.admin_active')
                ->with('scl_admin_reqs', $scl_admin_reqs);

        return view('super.index')
                        ->with('content', $index_content);
    }

    public function admin_approve($id){
        $update = DB::table('usrreg')
                    ->where('id', $id)
                    ->update(['usrpwr' => '1']);
        if($update){
            Session::put('message', 'Aproved!!!');
            return Redirect::to('/admin-request-view');
        }else{
            Session::put('error', 'Admin Not Approved!!!');
        }
    }

    public function make_admin($id, $sclcd){
        $adm_remove = DB::table('usrreg')
                    ->where('sclcd', $sclcd)
                    ->update(['usrpwr' => '0']);

        $mk_admin = DB::table('usrreg')
                    ->where('sclcd', $sclcd)
                    ->where('id', $id)
                    ->update(['usrpwr' => '1']);
        if($mk_admin){
            Session::put('message', 'New Admin Created successfully!!!');
            return Redirect::to('/school-teachers-view/'.$sclcd);
        }else{
            Session::put('error', 'New Admin Not Created!!!');
        }
    }

    public function admin_deactivate($id){
        $sclcd = DB::table('usrreg')->where('id', $id)->get();
        $update = DB::table('usrreg')
                    ->where('id', $id)
                    ->update(['usrpwr' => '0']);
        if($update){
            Session::put('message', 'Deactivated!!!');
            return Redirect::to('/admin-active-view/'.$sclcd->sclcd);
        }else{
            Session::put('error', 'Admin Not Deactivated!!!');
        }
    }

    public function admin_delete($id){
        $delete = DB::table('usrreg')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'School Admin deleted successfully!!!');
            return Redirect::to('/school_reg_req');
        }else{
            Session::put('error', 'School Admin not deleted!!!');
        }
    }

    public function country_view() {
        $countries = DB::table('usrcnt')->orderby('cnt', 'asc')->get();
        $index_content = view('super.location.country')
                            ->with('countries', $countries);
        return view('super.index')->with('content', $index_content);
    }

    public function division_view() {
        $countries = DB::table('usrcnt')->orderby('cnt', 'asc')->get();
        $divisions = DB::table('usrdvn')->orderby('dvn', 'asc')->get();
        $index_content = view('super.location.division')
                            ->with('countries', $countries)
                            ->with('divisions', $divisions);
        return view('super.index')->with('content', $index_content);
    }

    public function district_view() {
        $countries = DB::table('usrcnt')->orderby('cnt', 'asc')->get();
        $divisions = DB::table('usrdvn')->orderby('dvn', 'asc')->get();
        $districts = DB::table('usrdst')->orderby('dst', 'asc')->get();
        $index_content = view('super.location.district')
                            ->with('countries', $countries)
                            ->with('divisions', $divisions)
                            ->with('districts', $districts);
        return view('super.index')->with('content', $index_content);
    }

    public function thana_view() {
        $countries = DB::table('usrcnt')->orderby('cnt', 'asc')->get();
        $divisions = DB::table('usrdvn')->orderby('dvn', 'asc')->get();
        $districts = DB::table('usrdst')->orderby('dst', 'asc')->get();
        $thanas = DB::table('usrthn')->orderby('thn', 'asc')->get();
        $index_content = view('super.location.thana')
                            ->with('countries', $countries)
                            ->with('divisions', $divisions)
                            ->with('districts', $districts)
                            ->with('thanas', $thanas);
        return view('super.index')->with('content', $index_content);
    }


    public function country_create(Request $request) {
      $validator = Validator::make($request->all(), [
                    'cnt' => 'unique:usrcnt,cnt',
                        ], [
                    'cnt.unique' => 'This country name already added.',
        ]);

        if ($validator->passes()):
            $cnt = $request->cnt;
            $create_cnt = DB::table('usrcnt')->insert([
                                'cnt' => $cnt
                            ]);
            
            return response()->json(['success' => '!!! Country name successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;

    }

    public function division_create(Request $request) {
        $validator = Validator::make($request->all(), [
            'dvn' => 'unique:usrdvn,dvn',
                ], [
            'dvn.unique' => 'This division name already added.',
        ]);

        if ($validator->passes()):
            $cntid = $request->cntid;
            $dvn = $request->dvn;
            $create_dvn = DB::table('usrdvn')->insert([
                                'cntid' => $cntid,
                                'dvn' => $dvn
                            ]);
            
            return response()->json(['success' => '!!! Division name successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function division_edit($id){
        $division = DB::table('usrdvn')
                    ->where('id', $id)
                    ->get();
        $divisions = DB::table('usrdvn')->orderby('dvn', 'asc')->get();
        $countries = DB::table('usrcnt')->orderby('cnt', 'asc')->get();
        $division_edit = view('super.location.division_edit')
                    ->with('division', $division)
                    ->with('divisions', $divisions)
                    ->with('countries', $countries);
        return view('super.index')
            ->with('content', $division_edit);
    }

    public function division_delete($id){
        $delete = DB::table('usrdvn')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'Division deleted successfully!!!');
            return Redirect::to('/division-view');
        }else{
            Session::put('error', 'Division not deleted!!!');
        }
    }

    public function district_delete($id){
        $delete = DB::table('usrdst')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'District deleted successfully!!!');
            return Redirect::to('/district-view');
        }else{
            Session::put('error', 'District not deleted!!!');
        }
    }

    public function thana_delete($id){
        $delete = DB::table('usrthn')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'Thana deleted successfully!!!');
            return Redirect::to('/thana-view');
        }else{
            Session::put('error', 'Thana not deleted!!!');
        }
    }

    public function district_create(Request $request) {
        $validator = Validator::make($request->all(), [
            'dst' => 'unique:usrdst,dst',
                ], [
            'dst.unique' => 'This district name already added.',
        ]);

        if ($validator->passes()):
            $dvnid = $request->create_thana_division_id;
            $dst = $request->dst;
            $create_dst = DB::table('usrdst')->insert([
                                'dvnid' => $dvnid,
                                'dst' => $dst
                            ]);
            
            return response()->json(['success' => '!!! District name successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function district_edit($id) {
        $district = DB::table('usrdst')
                    ->where('id', $id)
                    ->get();
        $districts = DB::table('usrdst')->orderby('dst', 'asc')->get();
        $divisions = DB::table('usrdvn')->orderby('dvn', 'asc')->get();
        $countries = DB::table('usrcnt')->orderby('cnt', 'asc')->get();
        $district_edit = view('super.location.district_edit')
                    ->with('district', $district)
                    ->with('districts', $districts)
                    ->with('divisions', $divisions)
                    ->with('countries', $countries);
        return view('super.index')
            ->with('content', $district_edit);
    }


    public function thana_edit($id) {
        $thana = DB::table('usrthn')
                    ->where('id', $id)
                    ->get();
        $thanas = DB::table('usrthn')->orderby('thn', 'asc')->get();
        $districts = DB::table('usrdst')->orderby('dst', 'asc')->get();
        $divisions = DB::table('usrdvn')->orderby('dvn', 'asc')->get();
        $countries = DB::table('usrcnt')->orderby('cnt', 'asc')->get();
        $thana_edit = view('super.location.thana_edit')
                    ->with('thana', $thana)
                    ->with('thanas', $thanas)
                    ->with('districts', $districts)
                    ->with('divisions', $divisions)
                    ->with('countries', $countries);
        return view('super.index')
            ->with('content', $thana_edit);
    }


    public function selectAjax(Request $request) {
        if ($request->ajax()) {
            $states = DB::table('usrdst')->where('dvnid', $request->dvnid)->all();
            $data = view('ajax-select', compact('states'))->render();
            return response()->json(['options' => $data]);
        }
    }

    public function thana_create(Request $request) {

        $crt_thana_validator = Validator::make($request->all(), [
                    'cntid' => 'required',
                    'create_thana_division_id' => 'required',
                    'create_thana_dist_id' => 'required',
                    'thn' => 'required|unique:usrthn,thn',
                        ], [
                    'cntid.required' => 'You can\'t leave this empty.',
                    'create_thana_division_id.required' => 'You can\'t leave this empty.',
                    'create_thana_dist_id.required' => 'You can\'t leave this empty.',
                    'thn.required' => 'You can\'t leave this empty.',
                    'thn.unique' => 'This police station already added.',
        ]);

        if ($crt_thana_validator->passes()):
            $thanaInfo = array();
            $thanaInfo['thn'] = $request->thn;
            $thanaInfo['dstid'] = $request->create_thana_dist_id;
            
            DB::table('usrthn')->insert($thanaInfo);
            
            return response()->json(['success' => '!!! Police Station successfully added. !!!']);
        else:
            return response()->json(['errors' => $crt_thana_validator->errors()]);
        endif;
    }

    public function thana_update(Request $request) {

        $validator = Validator::make($request->all(), [
                    'cntid' => 'required',
                    'create_thana_division_id' => 'required',
                    'create_thana_dist_id' => 'required',
                    'thn' => 'required|unique:usrthn,thn',
                        ], [
                    'cntid.required' => 'You can\'t leave this empty.',
                    'create_thana_division_id.required' => 'You can\'t leave this empty.',
                    'create_thana_dist_id.required' => 'You can\'t leave this empty.',
                    'thn.required' => 'You can\'t leave this empty.',
                    'thn.unique' => 'This police station already added.',
        ]);

        if ($validator->passes()):
            $dstid = $request->create_thana_dist_id;
            $thnid = $request->thnid;
            $thn = $request->thn;
            
            DB::table('usrthn')
            ->where('id', $thnid)
            ->update([
                'thn' => $thn,
                'dstid' => $dstid,
            ]);
            
            return response()->json(['success' => '!!! Thana name successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }

    public function find_place(Request $request) {
            $search = $request->searching_name;
            if($search != null){
                $thanas = DB::table('usrthn')
                        ->leftJoin('usrdst', 'usrdst.id', '=', 'usrthn.dstid')
                        ->rightJoin('usrdvn', 'usrdvn.id', '=', 'usrdst.dvnid')
                        ->where('usrthn.thn', 'like', "%$search%")
                        ->orderBy('usrthn.thn', 'asc')
                        ->select('usrthn.*', 'usrdvn.dvn', 'usrdst.dst')
                        ->get();

                $districts = DB::table('usrdst')
                    ->rightJoin('usrdvn', 'usrdst.dvnid', '=', 'usrdvn.id')
                    ->where('usrdst.dst', 'like', "%$search%")
                    ->orderBy('usrdst.dst', 'asc')
                    ->select('usrdst.*', 'usrdvn.dvn')
                    ->get();

                $divisions = DB::table('usrdvn')
                ->where('usrdvn.dvn', 'like', "%$search%")
                ->orderBy('usrdvn.dvn', 'asc')
                ->select('usrdvn.*')
                ->get();

                $index_content = view('super.location.find_place')
                                            ->with('thanas', $thanas)
                                            ->with('districts', $districts)
                                            ->with('divisions', $divisions);
                return view('super.index')->with('content', $index_content);
            }else{
                $index_content = view('super.location.find_place');
                    return view('super.index')->with('content', $index_content);
            }
    }


    public function country_delete($id){
        $delete = DB::table('usrcnt')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'Country name deleted successfully!!!');
            return Redirect::to('/country-view');
        }else{
            Session::put('error', 'Country name not deleted!!!');
        }
    }


    public function country_edit($id){
        $country = DB::table('usrcnt')
                    ->where('id', $id)
                    ->get();
        $countries = DB::table('usrcnt')->get();
        $contry_edit = view('super.location.country_edit')
                    ->with('country', $country)
                    ->with('countries', $countries);
        return view('super.index')
            ->with('content', $contry_edit);
    }


    public function country_update(Request $request){
        $validator = Validator::make($request->all(), [
                    'cnt' => 'unique:usrcnt,cnt',
                        ], [
                    'cnt.unique' => 'This country name already added.',
        ]);

        if ($validator->passes()):
            $cnt = $request->cnt;
            $cntid = $request->cntid;
            
            DB::table('usrcnt')
            ->where('id', $cntid)
            ->update(['cnt' => $cnt]);
            
            return response()->json(['success' => '!!! Country name successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function division_update(Request $request){
        $validator = Validator::make($request->all(), [
                    'dvn' => 'unique:usrdvn,dvn',
                        ], [
                    'dvn.unique' => 'This division name already added.',
        ]);

        if ($validator->passes()):
            $dvnid = $request->dvnid;
            $dvn = $request->dvn;
            $cntid = $request->cntid;
            
            DB::table('usrdvn')
            ->where('id', $dvnid)
            ->update([
                'dvn' => $dvn,
                'cntid' => $cntid,
            ]);
            
            return response()->json(['success' => '!!! Division name successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function district_update(Request $request){
        $validator = Validator::make($request->all(), [
                    'dst' => 'unique:usrdst,dst',
                        ], [
                    'dst.unique' => 'This district name already added.',
        ]);

        if ($validator->passes()):
            $dvnid = $request->create_thana_division_id;
            $dstid = $request->dstid;
            $dst = $request->dst;
            
            DB::table('usrdst')
            ->where('id', $dstid)
            ->update([
                'dst' => $dst,
                'dvnid' => $dvnid,
            ]);
            
            return response()->json(['success' => '!!! District name successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }

    public function school_details($id) {
        $total_stn = DB::table('sclreg')
                    ->leftJoin('usrthn', 'usrthn.id', '=', 'sclreg.thnid')
                    ->where('sclreg.id', $id)
                    ->select('sclreg.*', 'usrthn.thn')
                    ->get();
        $sclreg = DB::table('sclreg')
                    ->leftJoin('usrthn', 'usrthn.id', '=', 'sclreg.thnid')
                    ->where('sclreg.id', $id)
                    ->select('sclreg.*', 'usrthn.thn')
                    ->get();
        $index_content = view('super.school_details')
                ->with('sclreg', $sclreg);

        return view('super.index')
                        ->with('page_content', $index_content);
    }


    public function scl_admin_view($id) {
        $admin_details = DB::table('usrreg')
                    ->leftJoin('usrpro', 'usrreg.id', '=', 'usrpro.usrid')
                    ->leftJoin('usrdvn', 'usrdvn.id', '=', 'usrpro.dvnid')
                    ->leftJoin('usrdst', 'usrdst.id', '=', 'usrpro.dstid')
                    ->leftJoin('usrthn', 'usrthn.id', '=', 'usrpro.thnid')
                    ->where('usrreg.id', $id)
                    ->select('usrreg.*', 'usrthn.thn', 'usrdst.dst', 'usrdvn.dvn', 'usrpro.abt', 'usrpro.fthr', 'usrpro.mthr', 'usrpro.rlgn', 'usrpro.dob', 'usrpro.pic')
                    ->get();
        $index_content = view('super.admin_details')
                ->with('admin_details', $admin_details);

        return view('super.index')
                        ->with('page_content', $index_content);
    }

    public function scl_tcr_view(Request $request, $sclcd) {
        $search = $request->searching_name;
        if ($search != NULL) {
            $data = DB::table('usrreg')
                    ->leftJoin('usrpro', 'usrreg.id', '=', 'usrpro.usrid')
                    ->leftJoin('usrdvn', 'usrdvn.id', '=', 'usrpro.dvnid')
                    ->leftJoin('usrdst', 'usrdst.id', '=', 'usrpro.dstid')
                    ->leftJoin('usrthn', 'usrthn.id', '=', 'usrpro.thnid')
                    ->orderBy('usrreg.id', 'desc')
                    ->where('usrreg.usrmbl', 'like', "$search")
                    ->orwhere('usrreg.usrnme', 'like', "%$search%")
                    ->orwhere('usrreg.usreml', 'like', "%$search%")
                    ->select('usrreg.*', 'usrthn.thn', 'usrdst.dst', 'usrdvn.dvn', 'usrpro.abt', 'usrpro.fthr', 'usrpro.mthr', 'usrpro.rlgn', 'usrpro.dob', 'usrpro.pic')
                    ->get();

            $index_content = view('super.scl_teachers_list_view')
                                        ->with('data', $data);
            return view('super.index')->with('content', $index_content); 
        }else{
            $data = DB::table('usrreg')
                    ->leftJoin('usrpro', 'usrreg.id', '=', 'usrpro.usrid')
                    ->leftJoin('usrdvn', 'usrdvn.id', '=', 'usrpro.dvnid')
                    ->leftJoin('usrdst', 'usrdst.id', '=', 'usrpro.dstid')
                    ->leftJoin('usrthn', 'usrthn.id', '=', 'usrpro.thnid')
                    ->where('usrreg.sclcd', $sclcd)
                    ->orderBy('usrreg.id', 'desc')
                    ->select('usrreg.*', 'usrthn.thn', 'usrdst.dst', 'usrdvn.dvn', 'usrpro.abt', 'usrpro.fthr', 'usrpro.mthr', 'usrpro.rlgn', 'usrpro.dob', 'usrpro.pic')
                    ->get();
            $index_content = view('super.scl_teachers_list_view')
                ->with('data', $data)
                ->with('sclcd', $sclcd);

            return view('super.index')
                        ->with('page_content', $index_content);
        }
    }

    public function teacher_details($id) {
        $teacher_details = DB::table('usrreg')
                    ->leftJoin('usrpro', 'usrreg.id', '=', 'usrpro.usrid')
                    ->leftJoin('usrdvn', 'usrdvn.id', '=', 'usrpro.dvnid')
                    ->leftJoin('usrdst', 'usrdst.id', '=', 'usrpro.dstid')
                    ->leftJoin('usrthn', 'usrthn.id', '=', 'usrpro.thnid')
                    ->where('usrreg.id', $id)
                    ->select('usrreg.*', 'usrthn.thn', 'usrdst.dst', 'usrdvn.dvn', 'usrpro.abt', 'usrpro.fthr', 'usrpro.mthr', 'usrpro.rlgn', 'usrpro.dob', 'usrpro.pic')
                    ->get();
        $index_content = view('super.teacher_details')
                ->with('teacher_details', $teacher_details);

        return view('super.index')
                        ->with('page_content', $index_content);
    }


    public function search_scl_list(Request $request) {
            $search = $request->searching_name;
            if($search != null){
                $data = DB::table('sclreg')
                        ->leftJoin('usrthn', 'usrthn.id', '=', 'sclreg.thnid')
                        ->orderBy('sclreg.id', 'asc')
                        ->where('sclreg.sclcd', 'like', "$search")
                        ->orwhere('sclreg.sclnme', 'like', "%$search%")
                        ->orderBy('sclreg.sclnme', 'asc')
                        ->select('sclreg.*', 'usrthn.thn')
                        ->get();

                $index_content = view('super.scl_search')
                                            ->with('data', $data);
                return view('super.index')->with('content', $index_content);
            }else{                
                $data = DB::table('sclreg')
                    ->leftJoin('usrthn', 'usrthn.id', '=', 'sclreg.thnid')
                    ->orderBy('sclreg.id', 'asc')
                    ->select('sclreg.*', 'usrthn.thn')
                    ->get();
                $index_content = view('super.scl_search')
                        ->with('data', $data);

                return view('super.index')
                    ->with('page_content', $index_content);
            }
    }





















    // public function division($id) {
    //     $country_id = $id;
    //     $division = DB::table('division')->where('country_id', $country_id)->get();
    //     echo '<option value="">Select Country</option>';
    //     foreach ($division as $dvn):
    //         echo '<option value="' . $dvn->id . '">' . $dvn->division_name . '</option>';
    //     endforeach;
    // }

    // public function district($id) {
    //     $divesion_id = $id;
    //     $district = DB::table('district')->where('division_id', $divesion_id)->get();
    //     echo '<option value="">Select District</option>';
    //     foreach ($district as $dist):
    //         echo '<option value="' . $dist->id . '">' . $dist->district_name . '</option>';
    //     endforeach;
    // }

    // public function thana($id) {
    //     $thana = DB::table('thana')->where('district_id', $id)->get();
    //     echo '<option value="">Select Thana</option>';
    //     foreach ($thana as $thn):
    //         echo '<option value="' . $thn->id . '">' . $thn->thana_name . '</option>';
    //     endforeach;
    // }










    public function classes_list(){
        $superAdminId = Session::get('superAdminId');
        if ($superAdminId == Null) {
            return Redirect::to('/super/')->send();
        }else{
            $classes = DB::table('class')->get();
            $classes_list = view('super.classes_list')->with('classes', $classes);
            return view('super.index')
                ->with('page_content', $classes_list);
        }
    }

    public function class_create(Request $request){
        $validator = Validator::make($request->all(), [
                    'class_name' => 'unique:class,class_name',
                        ], [
                    'class_name.unique' => 'This class name already added.',
        ]);

        if ($validator->passes()):
            $class_name = $request->class_name;
            
            DB::table('class')->insert(['class_name' => $class_name]);
            
            return response()->json(['success' => '!!! Class name successfully added. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function class_delete($id){
        $delete = DB::table('class')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'Class name deleted successfully!!!');
            return Redirect::to('/classes_list');
        }else{
            Session::put('error', 'Class name not deleted successfully!!!');
        }
    }


    public function class_edit($id){
        $class = DB::table('class')
                    ->where('id', $id)
                    ->get();
        $classes = DB::table('class')->get();
        $classes_list = view('super.class_edit')
                    ->with('class', $class)
                    ->with('classes', $classes);
        return view('super.index')
            ->with('page_content', $classes_list);
    }


    public function class_update(Request $request){
        $validator = Validator::make($request->all(), [
                    'class_name' => 'unique:class,class_name',
                        ], [
                    'class_name.unique' => 'This class name already added.',
        ]);

        if ($validator->passes()):
            $class_name = $request->class_name;
            $class_id = $request->class_id;
            
            DB::table('class')
            ->where('id', $class_id)
            ->update(['class_name' => $class_name]);
            
            return response()->json(['success' => '!!! Class name successfully added. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function new_users()
    {
        $new_users = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','!=', '1')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $new_users_page = view('super.new_users')->with('new_users', $new_users);
        return view('super.index')->with('page_content', $new_users_page);
    }
    public function active_users()
    {
        $new_users = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','=', '1')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $new_users_page = view('super.users')->with('new_users', $new_users);
        return view('super.index')->with('page_content', $new_users_page);
    }

    public function user_active($id){
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '1']);
        if($update){
            Session::put('message', 'User Activated!!!');
            return Redirect::to('/new_users');
        }else{
            Session::put('error', 'User Not Activated!!!');
        }
    }

    public function user_deactive($id){
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '0']);
        if($update){
            Session::put('message', 'User Deactivated!!!');
            return Redirect::to('/active_users');
        }else{
            Session::put('error', 'User Not Deactivated!!!');
        }
    }

    public function user_delete($id){
        $delete = DB::table('users')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'User Deleted!!!');
            return Redirect::to('/new_users');
        }else{
            Session::put('error', 'User Not Deleted!!!');
        }
    }

    public function features_add_page()
    {
        $features = DB::table('features')->get();
        $add_features = view('super.add_features')->with('features', $features);
        return view('super.index')->with('page_content', $add_features);
    }

    public function features_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'feature' => 'unique:features,feature',
                        ], [
                    'feature.unique' => 'This feature already added.',
        ]);

        if ($validator->passes()):
            $feature = $request->feature;
            
            DB::table('features')->insert(['feature' => $feature]);
            
            return response()->json(['success' => '!!! Feature successfully added. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }

    public function feature_edit($id)
    {
        $feature = DB::table('features')
                    ->where('id', $id)
                    ->get();
        $features = DB::table('features')->get();
        $feature_edit = view('super.feature_edit')
                    ->with('feature', $feature)
                    ->with('features', $features);
        return view('super.index')
            ->with('page_content', $feature_edit);
    }

    public function feature_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
                    'feature' => 'unique:features,feature',
                        ], [
                    'feature.unique' => 'This feature no change anything.',
        ]);

        if ($validator->passes()):
            $feature = $request->feature;
            $id = $request->id;
            
            DB::table('features')
                ->where('id', $id)
                ->update(['feature' => $feature]);
            
            return response()->json(['success' => '!!! Feature successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }

    public function feature_delete($id)
    {
        $delete = DB::table('features')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'Feature Deleted!!!');
            return Redirect::to('/features_add_page');
        }else{
            Session::put('error', 'Feature Not Deleted!!!');
        }
    }

    public function teachers(){
        $users = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','=', '1')
                    ->where('user_type','=', 'teacher')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();
        $index_content = view('super.teachers')
        ->with('users', $users);
        
        return view('super.index')
        ->with('page_content', $index_content);
    }


    public function logoutSuper() {
        Session::put('SuperAdminName', null);
        Session::put('superAdminId', null);
        Session::put('message', 'You are successfully logout');
        return Redirect::to('/sm-super-admin/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
