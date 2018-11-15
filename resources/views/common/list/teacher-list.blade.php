@extend('dboardcontainer')

@section('title', 'Teacher List')

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
                        <strong>Teacher List</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Ser No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User ID</th>
                                        <th>Mobile No</th>
                                        <th>Join Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <?php $i = 1 ?>
                                <tbody id="stdInfo">
                                    @foreach($tcrInfo as $val)
                                    <tr>
                                        <td>{{ $i }}.</td>
                                        <td>{{ $val->usrnme }}</td>
                                        <td>{{ $val->usreml }}</td>
                                        <td>{{ $val->usrid }}</td>
                                        <td>{{ $val->usrmbl }}</td>
                                        <td>{{ $val->jondte }}</td>
                                        <td>
                                            @if($val->usrsts == 1)
                                            <span style="color: #3390FF;">Active</span>
                                            @elseif($val->usrsts == 2)
                                            <span style="color: #FF9933;">Blocked</span>
                                            @else
                                            <span style="color: #FF3633;">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
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