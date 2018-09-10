@extends('super.header')

@section('title', 'Super Admin Login - WBDSchools')

@section('content')
<form class="form-signin" action="{{ url('/super-admin-login/') }}" method="post" style="max-width: 330px;">
    @csrf
    <h2 class="form-signin-heading">Super Admin Login</h2>
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

        @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
            {{Session::put('message', null)}}
        </div>
        @endif
        
        <input type="text" name="username" class="form-control" placeholder="Username or Email" required="required" />
        <input type="password" name="password" class="form-control" placeholder="Password" required="required" />
        <br/>
        <button class="btn btn-lg btn-login btn-block" type="submit">Login</button>

    </div>

</form>


@endsection