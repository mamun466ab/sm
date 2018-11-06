@extend('dboardcontainer')

@section('title', 'Exam Time')

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
                        <strong>Add Exam Time</strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <?php
                        $sclTyp = Session::get('usrInfo')->scltyp;
                        if (Session::get('msg') != NULL) {
                            echo '<div class="alert alert-success print-success-msg text-center">';
                            echo Session::get('msg');
                            echo '</div>';
                            Session::forget('msg');
                        }
                        ?>
                        <form action="{{ url('/exam-time/') }}" method="POST" role="form">
                            @csrf

                            @if($sclTyp != 'b')
                            <input type="hidden" name="scltyp" value="{{ $sclTyp }}" />
                            <div class="form-group">
                                <label for="exmTyp">Exam Type *</label>
                                <select name="exmTyp" id="exmTyp" class="form-control" required="required">
                                    <option value="">Select Exam Type</option>
                                    @if($sclTyp == 's')
                                    <option value="1st Term">1st Term</option>
                                    <option value="2nd Term">2nd Term</option>
                                    <option value="3rd Term">3rd Term</option>
                                    <option value="Final">Final</option>
                                    <option value="Test">Test</option>
                                    @else
                                    <option value="Half Yearly">Half Yearly</option>
                                    <option value="Yearly">Yearly</option>
                                    <option value="Pre Test">Pre Test</option>
                                    <option value="Test">Test</option>
                                    @endif
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for = "fstetm" class="control-label">Exam Time</label>
                                    <input type="text" name = "fstetm" id = "fstetm" value = "1st Exam Time" class="form-control" onkeydown="return false;">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "fstetmfrom" class="control-label">Start Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "fstetmfrom" id = "fstetmfrom" class = "form-control timepicker-default" placeholder="10:00 AM" onkeydown="return false" required="required">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "fstetmto" class="control-label">End Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "fstetmto" id = "fstetmto" class="form-control timepicker-default" placeholder="01:00 PM" onkeydown="return false" required="required">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for = "sndetm" class="control-label">Exam Time</label>
                                    <input type="text" name = "sndetm" id = "sndetm" value = "2nd Exam Time" class="form-control" onkeydown="return false;">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "sndetmfrom" class="control-label">Start Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "sndetmfrom" id = "sndetmfrom" class = "form-control timepicker-default" placeholder="02:00 PM" onkeydown="return false">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "sndetmto" class="control-label">End Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "sndetmto" id = "sndetmto" class="form-control timepicker-default" placeholder="05:00 PM" onkeydown="return false">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="scltyp">Routine Type *</label>
                                <select name="scltyp" id="scltyp" class="form-control" required="required" onchange="ajaxGET('examtime','{{ URL::to('/exm-time-ajax/') }}/'+this.value)">
                                    <option value="">Select Routine Type</option>
                                    <option value="s">High School</option>
                                    <option value="c">Collage</option>
                                </select>
                            </div>
                            
                            <div id="examtime"></div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for = "fstetm" class="control-label">Exam Time</label>
                                    <input type="text" name = "fstetm" id = "fstetm" value = "1st Exam Time" class="form-control" onkeydown="return false;">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "fstetmfrom" class="control-label">Start Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "fstetmfrom" id = "fstetmfrom" class = "form-control timepicker-default" placeholder="10:00 AM" onkeydown="return false" required="required">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "fstetmto" class="control-label">End Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "fstetmto" id = "fstetmto" class="form-control timepicker-default" placeholder="01:00 PM" onkeydown="return false" required="required">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for = "sndetm" class="control-label">Exam Time</label>
                                    <input type="text" name = "sndetm" id = "sndetm" value = "2nd Exam Time" class="form-control" onkeydown="return false;">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "sndetmfrom" class="control-label">Start Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "sndetmfrom" id = "sndetmfrom" class = "form-control timepicker-default" placeholder="02:00 PM" onkeydown="return false">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for = "sndetmto" class="control-label">End Time</label>
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" name = "sndetmto" id = "sndetmto" class="form-control timepicker-default" placeholder="05:00 PM" onkeydown="return false">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
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
                            if (count($exmtm) > 0):
                                foreach ($exmtm as $exmtmval):
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