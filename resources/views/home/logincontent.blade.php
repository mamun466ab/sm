@extend('homecontainer')

@section('title', 'Login - WBDSchools')

@section('content')
<form class="form-signin" action="{{ url('user-login') }}" method="post" style="max-width: 330px;">
    @csrf
    <h2 class="form-signin-heading">sign in now</h2>
    <div class="login-wrap">
        <!--
        Error message
        -->
        @if(session('errors'))
        <div class="alert alert-danger">
            {{session('errors')}}
            {{Session::put('errors', null)}}
        </div>
        @endif
        
        <input type="text" name="usr_nme" class="form-control" placeholder="Username or Email" required="required" />
        <input type="password" name="usr_psd" class="form-control" placeholder="Password" required="required" />
        <label class="checkbox">
    <!--            <input type="checkbox" value="remember-me" disabled="disabled" /> Remember me-->
            <span class="pull-right">
                <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
            </span>
        </label>
        <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
        <p>or you can sign in via social network</p>
        <div class="login-social-link">
            <a href="index.html" class="facebook" style="pointer-events: none; cursor: default; opacity: 0.5;">
                <i class="icon-facebook"></i>
                Facebook
            </a>
            <a href="index.html" class="twitter" style="pointer-events: none; cursor: default; opacity: 0.5;">
                <i class="icon-twitter"></i>
                Twitter
            </a>
        </div>
        <div class="registration">
            Create an account

            <a class="" href="{{ URL::to('school-registration') }}">School</a> / <a class="" href="{{ URL::to('teacher-registration') }}">Teacher</a> / <a class="" href="{{ URL::to('student-registration') }}">Student</a>

        </div>

    </div>

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Forgot Password ?</h4>
                </div>
                <div class="modal-body">
                    <p>Enter your e-mail address below to reset your password.</p>
                    <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                    <button class="btn btn-success" type="button">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->

</form>
@endsection