@extend('dboardcontainer')

@section('title', 'Edit Profile')

@section('content')

<style>
    .form-control {
        color: #000;
    }
</style>{



<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <aside class="profile-nav col-lg-3">
                <section class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <img src="{{ asset('wbdlibs/img/profile-avatar.jpg') }}" alt="">
                        </a>
                        <h1>{{ Session::get('usrInfo')->usrnme }}</h1>
                        <p>{{ Session::get('usrInfo')->usreml }}</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="{{ url('/profile/') }}"> <i class="icon-user"></i> Profile</a></li>
                        <li class="active"><a href="{{ url('/edit-profile/') }}"> <i class="icon-edit"></i> Edit profile</a></li>
                        <li><a href="{{ url('/change-password/') }}"> <i class="icon-key"></i> Change Password</a></li>
                    </ul>

                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        <h1>Edit Profile</h1>
                    </div>
                    <?php
                    $usrId = Session::get('usrInfo')->id;
                    $proInfo = DB::table('usrpro')
                            ->join('usrcnt', 'usrpro.cntid', '=', 'usrcnt.id')
                            ->join('usrdvn', 'usrpro.dvnid', '=', 'usrdvn.id')
                            ->join('usrdst', 'usrpro.dstid', '=', 'usrdst.id')
                            ->join('usrthn', 'usrpro.thnid', '=', 'usrthn.id')
                            ->select('usrpro.*', 'usrcnt.cnt', 'usrdvn.dvn', 'usrdst.dst', 'usrthn.thn')
                            ->where('usrid', $usrId)
                            ->first();
                    if($proInfo){
                        $disable = 'readonly="readonly"';
                    }else{
                        $disable = "";
                    }
                    ?> 
                    <div class="panel-body bio-graph-info">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <form action="{{ url('/update-profile/') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" id="data_form">
                            @csrf
                            <div class="form-group">
                                <label for="abt"  class="col-lg-2 control-label">About Me *</label>
                                <div class="col-lg-10">
                                    <textarea name="abt" id="abt" class="form-control" cols="30" rows="10" placeholder="About Yourself"><?php if($proInfo){echo $proInfo->abt;} ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fthr" class="col-lg-2 control-label">Father&#8217;s Name *</label>
                                <div class="col-lg-6">
                                    <input type="text" name="fthr" class="form-control" id="fthr" value="<?php if($proInfo){echo $proInfo->fthr;} ?>" placeholder="Father&#8217;s Name" {{ $disable }}>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mthr" class="col-lg-2 control-label">Mother&#8217;s Name *</label>
                                <div class="col-lg-6">
                                    <input type="text" name="mthr" class="form-control" id="mthr" value="<?php if($proInfo){echo $proInfo->mthr;} ?>" placeholder="Mother&#8217;s Name" {{ $disable }}>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cnt" class="col-sm-2 control-label"> Country *</label>
                                <div class="col-sm-6">
                                    <?php
                                    $countries = DB::table('usrcnt')->get();
                                    ?>
                                    <select class="form-control" name="cnt" id="cnt" onchange="ajaxGET('dvn','{{URL::to('/division/')}}/'+this.value)">
                                        <option value="<?php if($proInfo){echo $proInfo->cntid;}else{echo "";} ?>"><?php if($proInfo){echo $proInfo->cnt;}else{echo "Select Country";} ?></option>
                                        @foreach ($countries as $country)
                                        @if ($country->cnt == 'Bangladesh')
                                        <option value="{{ $country->id }}">{{ $country->cnt }}</option>
                                        @else
                                        <option value="{{ $country->id }}" disabled="disabled">{{ $country->cnt }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> <!-- /.form-group -->

                            <div class="form-group">
                                <label for="dvn" class="col-sm-2 control-label"> Division *</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="dvn" id="dvn" onchange="ajaxGET('dst','{{URL::to('/district/')}}/'+this.value)">
                                        <option value="<?php if($proInfo){echo $proInfo->dvnid;}else{echo "";} ?>"><?php if($proInfo){echo $proInfo->dvn;}else{echo "Select Country First";} ?></option>
                                    </select>
                                </div>
                            </div> <!-- /.form-group -->

                            <div class="form-group">
                                <label for="dst" class="col-sm-2 control-label"> District *</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="dst" id="dst" onchange="ajaxGET('thn','{{URL::to('/thana/')}}/'+this.value)">
                                        <option value="<?php if($proInfo){echo $proInfo->dstid;}else{echo "";} ?>"><?php if($proInfo){echo $proInfo->dst;}else{echo "Select Division First";} ?></option>
                                    </select>
                                </div>
                            </div> <!-- /.form-group -->

                            <div class="form-group">
                                <label for="thn" class="col-sm-2 control-label"> Thana *</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="thn" id="thn">
                                        <option value="<?php if($proInfo){echo $proInfo->thnid;}else{echo "";} ?>"><?php if($proInfo){echo $proInfo->thn;}else{echo "Select District First";} ?></option>
                                    </select>
                                </div>
                            </div> <!-- /.form-group -->

                            <div class="form-group">
                                <label for="adrs" class="col-sm-2 control-label"> Address *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="adrs" class="form-control" placeholder="PO,Village etc" id="adrs" value="<?php if($proInfo){echo $proInfo->adr;} ?>" {{ $disable }} />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="rlgn" class="col-sm-2 control-label"> Religion *</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="rlgn" id="rlgn">
                                        <option value="<?php if($proInfo){echo $proInfo->rlgn;}else{echo "";} ?>"><?php if($proInfo){echo $proInfo->rlgn;}else{echo "Select Religion";} ?></option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Cristian">Christianity</option>
                                        <option value="Buddhist">Buddhist</option>
                                    </select>
                                </div>
                            </div> <!-- /.form-group -->

                            <div class="form-group">
                                <label for="dob" class="col-lg-2 control-label">Date of Birth *</label>
                                <div class="col-lg-6">
                                    <input name="dob" type="text" class="form-control" id="datepicker1" placeholder="Date of Birth" value="<?php if($proInfo){echo $proInfo->dob;} ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mbl" class="col-lg-2 control-label">Mobile</label>
                                <div class="col-lg-6">
                                    <input name="mbl" type="text" class="form-control" id="mbl" placeholder="Mobile Number" value="<?php if($proInfo){echo $proInfo->mbl;} ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="skl" class="col-lg-2 control-label">Other Skill</label>
                                <div class="col-lg-6">
                                    <input name="skl" type="text" class="form-control" id="skl" placeholder="Other's Skill" value="<?php if($proInfo){echo $proInfo->skl;} ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </aside>
        </div>
        <!-- page end-->
    </section>
</section>
@endsection
@section('jqueryfile')
<script src="{{ asset('wbdlibs/ajax/ajax.js') }}"></script>
@endsection

@section('jsscript')
<!-- Ajax script for form validation -->
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$('#data_form').on('submit', function (e) {
e.preventDefault();
data = $(this).serialize();
url = $(this).attr('action');

$.ajax({
url: url,
type: 'POST',
data: data,
success: function (data) {
console.log(data);
if ($.isEmptyObject(data.errors)) {
console.log(data.success);
$('#data_form')[0].reset();
$('.text-danger').remove();
$('.form-group').removeClass('has-error').removeClass('has-success');
$('.print-success-msg').html(data.success);
$('.print-success-msg').css('display', 'block');
} else {
printMessageErrors(data.errors);
}
}
});
});

function printMessageErrors(msg) {
$('.form-group').removeClass('has-error').find('.text-danger').remove();
$.each(msg, function (key, value) {
var element = $('#' + key);
element.closest('div.form-group')
.addClass(value.length > 0 ? 'has-error' : 'has-success');
$('.control-label').css('color', '#797979');
element.after('<span class="text-danger"><span class="glyphicon glyphicon-exclamation-sign text-danger"></span> ' + value + '</span>');
});
}
<!-- Ajax -->
@endsection