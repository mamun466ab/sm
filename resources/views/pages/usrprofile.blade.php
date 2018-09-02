@extend('dboardcontainer')

@section('title', 'User Profile')

@section('content')
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
                        <h1>Jonathan Smith</h1>
                        <p>jsmith@flatlab.com</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="{{ url('/profile/') }}"> <i class="icon-user"></i> Profile</a></li>
                        <!--<li><a href="profile-activity.html"> <i class="icon-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a></li>-->
                        <li><a href="{{ url('/edit-profile/') }}"> <i class="icon-edit"></i> Edit profile</a></li>
                    </ul>

                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        <h1>User Profile</h1>
                    </div>
                    <div class="panel-body bio-graph-info">
                        <div class="row">
                            <div class="bio-row">
                                <p><span>Name </span>: {{ Session::get('usrInfo')->usrnme }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Last Name </span>: Smith</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Country </span>: Australia</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Birthday</span>: 13 July 1983</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Occupation </span>: UI Designer</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Email </span>: {{ Session::get('usrInfo')->usreml }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Mobile </span>: (12) 03 4567890</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Phone </span>: 88 (02) 123456</p>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        <!-- page end-->
    </section>
</section>
@endsection