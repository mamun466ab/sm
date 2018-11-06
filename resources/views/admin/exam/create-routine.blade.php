@extend('dboardcontainer')

@section('title', 'Exam Routine')

@section('content')
<style type="text/css">
    .panel input, .panel select{
        color: #000;
    }
</style>
<section id="main-content" style="padding-top: 15px; padding-bottom: 400px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">

                    <header class="panel-heading">
                        <strong>Create Exam Time</strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <?php
                        if (Session::get('msg') != NULL) {
                            echo '<div class="alert alert-success print-success-msg text-center">';
                            echo Session::get('msg');
                            echo '</div>';
                            Session::forget('msg');
                        }
                        $scltyp = Session::get('usrInfo')->scltyp;
                        $usrInfo = Session::get('usrInfo');
                        ?>
                        <form action="{{ url('/create-exm-routine/') }}" method="POST" role="form">
                            @csrf

                            @if($scltyp == 's')
                            <div class="form-group">
                                <label for="rtnTyp">Routine Type *</label>
                                <select name="rtnTyp" id="rtnTyp" class="form-control">
                                    <option value="" disabled="disabled">Select Classes</option>
                                    <option value="s" selected="selected">High School</option>
                                    <option value="c" disabled="disabled">Collage</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exmdte">Exam Date *</label>
                                <input name="exmdte" id="exmdte" type="text" class="form-control default-date-picker" onkeydown="return false" placeholder="Exam Date" required="required">
                            </div>
                            <?php
                            $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->where('scltyp', 's')->first();
                            $sclsub = DB::table('subject')->select('*')->orderBy('sub')->get();
                            $extsub = DB::table('extsub')->select('*')->where('sclcd', $usrInfo->sclcd)->orderBy('exsub')->get();
                            echo '<div class="form-group">
                    <label for="exmTyp">Exam Type *</label>
                    <input name="exmTyp" id="exmTyp" type="text" class="form-control" onkeydown="return false" value = "' . $exmtm->exmtyp . '">
                 </div>';
                            for ($n = 6; $n <= 10; $n++) {
                                echo '<div class="form-group col-md-4">
                      <label for = "cls' . $n . '" class="control-label" style = "color:#FF6C60;">Class</label>
                      <input type="text" name = "cls' . $n . '" id = "cls' . $n . '" value = "';
                                if ($n == 6) {
                                    echo 'Six';
                                } else if ($n == 7) {
                                    echo 'Seven';
                                } else if ($n == 8) {
                                    echo 'Eight';
                                } else if ($n == 9) {
                                    echo 'Nine';
                                } else if ($n == 10) {
                                    echo 'Ten';
                                }
                                echo '" class="form-control" onkeydown="return false;">
                      </div>

                      <div class="';
                                if ($exmtm->sndtm != 0) {
                                    echo 'form-group col-md-4';
                                } else {
                                    echo 'form-group col-md-8';
                                }
                                echo '">
                      <label for = "fstexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->fsttm . '</label>
                      <div class="form-group">
                      <select name="fstexm' . $n . '" class="form-control" id="fstexm' . $n . '" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                                echo '<optgroup label="Common Subject">';
                                foreach ($sclsub as $sclsubval) {
                                    echo '<option value="' . $sclsubval->sub . '">' . $sclsubval->sub . '</option>';
                                }
                                echo '</optgroup>';

                                echo '<optgroup label="Extra Subject">';
                                foreach ($extsub as $sclexsubval) {
                                    echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                                }
                                echo '</optgroup>';
                                echo '</select>
                      </div>
                      </div>';

                                if ($exmtm->sndtm != 0) {
                                    echo '<div class="form-group col-md-4">
                      <label for = "sndexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->sndtm . '</label>
                      <div class="form-group">
                      <select name="sndexm' . $n . '" id = "sndexm' . $n . '" class="form-control" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                                    echo '<optgroup label="Common Subject">';
                                    foreach ($sclsub as $sclsubval) {
                                        echo '<option value="' . $sclsubval->sub . '">' . $sclsubval->sub . '</option>';
                                    }
                                    echo '</optgroup>';

                                    echo '<optgroup label="Extra Subject">';
                                    foreach ($extsub as $sclexsubval) {
                                        echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                                    }
                                    echo '</optgroup>';
                                    echo '</select>
                      </div>
                      </div>';
                                }
                            }
                            ?>
                            @elseif($scltyp == 'c')
                            <div class="form-group">
                                <label for="rtnTyp">Routine Type *</label>
                                <select name="rtnTyp" id="rtnTyp" class="form-control">
                                    <option value="" disabled="disabled">Select Classes</option>
                                    <option value="s" disabled="disabled">High School</option>
                                    <option value="c" selected="selected">Collage</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exmdte">Exam Date *</label>
                                <input name="exmdte" id="exmdte" type="text" class="form-control default-date-picker" onkeydown="return false" placeholder="Exam Date" required="required">
                            </div>

                            <?php
                            $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->where('scltyp', 'c')->first();
                            $clgsub = DB::table('clgsub')->select('*')->orderBy('clgsub')->get();
                            $extsub = DB::table('extsub')->select('*')->where('sclcd', $usrInfo->sclcd)->orderBy('exsub')->get();
                            echo '<div class="form-group">
                    <label for="exmTyp">Exam Type *</label>
                    <input name="exmTyp" id="exmTyp" type="text" class="form-control" onkeydown="return false" value = "' . $exmtm->exmtyp . '">
                 </div>';
                            for ($n = 11; $n <= 12; $n++) {
                                echo '<div class="form-group col-md-4">
                      <label for = "cls' . $n . '" class="control-label" style = "color:#FF6C60;">Class</label>
                      <input type="text" name = "cls' . $n . '" id = "cls' . $n . '" value = "';
                                if ($n == 11) {
                                    echo 'Enter 1st Year';
                                } else if ($n == 12) {
                                    echo 'Enter 2nd Year';
                                }
                                echo '" class="form-control" onkeydown="return false;" placeholder="Class Number">
                      </div>

                      <div class="';
                                if ($exmtm->sndtm != 0) {
                                    echo 'form-group col-md-4';
                                } else {
                                    echo 'form-group col-md-8';
                                }
                                echo '">
                      <label for = "fstexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->fsttm . '</label>
                      <div class="form-group">
                      <select name="fstexm' . $n . '" class="form-control" id="fstexm' . $n . '" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                                echo '<optgroup label="Common Subject">';
                                foreach ($clgsub as $clgsubval) {
                                    echo '<option value="' . $clgsubval->clgsub . '">' . $clgsubval->clgsub . '</option>';
                                }
                                echo '</optgroup>';

                                echo '<optgroup label="Extra Subject">';
                                foreach ($extsub as $sclexsubval) {
                                    echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                                }
                                echo '</optgroup>';
                                echo '</select>
                      </div>
                      </div>';

                                if ($exmtm->sndtm != 0) {
                                    echo '<div class="form-group col-md-4">
                      <label for = "sndexm' . $n . '" style = "color:#FF6C60;">' . $exmtm->sndtm . '</label>
                      <div class="form-group">
                      <select name="sndexm' . $n . '" id = "sndexm' . $n . '" class="form-control" required="required">
                        <option value="">Select Subject</option>
                        <option value="Nill">Nill</option>';
                                    echo '<optgroup label="Common Subject">';
                                    foreach ($clgsub as $clgsubval) {
                                        echo '<option value="' . $clgsubval->clgsub . '">' . $clgsubval->clgsub . '</option>';
                                    }
                                    echo '</optgroup>';

                                    echo '<optgroup label="Extra Subject">';
                                    foreach ($extsub as $sclexsubval) {
                                        echo '<option value="' . $sclexsubval->exsub . '">' . $sclexsubval->exsub . '</option>';
                                    }
                                    echo '</optgroup>';
                                    echo '</select>
                      </div>
                      </div>';
                                }
                            }
                            ?>
                            @elseif($scltyp == 'b')
                            <div class="form-group">
                                <label for="rtnTyp">Routine Type *</label>
                                <select name="rtnTyp" id="rtnTyp" class="form-control" required="required" onchange="ajaxGET('exmRtn','{{ URL::to('/exm-rtn/') }}/'+this.value)">
                                    <option value="">Select Classes</option>
                                    <option value="s">High School</option>
                                    <option value="c">Collage</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exmdte">Exam Date *</label>
                                <input name="exmdte" id="exmdte" type="text" class="form-control default-date-picker" onkeydown="return false" placeholder="Exam Date" required="required">
                            </div>

                            <div id="exmRtn"></div>
                            @endif
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </section>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>View Exam Time</strong>
                    </header>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>1st Exam Time</th>
                                <th>2nd Exam Time</th>
                                <th>Exam Type</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (count($exmtmQuery) > 0):
                                foreach ($exmtmQuery as $exmtmval):
                                    ?>
                                    <tr>
                                        <td>{{ $exmtmval->fsttm }}</td>
                                        <td>
                                            @if($exmtmval->sndtm == 0)
                                            <font color="red">Nill</font>
                                            @else
                                            {{ $exmtmval->sndtm }}
                                            @endif
                                        </td>
                                        <td>{{ $exmtmval->exmtyp }}</td>
                                        @if($exmtmval->scltyp == 's')
                                        <td>School</td>
                                        @elseif($exmtmval->scltyp == 'c')
                                        <td>Collage</td>
                                        @endif
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>

                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection