@extend('dboardcontainer')

@section('title', 'Student List')

@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Student List
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th class="numeric">Roll No</th>
                                        <th class="numeric">Name</th>
                                        <th class="numeric">Class</th>
                                        <th class="numeric">Email Addres</th>
                                        <th class="numeric">Mobile No</th>
                                        <th class="numeric">Join Date</th>
                                        <th class="numeric">Remarks</th>
                                    </tr>
                                </thead>
                                <?php
                                $sclCde = Session::get('usrInfo')->sclcd;
                                $stdInfo = DB::table('clsrol')
                                        ->join('usrreg', 'clsrol.stdid', '=', 'usrreg.id')
                                        ->select('clsrol.*', 'usrreg.usrnme', 'usrreg.usreml', 'usrreg.usrid', 'usrreg.usrmbl', 'usrreg.jondte')
                                        ->where('clsrol.sclcd', $sclCde)
                                        ->orderBy('clsrol.stdcls')
                                        ->orderBy('clsrol.stdrol')
                                        ->get();
                                ?>
                                <tbody>
                                    @foreach($stdInfo as $val)
                                    <tr>
                                        <td>{{ $val->stdrol }}</td>
                                        <td>{{ $val->usrnme }}</td>
                                        <td>{{ $val->stdcls }}</td>
                                        <td>{{ $val->usreml }}</td>
                                        <td>{{ $val->usrmbl }}</td>
                                        <td>{{ $val->jondte }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
@endsection