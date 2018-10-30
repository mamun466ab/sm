@extend('dboardcontainer')

@section('title', 'User Profile')

@section('content')
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <aside class="profile-nav col-lg-3">
                <section class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <img src="{{ asset('wbdlibs/img/profile-avatar.jpg') }}" alt="">
                        </a>
                        <h1>{{ Session::get('usrInfo')->usrnme }} <br />
                            <?php
                            if (Session::get('usrInfo')->usrpwr == 1) {
                                echo '( Admin )';
                            } else {
                                echo '(' . Session::get('usrInfo')->usrtyp . ')';
                            }
                            ?>
                        </h1>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="{{ url('/profile/') }}"> <i class="icon-user"></i> Profile</a></li>
                        <li><a href="{{ url('/edit-profile/') }}"> <i class="icon-edit"></i> Edit profile</a></li>
                        <li><a href="{{ url('/change-password/') }}"> <i class="icon-key"></i> Change Password</a></li>
                    </ul>

                </section>
            </aside>
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
            if ($proInfo) {
                $disable = 'readonly="readonly"';
            } else {
                $disable = "";
            }
            ?> 
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        <h1>User Profile</h1>
                    </div>
                    <div class="panel-body bio-graph-info">
                        <div class="row">
                            <h3 class="form-signin-heading" align="center"><strong><u>Personal Information</u></strong></h3>
                            <div class="bio-row">
                                <p><span>Name </span>: {{ Session::get('usrInfo')->usrnme }}</p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Father&#8217;s Name </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->fthr;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Mother&#8217;s Name </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->mthr;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Country </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->cnt;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Division </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->dvn;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>District</span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->dst;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Thana </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->thn;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Address </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->adr;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p><span>Gender </span>: {{ Session::get('usrInfo')->usrgnr }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Profession </span>: {{ Session::get('usrInfo')->usrtyp }}</p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Designation </span>: 
                                    <?php
                                    if (Session::get('usrInfo')->usrrnk == '0') {
                                        echo '<span style="color:red;">Not Applicable</span>';
                                    } else {
                                        echo Session::get('usrInfo')->usrrnk;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Religion </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->rlgn;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Date of Birth </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->dob;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Mobile </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->mbl;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>Skill </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->skl;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p>
                                    <span>About Me </span>: 
                                    <?php
                                    if ($proInfo) {
                                        echo $proInfo->abt;
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <h3 class="form-signin-heading" align="center"><strong><u>School Information</u></strong></h3>
                            <div class="bio-row">
                                <p><span>School Name </span>: {{ Session::get('usrInfo')->sclnme }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>School Code </span>: <span style="color: green;">{{ Session::get('usrInfo')->sclcd }}</span></p>
                            </div>
                            <div class="bio-row">
                                <p><span>Email Address</span>: {{ Session::get('usrInfo')->scleml }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Join Date </span>: {{ Session::get('usrInfo')->jondt }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Expire Date </span>: {{ Session::get('usrInfo')->expdte }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Referrer </span>: {{ Session::get('usrInfo')->sclrfr }}</p>
                            </div>
                            <?php
                            $usrType = Session::get('usrInfo')->usrtyp;

                            if ($usrType = 'Student') {
                                $clsRolInfo = DB::table('clsrol')
                                        ->select('*')
                                        ->where('stdid', $usrId)
                                        ->first();
                            ?>
                            <div class="bio-row">
                                <p><span>Class </span>: 
                                    <?php
                                        if($clsRolInfo){
                                            if($clsRolInfo->stdcls == '6'){
                                                echo 'Six';
                                            }elseif ($clsRolInfo->stdcls == '7') {
                                                echo 'Seven';
                                            }elseif ($clsRolInfo->stdcls == '8') {
                                                echo 'Eight';
                                            }elseif ($clsRolInfo->stdcls == '9') {
                                                echo 'Nine';
                                            }elseif ($clsRolInfo->stdcls == '10') {
                                                echo 'Ten';
                                            }elseif ($clsRolInfo->stdcls == '11') {
                                                echo 'Enter 1st Year';
                                            }elseif ($clsRolInfo->stdcls == '12') {
                                                echo 'Enter 2nd Year';
                                            }
                                        }else{
                                            echo '<span style="color:red;">Not Applicable</span>';
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="bio-row">
                                <p><span>Roll </span>: 
                                    <?php
                                        if($clsRolInfo){
                                            echo $clsRolInfo->stdrol;
                                        }else{
                                            echo '<span style="color:red;">Not Applicable</span>';
                                        }
                                    ?>
                                </p>
                            </div>
                            <?php 
                            }
                            ?>
                        </div>

                        <div class="row">
                            <h3 class="form-signin-heading" align="center"><strong><u>Account Detail</u></strong></h3>
                            <div class="bio-row">
                                <p><span>Email Address </span>: {{ Session::get('usrInfo')->usreml }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Username </span>: {{ Session::get('usrInfo')->usrid }}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Join Date </span>: {{ Session::get('usrInfo')->jondte }}</p>
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