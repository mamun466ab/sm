@extend('dboardcontainer')

@section('title', 'View Class Routine')

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <?php
        $sclcd = Session::get('usrInfo')->sclcd;
        $clsRtn = DB::table('clsrtn')->select('*')->where('sclcd', $sclcd)->get();
        ?>
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
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    <?php
                                    foreach ($clsRtn as $clsrotn):
                                        if ($clsrotn->cls == 6) {
                                            ?>
                                            <tr>
                                                <td>{{$clsrotn->clstme}}</td>
                                                <td>{{$clsrotn->sat}}</td>
                                                <td>{{$clsrotn->sun}}</td>
                                                <td>{{$clsrotn->mon}}</td>
                                                <td>{{$clsrotn->tue}}</td>
                                                <td>{{$clsrotn->wed}}</td>
                                                <td>{{$clsrotn->thu}}</td>
                                            </tr>
                                            <?php
                                        }
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        
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
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    <?php
                                    foreach ($clsRtn as $clsrotn):
                                        if ($clsrotn->cls == 7) {
                                            ?>
                                            <tr>
                                                <td>{{$clsrotn->clstme}}</td>
                                                <td>{{$clsrotn->sat}}</td>
                                                <td>{{$clsrotn->sun}}</td>
                                                <td>{{$clsrotn->mon}}</td>
                                                <td>{{$clsrotn->tue}}</td>
                                                <td>{{$clsrotn->wed}}</td>
                                                <td>{{$clsrotn->thu}}</td>
                                            </tr>
                                            <?php
                                        }
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        
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
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    <?php
                                    foreach ($clsRtn as $clsrotn):
                                        if ($clsrotn->cls == 8) {
                                            ?>
                                            <tr>
                                                <td>{{$clsrotn->clstme}}</td>
                                                <td>{{$clsrotn->sat}}</td>
                                                <td>{{$clsrotn->sun}}</td>
                                                <td>{{$clsrotn->mon}}</td>
                                                <td>{{$clsrotn->tue}}</td>
                                                <td>{{$clsrotn->wed}}</td>
                                                <td>{{$clsrotn->thu}}</td>
                                            </tr>
                                            <?php
                                        }
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        
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
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    <?php
                                    foreach ($clsRtn as $clsrotn):
                                        if ($clsrotn->cls == 9) {
                                            ?>
                                            <tr>
                                                <td>{{$clsrotn->clstme}}</td>
                                                <td>{{$clsrotn->sat}}</td>
                                                <td>{{$clsrotn->sun}}</td>
                                                <td>{{$clsrotn->mon}}</td>
                                                <td>{{$clsrotn->tue}}</td>
                                                <td>{{$clsrotn->wed}}</td>
                                                <td>{{$clsrotn->thu}}</td>
                                            </tr>
                                            <?php
                                        }
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        
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
                                        <th>Class Time</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                    </tr>
                                </thead>

                                <tbody id="stdInfo">
                                    <?php
                                    foreach ($clsRtn as $clsrotn):
                                        if ($clsrotn->cls == 10) {
                                            ?>
                                            <tr>
                                                <td>{{$clsrotn->clstme}}</td>
                                                <td>{{$clsrotn->sat}}</td>
                                                <td>{{$clsrotn->sun}}</td>
                                                <td>{{$clsrotn->mon}}</td>
                                                <td>{{$clsrotn->tue}}</td>
                                                <td>{{$clsrotn->wed}}</td>
                                                <td>{{$clsrotn->thu}}</td>
                                            </tr>
                                            <?php
                                        }
                                    endforeach;
                                    ?>
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