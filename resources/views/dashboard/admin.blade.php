@extend('dboardcontainer')

@section('title', 'Admin - WBDSchools')

@section('content')
<!--main content start-->
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <!--state overview start-->
        <div class="row state-overview">
            <a href="{{ url('/user-activation/') }}">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="icon-user" style="color: #E28964;"></i>
                        </div>
                        <div class="value">
                            <div id="cont" class="hidden">
                                <?php
                                $schoolCode = Session::get('usrInfo')->sclcd;
                                echo $totalNewUsr = DB::table('usrreg')
                                ->whereRaw("(sclcd = '$schoolCode' AND usrsts = 0)")
                                ->count();
                                ?>
                            </div>
                            <h1 class="count">
                                0
                            </h1>
                            <p>Inactive Users</p>
                        </div>
                    </section>
                </div>
            </a>

            <a href="{{ url('/block-unblock/') }}">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol red">
                            <i class="icon-user"></i>
                        </div>
                        <div class="value">
                            <div id="cont2" class="hidden">
                                <?php
                                $schoolCode = Session::get('usrInfo')->sclcd;
                                echo $totalNewUsr = DB::table('usrreg')
                                ->whereRaw("(sclcd = '$schoolCode' AND usrsts = 2)")
                                ->count();
                                ?>
                            </div>
                            <h1 class=" count2">
                                0
                            </h1>
                            <p>Blocked Users</p>
                        </div>
                    </section>
                </div>
            </a>

            <a href="{{ url('/teacher-list/') }}">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="icon-plus-sign-alt"></i>
                        </div>
                        <div class="value">
                            <div id="cont3" class="hidden">
                                <?php
                                $schoolCode = Session::get('usrInfo')->sclcd;
                                echo $totalNewUsr = DB::table('usrreg')->whereRaw("(sclcd = '$schoolCode' AND usrtyp = 'Teacher')")->count();
                                ?>
                            </div>
                            <h1 class=" count3">
                                0
                            </h1>
                            <p>Total Teacher</p>
                        </div>
                    </section>
                </div>
            </a>
            
            <a href="{{ url('/student-list/') }}">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="icon-plus-sign-alt"></i>
                        </div>
                        <div class="value">
                            <div id="cont4" class="hidden">
                                <?php
                                $schoolCode = Session::get('usrInfo')->sclcd;
                                echo $totalNewUsr = DB::table('usrreg')
                                ->whereRaw("(sclcd = '$schoolCode' AND usrtyp = 'Student')")
                                ->count();
                                ?>
                            </div>
                            <h1 class=" count4">
                                0
                            </h1>
                            <p>Total Student</p>
                        </div>
                    </section>
                </div>
            </a>
        </div>
        <!--state overview end-->
        <?php
        $tcrList = DB::table('usrreg')
                ->select('*')
                ->whereRaw("(sclcd = '$schoolCode' AND usrtyp = 'Teacher')")
                ->get();
        ?>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Teacher's List
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>User Name</th>
                                        <th>Mobile No</th>
                                        <th>Rank</th>
                                        <th>Join Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($tcrList as $val) {
                                        ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $val->usrnme }}</td>
                                            <td>{{ $val->usreml }}</td>
                                            <td>{{ $val->usrid }}</td>
                                            <td>{{ $val->usrmbl }}</td>
                                            <td>{{ $val->usrrnk }}</td>
                                            <td>{{ $val->jondte }}</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>

        <?php
        $stdList = DB::table('clsrol')
                ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
                ->whereRaw("(clsrol.sclcd = '$schoolCode' AND clsrol.stdrol = 1)")
                ->orderBy('clsrol.stdcls')
                ->get();
        ?>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        List of First Boy/Girl
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>User Name</th>
                                        <th>Mobile No</th>
                                        <th>Class</th>
                                        <th>Join Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($stdList as $val) {
                                        ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $val->usrnme }}</td>
                                            <td>{{ $val->usreml }}</td>
                                            <td>{{ $val->usrid }}</td>
                                            <td>{{ $val->usrmbl }}</td>
                                            <td>
                                                <?php
                                                if ($val) {
                                                    if ($val->stdcls == '6') {
                                                        echo 'Six';
                                                    } elseif ($val->stdcls == '7') {
                                                        echo 'Seven';
                                                    } elseif ($val->stdcls == '8') {
                                                        echo 'Eight';
                                                    } elseif ($val->stdcls == '9') {
                                                        echo 'Nine';
                                                    } elseif ($val->stdcls == '10') {
                                                        echo 'Ten';
                                                    } elseif ($val->stdcls == '11') {
                                                        echo 'Enter 1st Year';
                                                    } elseif ($val->stdcls == '12') {
                                                        echo 'Enter 2nd Year';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>{{ $val->jondte }}</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
@endsection