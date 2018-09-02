@extend('homecontainer')

@section('title', 'School Registration - WBDSchools')
@section('content')

<style>
    .form-group select {
        margin-top: 15px;
        color: #000000;
    }
</style>

<div class="container">

    <form class="form-signin" action="{{ URL::to('school-data') }}" method="post" id="data_form">
        <h2 class="form-signin-heading"><strong>school registration form</strong></h2>
        <div class="login-wrap">

            <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>

            <p><strong>Enter School Details Below</strong></p>
            @csrf
            <div class="form-group">
                <label for="scl_nme" class="col-sm-3 control-label">School Name *</label>
                <div class="col-sm-9">
                    <input type="text" name="scl_nme" class="form-control" placeholder="School Name" id="scl_nme" />
                </div>
            </div>

            <div class="form-group">
                <label for="scl_eml" class="col-sm-3 control-label">School Email *</label>
                <div class="col-sm-9">
                    <input type="text" name="scl_eml" class="form-control" placeholder="School Email" id="scl_eml" />
                </div>
            </div>

            <div class="form-group">
                <label for="scl_cde" class="col-sm-3 control-label">School Code *</label>
                <div class="col-sm-9">
                    <input type="text" name="scl_cde" class="form-control" placeholder="School Code" id="scl_cde" />
                </div>
            </div>
            
            
            
            <div class="form-group">
                    <label for="scl_cnt" class="col-sm-3 control-label">School Country *</label>
                    <div class="col-sm-9">
	                    <?php
	                    $countries = DB::table('usrcnt')->get();
	                    ?>
	                    <select class="form-control" name="scl_cnt" id="scl_cnt" onchange="ajaxGET('scl_dvn','{{URL::to('/division/')}}/'+this.value)">
	                        <option value="">Select Country</option>
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
                    <label for="scl_dvn" class="col-sm-3 control-label">School Division *</label>
                    <div class="col-sm-9">
	                    <select class="form-control" name="scl_dvn" id="scl_dvn" onchange="ajaxGET('scl_dst','{{URL::to('/district/')}}/'+this.value)">
	                        <option value="">Select Country First</option>
	                    </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="scl_dst" class="col-sm-3 control-label">School District *</label>
                    <div class="col-sm-9">
	                    <select class="form-control" name="scl_dst" id="scl_dst" onchange="ajaxGET('scl_thn','{{URL::to('/thana/')}}/'+this.value)">
	                        <option value="">Select Division First</option>
	                    </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="scl_thn" class="col-sm-3 control-label">School Thana *</label>
                    <div class="col-sm-9">
	                    <select class="form-control" name="scl_thn" id="scl_thn">
	                        <option value="">Select District First</option>
	                    </select>
                    </div>
                </div> <!-- /.form-group -->

            <div class="form-group">
                <label for="scl_adr" class="col-sm-3 control-label">School Address *</label>
                <div class="col-sm-9">
                    <input type="text" name="scl_adr" class="form-control" placeholder="PO,Village etc" id="scl_adr" />
                </div>
            </div>

            <div class="form-group">
                <label for="rfr_id" class="col-sm-3 control-label">Referral ID</label>
                <div class="col-sm-9" style="margin-bottom: 15px;">
                    <input type="text" name="rfr_id" class="form-control" placeholder="Referral ID" id="rfr_id" />
                </div>
            </div>

            <p><strong>Enter School Admin Details Below</strong></p>

            <div class="form-group">
                <label for="adn_nme" class="col-sm-3 control-label">Admin Full Name *</label>
                <div class="col-sm-9">
                    <input type="text" name="adn_nme" class="form-control" placeholder="Admin Full Name" id="adn_nme" />
                </div>
            </div>

            <div class="form-group">
                <label for="adn_eml" class="col-sm-3 control-label">Admin Email *</label>
                <div class="col-sm-9">
                    <input type="text" name="adn_eml" class="form-control" placeholder="Admin Email" id="adn_eml" />
                </div>
            </div>

            <div class="form-group">
                <label for="adn_gnr" class="col-sm-3 control-label">Admin Gender *</label>
                <div class="col-sm-9">
                    <div class="form-control col-sm-9" id="adn_gnr" style="border: none; margin-top: 15px;">
                        <input name="adn_gnr" id="radio-01" value="Male" type="radio" /> Male
                        <input name="adn_gnr" id="radio-02" value="Female" type="radio" /> Female
                        <input name="adn_gnr" id="radio-03" value="Unknown" type="radio" /> Unknown
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="adn_rnk" class="col-sm-3 control-label">Admin Designation *</label>
                <div class="col-sm-9">
                    <input type="text" name="adn_rnk" class="form-control" placeholder="Admin Designation" id="adn_rnk" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="adn_uid" class="col-sm-3 control-label">Admin Username *</label>
                <div class="col-sm-9">
                    <input type="text" name="adn_uid" class="form-control" placeholder="Admin Username" id="adn_uid" />
                </div>
            </div>

            <div class="form-group">
                <label for="adn_psd" class="col-sm-3 control-label">Admin Password *</label>
                <div class="col-sm-9">
                    <input type="password" name="adn_psd" class="form-control" placeholder="Password" id="adn_psd" />
                </div>
            </div>

            <div class="form-group">
                <label for="adn_cpd" class="col-sm-3 control-label">Confirm Password *</label>
                <div class="col-sm-9">
                    <input type="password" name="adn_cpd" class="form-control" placeholder="Confirm Password" id="adn_cpd" />
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-9">
                    <input type="checkbox" value="agree this condition"> I agree to the <a href="">Terms of Service</a> and <a href="">Privacy Policy</a>
                </div>
            </div>

            <input class="btn btn-lg btn-login btn-block" type="submit" value="Register" />

            <div class="registration">
                Already Registered.
                <a class="" href="login">
                    Login
                </a>
            </div>

        </div>

    </form>

</div>

@endsection