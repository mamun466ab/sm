@extend('dboardcontainer')

@section('title', 'User Activation')

@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="text-align: center;">
                            <span style="font-size: 33px; font-weight: bold;">{{ $sclInfo->sclnme }}</span><br />
                            <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->scladr }}</span><br />
                            <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->thn }}, {{ $sclInfo->dst }}</span><br />
                        </p>
                        <strong>Inactive Teacher List</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User ID</th>
                                        <th>Mobile No</th>
                                        <th>Join Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="stdInfo">
                                    @foreach($stdInfo as $val)
                                    @if($val->usrtyp == 'Teacher')
                                    <tr>
                                        <td>{{ $val->usrnme }}</td>
                                        <td>{{ $val->usreml }}</td>
                                        <td>{{ $val->usrid }}</td>
                                        <td>{{ $val->usrmbl }}</td>
                                        <td>{{ $val->jondte }}</td>
                                        <td><a class="btn btn-success btn-sm" href="{{url('user-activate/' . $val->id) }}">Active</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        <!-- page start-->
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Inactive Student List</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User ID</th>
                                        <th>Mobile No</th>
                                        <th>Join Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="stdInfo">
                                    @foreach($stdInfo as $val)
                                    @if($val->usrtyp == 'Student')
                                    <tr>
                                        <td>{{ $val->usrnme }}</td>
                                        <td>{{ $val->usreml }}</td>
                                        <td>{{ $val->usrid }}</td>
                                        <td>{{ $val->usrmbl }}</td>
                                        <td>{{ $val->jondte }}</td>
                                        <td><a class="btn btn-success btn-sm" href="{{url('user-activate/' . $val->id) }}">Active</a></td>
                                    </tr>
                                    @endif
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