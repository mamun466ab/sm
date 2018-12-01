@extend('dboardcontainer')

@section('title', 'Create Routine')

@section('content')
<style type="text/css">
    .panel input{
        color: #000;
    }
    .width14{
        margin-left: 1%;
        width: 13%;
        float: left;
    }
</style>
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Create Routine</strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <form action="routine-create" method="POST" role="form">
                            @csrf

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cls">Class *</label>
                                        <select name="cls" id="cls" class="form-control" style="color: #000;" required="required">
                                            <option value="">Select Class</option>
                                            <option value="6">Six</option>
                                            <option value="7">Seven</option>
                                            <option value="8">Eight</option>
                                            <option value="9">Nine</option>
                                            <option value="10">Ten</option>
                                            <option value="11">Enter 1st Year</option>
                                            <option value="12">Enter 2nd Year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $sclcd = Session::get('usrInfo')->sclcd;
                            $clstme = DB::table('clstme')->select('*')->where('sclcd', $sclcd)->get();
                            $subject = DB::table('subject')->select('*')->orderBy('sub')->get();
                            $extSub = DB::table('extsub')->select('*')->where('sclcd', $sclcd)->orderBy('exsub')->get();
                            $i = 1;
                            ?>

                            <input type="hidden" name="ttlcls" value="{{ count($clstme) }}">
                            <div class="row" style="margin-bottom:15px; color: rgb(121, 121, 121); font-weight: bold; text-align: center;">
                                <div class="col-sm-12">
                                    <div class="width14">Class Time</div>
                                    <div class="width14">Saturday</div>
                                    <div class="width14">Sunday</div>
                                    <div class="width14">Monday</div>
                                    <div class="width14">Tuesday</div>
                                    <div class="width14">Wednesday</div>
                                    <div class="width14">Thursday</div>
                                </div>
                            </div>

                            <?php
                            if (count($clstme) > 0):
                                foreach ($clstme as $clsTm):
                                    ?>
                                    <div class = "row" style="margin-bottom:15px;">
                                        <div cl                                    ass = "form-group">
                                            <div class = "width14">
                                                <input type = "text" name = "clstme{{$i}}" class = "form-control" id = "clstme{{$i}}" readonly="readonly" value = "{{$clsTm->clstme}}">
                                            </div>
                                            <div class = "width14">
                                                <select name="sat{{$i}}" class="form-control" id="sat{{$i}}" required="required" style="color:#000;">
                                                    <option value="">Subject</option>
                                                    <option value="Tiffin Time">Tiffin Time</option>
                                                    <optgroup label="Common Subject">
                                                        @foreach($subject as $cmnSub)
                                                        <option value="{{$cmnSub->sub}}">{{$cmnSub->sub}}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Extra Subject">
                                                        @foreach($extSub as $exSub)
                                                        <option value="{{$exSub->exsub}}">{{$exSub->exsub}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class = "width14">
                                                <select name="sun{{$i}}" class="form-control" id="sun{{$i}}" required="required" style="color:#000;">
                                                    <option value="">Subject</option>
                                                    <option value="Tiffin Time">Tiffin Time</option>
                                                    <optgroup label="Common Subject">
                                                        @foreach($subject as $cmnSub)
                                                        <option value="{{$cmnSub->sub}}">{{$cmnSub->sub}}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Extra Subject">
                                                        @foreach($extSub as $exSub)
                                                        <option value="{{$exSub->exsub}}">{{$exSub->exsub}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class = "width14">
                                                <select name="mon{{$i}}" class="form-control" id="mon{{$i}}" required="required" style="color:#000;">
                                                    <option value="">Subject</option>
                                                    <option value="Tiffin Time">Tiffin Time</option>
                                                    <optgroup label="Common Subject">
                                                        @foreach($subject as $cmnSub)
                                                        <option value="{{$cmnSub->sub}}">{{$cmnSub->sub}}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Extra Subject">
                                                        @foreach($extSub as $exSub)
                                                        <option value="{{$exSub->exsub}}">{{$exSub->exsub}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class = "width14">
                                                <select name="tue{{$i}}" class="form-control" id="tue{{$i}}" required="required" style="color:#000;">
                                                    <option value="">Subject</option>
                                                    <option value="Tiffin Time">Tiffin Time</option>
                                                    <optgroup label="Common Subject">
                                                        @foreach($subject as $cmnSub)
                                                        <option value="{{$cmnSub->sub}}">{{$cmnSub->sub}}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Extra Subject">
                                                        @foreach($extSub as $exSub)
                                                        <option value="{{$exSub->exsub}}">{{$exSub->exsub}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class = "width14">
                                                <select name="wed{{$i}}" class="form-control" id="wed{{$i}}" required="required" style="color:#000;">
                                                    <option value="">Subject</option>
                                                    <option value="Tiffin Time">Tiffin Time</option>
                                                    <optgroup label="Common Subject">
                                                        @foreach($subject as $cmnSub)
                                                        <option value="{{$cmnSub->sub}}">{{$cmnSub->sub}}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Extra Subject">
                                                        @foreach($extSub as $exSub)
                                                        <option value="{{$exSub->exsub}}">{{$exSub->exsub}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class = "width14">
                                                <select name="thu{{$i}}" class="form-control" id="thu{{$i}}" required="required" style="color:#000;">
                                                    <option value="">Subject</option>
                                                    <option value="Tiffin Time">Tiffin Time</option>
                                                    <optgroup label="Common Subject">
                                                        @foreach($subject as $cmnSub)
                                                        <option value="{{$cmnSub->sub}}">{{$cmnSub->sub}}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Extra Subject">
                                                        @foreach($extSub as $exSub)
                                                        <option value="{{$exSub->exsub}}">{{$exSub->exsub}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                endforeach;
                            else:
                                ?>
                            <div class="row" style="color:red; text-align: center;">
                                <div class="col-sm-12">
                                    Please first set the class time.
                                </div>
                            </div>
                            <?php
                            endif;
                            ?>
                            <div id="classTime" style="margin-bottom:15px;">

                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>View Class Time</strong>
                    </header>
                    <?php
                    $sclcd = Session::get('usrInfo')->sclcd;
                    $clsTme = DB::table('clstme')->select('*')->where('sclcd', $sclcd)->orderBy('clsnum')->get();
                    $i = 1;
                    ?>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Time</th>
                                <th>Class</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                if (count($clsTme) > 0):
                                    foreach ($clsTme as $time):
                                        echo '<td>No - ' . $time->clsnum . ' Class</td><td>' . $time->clstme . '</td>';
                                        if ($i % 2 == 0):
                                            echo '</tr><tr>';
                                        endif;
                                        $i++;
                                    endforeach;
                                else:
                                    echo '<td colspan="4" align="center">';
                                    echo 'No Time Found.';
                                    echo '</td>';
                                endif;
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>View Class Time</strong>
                    </header>
                    <?php
                    $sclcd = Session::get('usrInfo')->sclcd;
                    $clsTme = DB::table('clstme')->select('*')->where('sclcd', $sclcd)->orderBy('clsnum')->get();
                    $i = 1;
                    ?>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Time</th>
                                <th>Class</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                if (count($clsTme) > 0):
                                    foreach ($clsTme as $time):
                                        echo '<td>No - ' . $time->clsnum . ' Class</td><td>' . $time->clstme . '</td>';
                                        if ($i % 2 == 0):
                                            echo '</tr><tr>';
                                        endif;
                                        $i++;
                                    endforeach;
                                else:
                                    echo '<td colspan="4" align="center">';
                                    echo 'No Time Found.';
                                    echo '</td>';
                                endif;
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection