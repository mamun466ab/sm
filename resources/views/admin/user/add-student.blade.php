@extend('dboardcontainer')

@section('title', 'Add Student')

@section('content')
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">

        <div class="container" style="margin-bottom: 15px; margin-top: -100px;">

            <form class="form-signin" action="{{ URL::to('student-data') }}" method="post" id="data_form">
                <h2 class="form-signin-heading"><strong>student registration form</strong></h2>
                <div class="login-wrap">

                    <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>

                    <p><strong>Enter your personal details below</strong></p>

                    @csrf

                    <div class="form-group">
                        <label for="std_nme" class="col-sm-3 control-label">Student Full Name *</label>
                        <div class="col-sm-9">
                            <input type="text" name="std_nme" class="form-control" placeholder="Student Full Name" id="std_nme" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="std_eml" class="col-sm-3 control-label">Student Email *</label>
                        <div class="col-sm-9">
                            <input type="text" name="std_eml" class="form-control" placeholder="Student Email" id="std_eml" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="std_gnr" class="col-sm-3 control-label">Student Gender *</label>
                        <div class="col-sm-9">
                            <div class="form-control col-sm-9" id="std_gnr" style="border: none; margin-top: 15px;">
                                <input name="std_gnr" id="radio-01" value="Male" type="radio" /> Male
                                <input name="std_gnr" id="radio-02" value="Female" type="radio" /> Female
                                <input name="std_gnr" id="radio-03" value="Unknown" type="radio" /> Unknown
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="std_cls" class="col-sm-3 control-label">Student Class *</label>
                        <div class="col-sm-9">
                            <select name="std_cls" id="std_cls" class="form-control" style="color: #000; padding: 6px; margin-top: 15px;">
                                <option value="">Select Your Class</option>
                                <option value="6">Class Six</option>
                                <option value="7">Class Seven</option>
                                <option value="8">Class Eight</option>
                                <option value="9">Class Nine</option>
                                <option value="10">Class Ten</option>
                                <option value="11">Enter 1st Year</option>
                                <option value="12">Enter 2nd Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="std_rol" class="col-sm-3 control-label">Student Roll *</label>
                        <div class="col-sm-9">
                            <input type="text" name="std_rol" class="form-control" placeholder="Student Roll" id="std_rol" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ssn_yr" class="col-sm-3 control-label">Session *</label>
                        <div class="col-sm-9">
                            <select name="ssn_yr" id="ssn_yr" class="form-control" style="color: #000; padding: 6px; margin-top: 15px;">
                                <option value="">Select Year</option>

                                @for($i = 2010; $i <= (date('Y') + 1); $i++){
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor;
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="scl_cde" class="col-sm-3 control-label">School Code *</label>
                        <div class="col-sm-9" style="margin-bottom: 15px;">
                            <input type="text" name="scl_cde" class="form-control" value="{{ Session::get('usrInfo')->sclcd }}" id="scl_cde" readonly="readonly" />
                        </div>
                    </div>

                    <p><strong>Enter your account details below</strong></p>

                    <div class="form-group">
                        <label for="std_uid" class="col-sm-3 control-label">Student Username *</label>
                        <div class="col-sm-9">
                            <input type="text" name="std_uid" class="form-control" placeholder="Student Username" id="std_uid" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="std_psd" class="col-sm-3 control-label">Student Password *</label>
                        <div class="col-sm-9">
                            <input type="password" name="std_psd" class="form-control" placeholder="Password" id="std_psd" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="std_cpd" class="col-sm-3 control-label">Confirm Password *</label>
                        <div class="col-sm-9">
                            <input type="password" name="std_cpd" class="form-control" placeholder="Confirm Password" id="std_cpd" />
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