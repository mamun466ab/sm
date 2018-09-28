@extend('dboardcontainer')

@section('title', 'Add Teacher')

@section('content')
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="container" style="margin-bottom: 15px; margin-top: -100px;">
            <form class="form-signin" action="{{ URL::to('teacher-data') }}" method="post" id="data_form">
                <h2 class="form-signin-heading"><strong>teacher registration form</strong></h2>
                <div class="login-wrap">

                    <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>

                    <p><strong>Enter your personal details below</strong></p>

                    @csrf

                    <div class="form-group">
                        <label for="tcr_nme" class="col-sm-3 control-label">Teacher Full Name *</label>
                        <div class="col-sm-9">
                            <input type="text" name="tcr_nme" class="form-control" placeholder="Teacher Full Name" id="tcr_nme" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tcr_eml" class="col-sm-3 control-label">Teacher Email *</label>
                        <div class="col-sm-9">
                            <input type="text" name="tcr_eml" class="form-control" placeholder="Teacher Email" id="tcr_eml" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tcr_gnr" class="col-sm-3 control-label">Teacher Gender *</label>
                        <div class="col-sm-9">
                            <div class="form-control col-sm-9" id="tcr_gnr" style="border: none; margin-top: 15px;">
                                <input name="tcr_gnr" id="radio-01" value="Male" type="radio" /> Male
                                <input name="tcr_gnr" id="radio-02" value="Female" type="radio" /> Female
                                <input name="tcr_gnr" id="radio-03" value="Unknown" type="radio" /> Unknown
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tcr_rnk" class="col-sm-3 control-label">Designation *</label>
                        <div class="col-sm-9">
                            <input type="text" name="tcr_rnk" class="form-control" placeholder="Teacher Designation" id="tcr_rnk" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="scl_cde" class="col-sm-3 control-label">School Code *</label>
                        <div class="col-sm-9" style="margin-bottom: 15px;">
                            <input type="text" name="scl_cde" class="form-control" value="{{ Session::get('usrInfo')->sclcd }}" readonly="readonly" id="scl_cde" />
                        </div>
                    </div>

                    <p><strong>Enter your account details below</strong></p>

                    <div class="form-group">
                        <label for="tcr_uid" class="col-sm-3 control-label">Teacher Username *</label>
                        <div class="col-sm-9">
                            <input type="text" name="tcr_uid" class="form-control" placeholder="Teacher Username" id="tcr_uid" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tcr_psd" class="col-sm-3 control-label">Teacher Password *</label>
                        <div class="col-sm-9">
                            <input type="password" name="tcr_psd" class="form-control" placeholder="Password" id="tcr_psd" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tcr_cpd" class="col-sm-3 control-label">Confirm Password *</label>
                        <div class="col-sm-9">
                            <input type="password" name="tcr_cpd" class="form-control" placeholder="Confirm Password" id="tcr_cpd" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9">
                            <input type="checkbox" value="agree this condition"> I agree to the <a href="">Terms of Service</a> and <a href="">Privacy Policy</a>
                        </div>
                    </div>
                    <input class="btn btn-lg btn-login btn-block" type="submit" value="Register" />
                </div>
            </form>
        </div>
    </section>
</section>
@endsection