@extend('dboardcontainer')

@section('title', 'View Exam Routine')

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <?php
        $sclcd = Session::get('usrInfo')->sclcd;
        $clsRtn6 = DB::table('exmrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 'Six')->get();
        $clsRtn7 = DB::table('exmrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 'Seven')->get();
        $clsRtn8 = DB::table('exmrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 'Eight')->get();
        $clsRtn9 = DB::table('exmrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 'Nine')->get();
        $clsRtn10 = DB::table('exmrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 'Ten')->get();
        $clsRtn11 = DB::table('exmrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 'Enter 1st Year')->get();
        $clsRtn12 = DB::table('exmrtn')->select('*')->where('sclcd', $sclcd)->where('cls', 'Enter 2nd Year')->get();
        $a = $b = $c = $d = $e = $f = $g = 1;
        $color = '#099';
        ?>
        @if(count($clsRtn6) > 0)
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Exam Routine for Class Six</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>First</th>
                                        <th>Seccond</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn6 as $clsrotn6)
                                    <tr>
                                        <td><strong>{{$a}}.</strong></td>
                                        <td>{{$clsrotn6->exmdte}}</td>
                                        <td>{{$clsrotn6->fstsub}}</td>
                                        <td>{{$clsrotn6->sndsub}}</td>
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
                                        <th>Exam Date</th>
                                        <th>First</th>
                                        <th>Seccond</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn7 as $clsrotn7)
                                    <tr>
                                        <td><strong>{{$b}}.</strong></td>
                                        <td>{{$clsrotn7->exmdte}}</td>
                                        <td>{{$clsrotn7->fstsub}}</td>
                                        <td>{{$clsrotn7->sndsub}}</td>
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
                                        <th>Exam Date</th>
                                        <th>First</th>
                                        <th>Seccond</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn8 as $clsrotn8)
                                    <tr>
                                        <td><strong>{{$c}}.</strong></td>
                                        <td>{{$clsrotn8->exmdte}}</td>
                                        <td>{{$clsrotn8->fstsub}}</td>
                                        <td>{{$clsrotn8->sndsub}}</td>
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
                                        <th>Exam Date</th>
                                        <th>First</th>
                                        <th>Seccond</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn9 as $clsrotn9)
                                    <tr>
                                        <td><strong>{{$d}}.</strong></td>
                                        <td>{{$clsrotn9->exmdte}}</td>
                                        <td>{{$clsrotn9->fstsub}}</td>
                                        <td>{{$clsrotn9->sndsub}}</td>
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
                                        <th>Exam Date</th>
                                        <th>First</th>
                                        <th>Seccond</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn10 as $clsrotn10)
                                    <tr>
                                        <td><strong>{{$e}}.</strong></td>
                                        <td>{{$clsrotn10->exmdte}}</td>
                                        <td>{{$clsrotn10->fstsub}}</td>
                                        <td>{{$clsrotn10->sndsub}}</td>
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
                                        <th>Exam Date</th>
                                        <th>First</th>
                                        <th>Seccond</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn11 as $clsrotn11)
                                    <tr>
                                        <td><strong>{{$f}}.</strong></td>
                                        <td>{{$clsrotn11->exmdte}}</td>
                                        <td>{{$clsrotn11->fstsub}}</td>
                                        <td>{{$clsrotn11->sndsub}}</td>
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
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>First</th>
                                        <th>Seccond</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn12 as $clsrotn12)
                                    <tr>
                                        <td><strong>{{$g}}.</strong></td>
                                        <td>{{$clsrotn12->exmdte}}</td>
                                        <td>{{$clsrotn12->fstsub}}</td>
                                        <td>{{$clsrotn12->sndsub}}</td>
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