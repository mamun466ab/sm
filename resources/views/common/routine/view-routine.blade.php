@extend('dboardcontainer')

@section('title', 'View Class Routine')

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <?php
        $sclcd = Session::get('usrInfo')->sclcd;
        $clsRtn6 = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 6)->get();
        $clsRtn7 = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 7)->get();
        $clsRtn8 = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 8)->get();
        $clsRtn9 = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 9)->get();
        $clsRtn10 = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 10)->get();
        $clsRtn11 = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 11)->get();
        $clsRtn12 = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 12)->get();
        $a = $b = $c = $d = $e = $f = $g = 1;
        $color = '#099';
        ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
            <div class="modal-dialog" style="width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title"><strong>Edit Class Routine</strong></h4>
                    </div>
                    <form action="{{ url('/class-routine-update/') }}" method="POST" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12" id="edtrtn"></div>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                            <button type="submit" class="btn btn-info">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(count($clsRtn6) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Class Routine for Class Six</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn6 as $clsrotn6)
                                    <tr>
                                        <td><strong>{{$a}}.</strong></td>
                                        <td>{{$clsrotn6->clstme}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sat') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn6->sat}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sun') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn6->sun}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Mon') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn6->mon}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Tue') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn6->tue}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Wed') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn6->wed}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Thu') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn6->thu}}</td>
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn6->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-cls-rtn/') }}/'+this.value)">
                                                <span class="icon-pencil"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $a++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        @endif

        @if(count($clsRtn7) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Class Routine for Class Seven</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn7 as $clsrotn7)
                                    <tr>
                                        <td><strong>{{$b}}.</strong></td>
                                        <td>{{$clsrotn7->clstme}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sat') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn7->sat}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sun') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn7->sun}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Mon') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn7->mon}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Tue') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn7->tue}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Wed') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn7->wed}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Thu') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn7->thu}}</td>
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn7->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-cls-rtn/') }}/'+this.value)">
                                                <span class="icon-pencil"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $b++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        @endif

        @if(count($clsRtn8) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Class Routine for Class Eight</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn8 as $clsrotn8)
                                    <tr>
                                        <td><strong>{{$c}}.</strong></td>
                                        <td>{{$clsrotn8->clstme}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sat') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn8->sat}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sun') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn8->sun}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Mon') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn8->mon}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Tue') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn8->tue}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Wed') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn8->wed}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Thu') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn8->thu}}</td>
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn8->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-cls-rtn/') }}/'+this.value)">
                                                <span class="icon-pencil"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $c++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        @endif
        @if(count($clsRtn9) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Class Routine for Class Nine</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn9 as $clsrotn9)
                                    <tr>
                                        <td><strong>{{$d}}.</strong></td>
                                        <td>{{$clsrotn9->clstme}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sat') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn9->sat}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sun') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn9->sun}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Mon') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn9->mon}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Tue') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn9->tue}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Wed') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn9->wed}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Thu') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn9->thu}}</td>
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn9->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-cls-rtn/') }}/'+this.value)">
                                                <span class="icon-pencil"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $d++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        @endif
        @if(count($clsRtn10) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Class Routine for Class Ten</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn10 as $clsrotn10)
                                    <tr>
                                        <td><strong>{{$e}}.</strong></td>
                                        <td>{{$clsrotn10->clstme}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sat') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn10->sat}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sun') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn10->sun}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Mon') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn10->mon}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Tue') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn10->tue}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Wed') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn10->wed}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Thu') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn10->thu}}</td>
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn10->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-cls-rtn/') }}/'+this.value)">
                                                <span class="icon-pencil"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $e++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        @endif

        @if(count($clsRtn11) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Class Routine for Class Enter 1st Year</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn11 as $clsrotn11)
                                    <tr>
                                        <td><strong>{{$f}}.</strong></td>
                                        <td>{{$clsrotn11->clstme}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sat') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn11->sat}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sun') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn11->sun}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Mon') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn11->mon}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Tue') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn11->tue}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Wed') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn11->wed}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Thu') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn11->thu}}</td>
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn11->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-cls-rtn/') }}/'+this.value)">
                                                <span class="icon-pencil"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $f++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        @endif
        @if(count($clsRtn12) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Class Routine for Class Enter 2nd Year</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <div class="col-md-12" id="elvnrtn"></div>
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn12 as $clsrotn12)
                                    <tr>
                                        <td><strong>{{$g}}.</strong></td>
                                        <td>{{$clsrotn12->clstme}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sat') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn12->sat}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Sun') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn12->sun}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Mon') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn12->mon}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Tue') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn12->tue}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Wed') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn12->wed}}</td>
                                        <td style="color: <?php
                                        if (date('D') == 'Thu') {
                                            echo $color;
                                        }
                                        ?>;">{{$clsrotn12->thu}}</td>
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn12->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-cls-rtn/') }}/'+this.value)">
                                                <span class="icon-pencil"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $g++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        @endif
        <!-- page end-->
    </section>
</section>
<!--main content end-->

@endsection