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
        $sclexmTme = DB::table('exmtm')->select('*')->where('sclcd', $sclcd)->where('scltyp', 's')->first();
        $clgexmTme = DB::table('exmtm')->select('*')->where('sclcd', $sclcd)->where('scltyp', 'c')->first();
        $a = $b = $c = $d = $e = $f = $g = 1;
        $color = '#099';
        ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title"><strong>Edit Class Routine</strong></h4>
                    </div>
                    <form action="{{ url('/exam-routine-update/') }}" method="POST" role="form">
                        @csrf
                        <div class="modal-body" id="edtrtn">
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
                        <strong>{{ $sclexmTme->exmtyp }} Exam Routine for Class Six</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>{{ $sclexmTme->fsttm }}</th>
                                        @if($sclexmTme->sndtm != 0)
                                        <th>{{ $sclexmTme->sndtm }}</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn6 as $clsrotn6)
                                    <tr>
                                        <td><strong>{{$a}}.</strong></td>
                                        <td>{{$clsrotn6->exmdte}}</td>
                                        <td>{{$clsrotn6->fstsub}}</td>
                                        @if($sclexmTme->sndtm != 0)
                                        <td>{{$clsrotn6->sndsub}}</td>
                                        @endif
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn6->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-exm-rtn/') }}/'+this.value)">
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
                        <strong>{{ $sclexmTme->exmtyp }} Exam Routine for Class Seven</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>{{ $sclexmTme->fsttm }}</th>
                                        @if($sclexmTme->sndtm != 0)
                                        <th>{{ $sclexmTme->sndtm }}</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn7 as $clsrotn7)
                                    <tr>
                                        <td><strong>{{$b}}.</strong></td>
                                        <td>{{$clsrotn7->exmdte}}</td>
                                        <td>{{$clsrotn7->fstsub}}</td>
                                        @if($sclexmTme->sndtm != 0)
                                        <td>{{$clsrotn7->sndsub}}</td>
                                        @endif
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn7->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-exm-rtn/') }}/'+this.value)">
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
                        <strong>{{ $sclexmTme->exmtyp }} Exam Routine for Class Eight</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>{{ $sclexmTme->fsttm }}</th>
                                        @if($sclexmTme->sndtm != 0)
                                        <th>{{ $sclexmTme->sndtm }}</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn8 as $clsrotn8)
                                    <tr>
                                        <td><strong>{{$c}}.</strong></td>
                                        <td>{{$clsrotn8->exmdte}}</td>
                                        <td>{{$clsrotn8->fstsub}}</td>
                                        @if($sclexmTme->sndtm != 0)
                                        <td>{{$clsrotn8->sndsub}}</td>
                                        @endif
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn8->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-exm-rtn/') }}/'+this.value)">
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
                        <strong>{{ $sclexmTme->exmtyp }} Exam Routine for Class Nine</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>{{ $sclexmTme->fsttm }}</th>
                                        @if($sclexmTme->sndtm != 0)
                                        <th>{{ $sclexmTme->sndtm }}</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn9 as $clsrotn9)
                                    <tr>
                                        <td><strong>{{$d}}.</strong></td>
                                        <td>{{$clsrotn9->exmdte}}</td>
                                        <td>{{$clsrotn9->fstsub}}</td>
                                        @if($sclexmTme->sndtm != 0)
                                        <td>{{$clsrotn9->sndsub}}</td>
                                        @endif<td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn9->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-exm-rtn/') }}/'+this.value)">
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
                        <strong>{{ $sclexmTme->exmtyp }} Exam Routine for Class Ten</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>{{ $sclexmTme->fsttm }}</th>
                                        @if($sclexmTme->sndtm != 0)
                                        <th>{{ $sclexmTme->sndtm }}</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn10 as $clsrotn10)
                                    <tr>
                                        <td><strong>{{$e}}.</strong></td>
                                        <td>{{$clsrotn10->exmdte}}</td>
                                        <td>{{$clsrotn10->fstsub}}</td>
                                        @if($sclexmTme->sndtm != 0)
                                        <td>{{$clsrotn10->sndsub}}</td>
                                        @endif
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn10->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-exm-rtn/') }}/'+this.value)">
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
                        <strong>{{ $clgexmTme->exmtyp }} Exam Routine for Class Enter 1st Year</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>{{ $clgexmTme->fsttm }}</th>
                                        @if($clgexmTme->sndtm != 0)
                                        <th>{{ $clgexmTme->sndtm }}</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn11 as $clsrotn11)
                                    <tr>
                                        <td><strong>{{$f}}.</strong></td>
                                        <td>{{$clsrotn11->exmdte}}</td>
                                        <td>{{$clsrotn11->fstsub}}</td>
                                        @if($clgexmTme->sndtm != 0)
                                        <td>{{$clsrotn11->sndsub}}</td>
                                        @endif
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn11->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-exm-rtn/') }}/'+this.value)">
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
                        <strong>{{ $clgexmTme->exmtyp }} Exam Routine for Class Enter 2nd Year</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Exam Date</th>
                                        <th>{{ $clgexmTme->fsttm }}</th>
                                        @if($clgexmTme->sndtm != 0)
                                        <th>{{ $clgexmTme->sndtm }}</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach ($clsRtn12 as $clsrotn12)
                                    <tr>
                                        <td><strong>{{$g}}.</strong></td>
                                        <td>{{ $clsrotn12->exmdte }}</td>
                                        <td>{{ $clsrotn12->fstsub }}</td>
                                        @if($clgexmTme->sndtm != 0)
                                        <td>{{ $clsrotn12->sndsub }}</td>
                                        @endif
                                        <td>
                                            <button data-target="#myModal-2" data-toggle="modal" class="btn btn-success btn-xs" value="{{ $clsrotn12->id }}" onclick="ajaxGET('edtrtn','{{ URL::to('/edit-exm-rtn/') }}/'+this.value)">
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