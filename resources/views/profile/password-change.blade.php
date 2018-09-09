@extend('dboardcontainer')

@section('title', 'Password Change')

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
                        <li><a href="{{ url('/edit-profile/') }}"> <i class="icon-edit"></i> Edit profile</a></li>
                        <li class="active"><a href="{{ url('/change-password/') }}"> <i class="icon-key"></i> Change Password</a></li>
                    </ul>

                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        <h1>Set New Password</h1>
                    </div>
                </section>
                <section>
                    <div class="panel panel-primary">
                        <div class="panel-heading"> Sets New Password</div>
                        <div class="panel-body">
                            <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                            <form action="{{ url('/password-change/') }}" class="form-horizontal" role="form" method="POST" id="data_form">
                                @csrf
                                <div class="form-group">
                                    <label for="crnt_psd" class="col-lg-2 control-label">Current Password</label>
                                    <div class="col-lg-6">
                                        <input name="crnt_psd" type="password" class="form-control" id="crnt_psd" placeholder=" ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_psd" class="col-lg-2 control-label">New Password</label>
                                    <div class="col-lg-6">
                                        <input name="new_psd" type="password" class="form-control" id="new_psd" placeholder=" ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_cpsd" class="col-lg-2 control-label">Re-type New Password</label>
                                    <div class="col-lg-6">
                                        <input name="new_cpsd" type="password" class="form-control" id="new_cpsd" placeholder=" ">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
        <!-- page end-->
    </section>
</section>
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