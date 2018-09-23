@extend('dboardcontainer')

@section('title', 'View Subject')

@section('content')

<!--main content start-->
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <select name="std_cls" id="std_cls" class="form-control" style="color: #000; padding: 6px;" onchange="ajaxGET('stdInfo','{{ URL::to('/subject-view/') }}/'+this.value)">
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
                                        <td>
                                            <?php
                                            if ($val->stdcls == 6):
                                                echo 'Six';
                                            elseif ($val->stdcls == 7):
                                                echo 'Seven';
                                            elseif ($val->stdcls == 8):
                                                echo 'Eight';
                                            elseif ($val->stdcls == 9):
                                                echo 'Nine';
                                            elseif ($val->stdcls == 10):
                                                echo 'Ten';
                                            elseif ($val->stdcls == 11):
                                                echo 'Enter 1st Year';
                                            elseif ($val->stdcls == 12):
                                                echo 'Enter 2nd Year';
                                            endif;
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <?php
                                            $i = 1;
                                            $subArray = explode(',', $val->sub);
                                            foreach ($subArray as $subVal):
                                                $subName = DB::table('subject')->select('sub')->where('subcd', $subVal)->first();
                                                echo '<strong>' . $i . '.</strong> ' . $subName->sub . '&nbsp;&nbsp;&nbsp;';
                                                if ($i % 5 == 0) {
                                                    echo '<br />';
                                                }
                                                $i++;
                                            endforeach;
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($val->frthsub) {
                                                $i = 1;
                                                $frthSubArray = explode(',', $val->frthsub);
                                                foreach ($frthSubArray as $frthSsubVal):
                                                    $subName = DB::table('subject')->select('sub')->where('subcd', $frthSsubVal)->first();
                                                    echo '<strong>' . $i . '.</strong> ' . $subName->sub . '&nbsp;&nbsp;&nbsp;';
                                                    $i++;
                                                endforeach;
                                            } else {
                                                echo '<font color="red">Nill</font>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($val->extsub) {
                                                $i = 1;
                                                $exsubArray = explode(',', $val->extsub);
                                                foreach ($exsubArray as $exsubVal):
                                                    $exsubName = DB::table('extsub')->select('exsub')->where('exsubcd', $exsubVal)->first();
                                                    echo '<strong>' . $i . '.</strong> ' . $exsubName->exsub . '&nbsp;&nbsp;&nbsp;';
                                                    $i++;
                                                endforeach;
                                            } else {
                                                echo '<font color="red">Nill</font>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <!--<a href="{{ url('/change-subject/') . '/' . $val->stdid }}">Change</a>-->
                                        </td>
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