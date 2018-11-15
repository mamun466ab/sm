@extend('homecontainer')

@section('title', 'Referrer Registration - WBDSchools')
@section('content')

<style>
    .form-group select {
        margin-top: 15px;
        color: #000000;
    }
</style>

<div class="container">

    <form class="form-signin" action="{{ URL::to('/referrer-data') }}" method="post" id="data_form">
        <h2 class="form-signin-heading"><strong>Referrer registration form</strong></h2>
        <div class="login-wrap">

            <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>

            <p><strong>Enter Referrer Details Below</strong></p>
            @csrf
            <div class="form-group">
                <label for="ref_nme" class="col-sm-3 control-label">Referrer Name *</label>
                <div class="col-sm-9">
                    <input type="text" name="ref_nme" class="form-control" placeholder="Referrer Name" id="ref_nme" />
                </div>
            </div>            

            <div class="form-group">
                <label for="ref_usrname" class="col-sm-3 control-label">Referrer Username *</label>
                <div class="col-sm-9">
                    <input type="text" name="ref_usrname" class="form-control" placeholder="Referrer Username" id="ref_usrname" />
                </div>
            </div>

            <div class="form-group">
                <label for="ref_eml" class="col-sm-3 control-label">Referrer Email *</label>
                <div class="col-sm-9">
                    <input type="text" name="ref_eml" class="form-control" placeholder="Referrer Email" id="ref_eml" />
                </div>
            </div>

            <div class="form-group">
                <label for="ref_cnt" class="col-sm-3 control-label">Referrer Country *</label>
                <div class="col-sm-9">
                    <?php
                    $countries = DB::table('usrcnt')->get();
                    ?>
                    <select class="form-control" name="ref_cnt" id="ref_cnt" onchange="ajaxGET('ref_dvn','{{URL::to('/division/')}}/'+this.value)">
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
                <label for="ref_dvn" class="col-sm-3 control-label">Referrer Division *</label>
                <div class="col-sm-9">
                    <select class="form-control" name="ref_dvn" id="ref_dvn" onchange="ajaxGET('ref_dst','{{URL::to('/district/')}}/'+this.value)">
                        <option value="">Select Country First</option>
                    </select>
                </div>
            </div> <!-- /.form-group -->

            <div class="form-group">
                <label for="ref_dst" class="col-sm-3 control-label">Referrer District *</label>
                <div class="col-sm-9">
                    <select class="form-control" name="ref_dst" id="ref_dst" onchange="ajaxGET('ref_thn','{{URL::to('/thana/')}}/'+this.value)">
                        <option value="">Select Division First</option>
                    </select>
                </div>
            </div> <!-- /.form-group -->

            <div class="form-group">
                <label for="ref_thn" class="col-sm-3 control-label">Referrer Thana *</label>
                <div class="col-sm-9">
                    <select class="form-control" name="ref_thn" id="ref_thn">
                        <option value="">Select District First</option>
                    </select>
                </div>
            </div> <!-- /.form-group -->

            <div class="form-group">
                <label for="ref_adr" class="col-sm-3 control-label">Referrer Address *</label>
                <div class="col-sm-9">
                    <input type="text" name="ref_adr" class="form-control" placeholder="PO,Village etc" id="ref_adr" />
                </div>
            </div>

            <div class="form-group">
                <label for="ref_gnr" class="col-sm-3 control-label">Referrer Gender *</label>
                <div class="col-sm-9">
                    <div class="form-control col-sm-9" id="ref_gnr" style="border: none; margin-top: 15px;">
                        <input name="ref_gnr" id="radio-01" value="Male" type="radio" /> Male
                        <input name="ref_gnr" id="radio-02" value="Female" type="radio" /> Female
                        <input name="ref_gnr" id="radio-03" value="Unknown" type="radio" /> Unknown
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="ref_mbl" class="col-sm-3 control-label">Referrer Mobile *</label>
                <div class="col-sm-9">
                    <input type="text" name="ref_mbl" class="form-control" placeholder="Referrer Mobile Number" id="ref_mbl" />
                </div>
            </div>

            <div class="form-group">
                <label for="ref_psd" class="col-sm-3 control-label">Referrer Password *</label>
                <div class="col-sm-9">
                    <input type="password" name="ref_psd" class="form-control" placeholder="Password" id="ref_psd" />
                </div>
            </div>

            <div class="form-group">
                <label for="ref_cpd" class="col-sm-3 control-label">Confirm Password *</label>
                <div class="col-sm-9">
                    <input type="password" name="ref_cpd" class="form-control" placeholder="Confirm Password" id="ref_cpd" />
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <div id="check_policy">
                        <input type="checkbox" name="check_policy" value="agree this condition" id="check_policy"> I agree to the <a href="">Terms of Service</a> and <a href="">Privacy Policy</a>
                    </div>
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