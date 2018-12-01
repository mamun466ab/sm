@extend('dboardcontainer')

@section('title', 'Block and Unblock')

@section('content')
<!--main content start-->
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <!--            <div class="col-lg-3 col-md-6 col-sm-12">
                            <select name="std_cls" id="std_cls" class="form-control" style="color: #000; padding: 6px;" onchange="ajaxGET('stdInfo','{{ URL::to('/unbolock-block/') }}/'+this.value)">
                                <option value="">Select Your Class</option>
                                <option value="6">Class Six</option>
                                <option value="7">Class Seven</option>
                                <option value="8">Class Eight</option>
                                <option value="9">Class Nine</option>
                                <option value="10">Class Ten</option>
                                <option value="11">Enter 1st Year</option>
                                <option value="12">Enter 2nd Year</option>
                            </select>
                        </div>-->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <input type="text" id="std_cls" class="form-control" style="color: #000; padding: 6px;" onkeyup="ajaxGET('stdInfo','{{ URL::to('/unbolock-block/') }}/'+this.value)" placeholder="Type Name/Emil/Username/Mobile No" />
            </div>
        </div>
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
                        <strong>Block/Unblock (Student)</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th>Mobile No</th>
                                        <th>Join Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="stdInfo">
                                    @foreach($blkInfo as $tcrVal)
                                    <tr>
                                        <td>{{ $tcrVal->usrnme }}</td>
                                        <td>{{ $tcrVal->usreml }}</td>
                                        <td>{{ $tcrVal->usrid }}</td>
                                        <td>{{ $tcrVal->usrtyp }}</td>
                                        <td>{{ $tcrVal->usrmbl }}</td>
                                        <td>{{ $tcrVal->jondte }}</td>
                                        <td><a class="btn btn-success btn-sm" href="{{ url('/unblock/' . $tcrVal->id) }}">Unblock</a></td>
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