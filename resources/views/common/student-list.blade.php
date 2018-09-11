@extend('dboardcontainer')

@section('title', 'Student List')

@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
            <select name="std_cls" id="std_cls" class="form-control" style="width: 30%; color: #000; padding: 6px;" onchange="ajaxGET('stdInfo','{{ URL::to('/list-student/') }}/'+this.value)">
                <option value="">Select Your Class</option>
                <option value="6">Class Six</option>
                <option value="7">Class Seven</option>
                <option value="8">Class Eight</option>
                <option value="9">Class Nine</option>
                <option value="10">Class Ten</option>
                <option value="11">Enter 1st Year</option>
                <option value="12">Enter 2nd Year</option>
            </select>
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="text-align: center;">
                            <span style="font-size: 33px; font-weight: bold;">{{ $sclInfo->sclnme }}</span><br />
                            <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->scladr }}</span><br />
                            <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->thn }}, {{ $sclInfo->dst }}</span><br />
                        </p>
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
                                <tbody id="stdInfo">
                                    @foreach($stdInfo as $val)
                                    <tr>
                                        <td>{{ $val->stdrol }}</td>
                                        <td>{{ $val->usrnme }}</td>
                                        <td>
                                            @if($val->stdcls == 6)
                                            Six
                                            @elseif($val->stdcls == 7)
                                            Seven
                                            @elseif($val->stdcls == 8)
                                            Eight
                                            @elseif($val->stdcls == 9)
                                            Nine
                                            @elseif($val->stdcls == 10)
                                            Ten
                                            @elseif($val->stdcls == 11)
                                            Enter 1st Year
                                            @elseif($val->stdcls == 12)
                                            Enter 2nd Year
                                            @endif
                                        </td>
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

@section('jqueryfile')
<script src="{{ asset('wbdlibs/ajax/ajax.js') }}"></script>
@endsection