@extend('dboardcontainer')

@section('title', 'Add Number')

@section('content')
<style type="text/css">
    .panel input, .panel select, .panel select option{
        color: #000;
    }
</style>
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Add Number</strong>
                    </header>
                    <div class="panel-body">
                        <?php
                        if (Session::get('msg') != NULL) {
                            echo '<div class="alert alert-success print-success-msg text-center">';
                            echo Session::get('msg');
                            echo '</div>';
                            Session::forget('msg');
                        }
                        
                        if (Session::get('errors') != NULL) {
                            echo '<div class="alert alert-danger print-success-msg text-center">';
                            echo Session::get('errors');
                            echo '</div>';
                            Session::forget('errors');
                        }
                        ?>
                        <form action="{{ url('/insert-number/') }}" method="POST" role="form" style="padding:15px;" id="ndata_form">
                            @csrf
                            <div class="form-group">
                                <label for="stdcls" class="col-sm-3 control-label">Class</label>
                                <select name="stdcls" id="stdcls" class="form-control" onchange="ajaxGET('stdid','{{ URL::to('/student-list-option/') }}/'+this.value)" required="required">
                                    <option value="">Select Class</option>
                                    @if(Session::get('usrInfo')->scltyp == 's')
                                    <option value="6">Six</option>
                                    <option value="7">Seven</option>
                                    <option value="8">Eight</option>
                                    <option value="9">Nine</option>
                                    <option value="10">Ten</option>
                                    @elseif(Session::get('usrInfo')->scltyp == 'c')
                                    <option value="11">Enter 1st Year</option>
                                    <option value="12">Enter 2nd Year</option>
                                    @else
                                    <option value="6">Six</option>
                                    <option value="7">Seven</option>
                                    <option value="8">Eight</option>
                                    <option value="9">Nine</option>
                                    <option value="10">Ten</option>
                                    <option value="11">Enter 1st Year</option>
                                    <option value="12">Enter 2nd Year</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stdid" class="col-sm-3 control-label">Select Student</label>
                                <select name="stdid" id="stdid" class="form-control" onchange="ajaxGET('addNmbrFld','{{ URL::to('/add-number-ajax/') }}/'+this.value)" required="required">
                                    <option value="">Select Class First</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ssn" class="col-sm-3 control-label">Session *</label>
                                <select name="ssn" id="ssn" class="form-control">
                                    <option value="">Select Year</option>

                                    @for($i = 2010; $i <= (date('Y') + 1); $i++){
                                    <option <?php
                                    if (date('Y') == $i) {
                                        echo 'selected="selected"';
                                    }
                                    ?> value="{{ $i }}">{{ $i }}</option>
                                    @endfor;
                                </select>
                            </div>

                            <?php
                            $sclTyp = Session::get('usrInfo')->scltyp;
                            $sclcd = Session::get('usrInfo')->sclcd;
                            ?>

                            <div class="form-group">
                                <label for="exmTyp" class="col-sm-3 control-label">Exam Type *</label>

                                @if($sclTyp == 's')
                                <?php
                                $exmtms = DB::table('exmtm')->select('*')->where('sclcd', $sclcd)->where('scltyp', 's')->first();
                                ?>
                                <input type="text" name="exmTyp" id="exmTyp" class="form-control" value="{{ $exmtms->exmtyp }}" required="required" onkeydown="return false;" />
                                @elseif($sclTyp == 'c')
                                <?php
                                $exmtmc = DB::table('exmtm')->select('*')->where('sclcd', $sclcd)->where('scltyp', 'c')->first();
                                ?>
                                <input type="text" name="exmTyp" id="exmTyp" class="form-control" value="{{ $exmtmc->exmtyp }}" required="required" onkeydown="return false;" />
                                @elseif($sclTyp == 'b')
                                <select name="exmTyp" id="exmTyp" class="form-control" required="required">
                                    <option value="">Select Exam Type</option>
                                    <?php
                                    $exmtmb = DB::table('exmtm')->select('*')->where('sclcd', $sclcd)->get();
                                    ?>
                                    @foreach($exmtmb as $exmtmbval)
                                    <?php
                                    if ($exmtmbval->scltyp == 's') {
                                        $scltyp = 'School';
                                    } elseif ($exmtmbval->scltyp == 'c') {
                                        $scltyp = 'Collage';
                                    }
                                    ?>
                                    <option value="{{ $exmtmbval->exmtyp }}">{{ $exmtmbval->exmtyp }} ({{ $scltyp }})</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>

                            <div class="form-group">
                                <?php
                                $cmnSub = DB::table('subject')->select('*')->orderBy('sub')->get();
                                $extSub = DB::table('extsub')->select('*')->where('sclcd', $sclcd)->orderBy('exsub')->get();
                                $forthsub = DB::table('subject')->select('*')->where('sts', 4)->orderBy('sub')->get();
                                ?>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for = "fstetm" class="control-label" style="color:#FF6C60;">Subject</label>
                                    <!--<input type="text" name = "fstetm" id = "fstetm" value = "1st Exam Time" class="form-control" onkeydown="return false;">-->
                                </div>

                                <div class="form-group col-md-6">
                                    <label for = "fstetm" class="control-label" style="color:#FF6C60;">Number</label>
                                    <!--<input type="text" name = "fstetm" id = "fstetm" placeholder="33" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">-->
                                </div>
                            </div>
                            <div id="addNmbrFld"></div>

                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Subject List</strong>
                    </header>
                    <?php
                    $cmnSub = DB::table('subject')->select('*')->get();
                    $i = 1;
                    ?>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                foreach ($cmnSub as $sub):
                                    echo '<td>' . $sub->sub . '</td><td>' . $sub->subcd . '</td>';
                                    if ($i % 2 == 0):
                                        echo '</tr><tr>';
                                    endif;
                                    $i++;
                                endforeach;
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="panel">
                    <header class="panel-heading">
                        <strong>Extra Subject List</strong>
                    </header>
                    <?php
                    $sclcd = Session::get('usrInfo')->sclcd;
                    $extSub = DB::table('extsub')->select('*')->where('sclcd', $sclcd)->get();
                    $i = 1;
                    ?>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                foreach ($extSub as $exsub):
                                    echo '<td>' . $exsub->exsub . '</td><td>' . $exsub->exsubcd . '</td>';
                                    if ($i % 2 == 0):
                                        echo '</tr><tr>';
                                    endif;
                                    $i++;
                                endforeach;
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