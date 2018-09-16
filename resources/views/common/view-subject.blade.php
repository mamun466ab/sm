@extend('dboardcontainer')

@section('title', 'View Subject')

@section('content')

<!--main content start-->
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <select name="std_cls" id="std_cls" class="form-control" style="color: #000; padding: 6px;" onchange="ajaxGET('stdInfo','{{ URL::to('/list-student/') }}/'+this.value)">
                    <option value="">Select Your Class</option>
                    <option value="6">Class Six</option>
                    <option value="7">Class Seven</option>
                    <option value="8">Class Eight</option>
                    <option value="9">Class Nine</option>
                    <option value="10">Class Ten</option>
                    <option value="11">Enter 1st Year</option>
                    <option value="12">Enter 2nd Year</option>
                </select>
            </div>
        </div>
        <!-- page start-->
        <div class="row" style="margin-top: 15px;">
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
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Forth Subject</th>
                                        <th>Extra Subject</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    @foreach($stdSub as $val)
                                    <tr>
                                        <td>{{ $val->stdrol }}</td>
                                        <td>{{ $val->usrnme }}</td>
                                        <td>{{ $val->stdcls }}</td>
                                        <td>
                                            <?php
                                            $i = 1;
                                            $subArray = explode(',', $val->sub);
                                            foreach ($subArray as $subVal):
                                                $subName = DB::table('subject')->select('sub')->where('subcd', $subVal)->first();
                                                echo '<strong>' . $i . '.</strong> ' . $subName->sub . '&nbsp;&nbsp;&nbsp;';
                                                $i++;
                                            endforeach;
                                            ?>
                                        </td>
                                        <td>{{ $val->frthsub }}</td>
                                        <td>{{ $val->extsub }}</td>
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