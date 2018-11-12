@extend('dboardcontainer')

@section('title', 'Exam Routine')

@section('content')
<style type="text/css">
    .panel input, .panel select{
        color: #000;
    }
    
    .panel .btn-default{
        color: #000;
        background-color: #fff;
    }
    
    .panel .btn{
        text-align: left;
        padding-left: 12px;
        padding-right: 12px;
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

                        $usrInfo = Session::get('usrInfo');
                        ?>

                        @if($scltyp == 's')
                        <form action="{{ url('/create-exm-routine/') }}" method="POST" role="form">
                            @csrf
                            <input type="hidden" name="rtnTyp" value="{{ $scltyp }}" />

                            <div class="form-group">
                                <label for="exmdte">Exam Date *</label>
                                <input name="exmdte" id="exmdte" type="text" class="form-control default-date-picker" onkeydown="return false" placeholder="Exam Date" required="required">
                            </div>
                            <?php
                            $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->where('scltyp', 's')->first();
                            $sclsub = DB::table('subject')->select('*')->orderBy('sub')->get();
                            $extsub = DB::table('extsub')->select('*')->where('sclcd', $usrInfo->sclcd)->orderBy('exsub')->get();
                            ?>
                            <div class="form-group">
                                <label for="exmTyp">Exam Type *</label>
                                <input name="exmTyp" id="exmTyp" type="text" class="form-control" onkeydown="return false" value = "{{ $exmtm->exmtyp }}">
                            </div>
                            <?php
                            for ($n = 6; $n <= 10; $n++) {
                                ?>
                                <div class="form-group col-md-4">
                                    <label for = "cls{{ $n }}" class="control-label" style = "color:#FF6C60;">Class</label>
                                    <input type="text" name = "cls{{ $n }}" id = "cls{{ $n }}" value = "<?php
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
                                    ?>" class="form-control" onkeydown="return false;">
                                </div>

                                <div class="<?php
                                if ($exmtm->sndtm != 0) {
                                    echo 'form-group col-md-4';
                                } else {
                                    echo 'form-group col-md-8';
                                }
                                ?>">
                                    <label for = "fstexm{{ $n }}" style = "color:#FF6C60;">{{ $exmtm->fsttm }}</label>
                                    <!--<div class="form-group">-->
                                        <select name="fstexm{{ $n }}[]" class="multiselect-ui form-control" id="fstexm{{ $n }}" required="required" multiple="multiple">
                                            <option value="">Select Subject</option>
                                            <option value="Nill">Nill</option>
                                            <optgroup label="Common Subject">
                                                @foreach ($sclsub as $sclsubval) 
                                                <option value="{{ $sclsubval->sub }}">{{ $sclsubval->sub }}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Extra Subject">
                                                @foreach ($extsub as $sclexsubval) 
                                                <option value="{{ $sclexsubval->exsub }}">{{ $sclexsubval->exsub }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    <!--</div>-->
                                </div>

                                @if ($exmtm->sndtm != 0) 
                                <div class="form-group col-md-4">
                                    <label for = "sndexm{{ $n }}" style = "color:#FF6C60;">{{ $exmtm->sndtm }}</label>
                                    <!--<div class="form-group">-->
                                        <select name="sndexm{{ $n }}[]" id = "sndexm{{ $n }}" class="multiselect-ui form-control" required="required" multiple="multiple">
                                            <option value="">Select Subject</option>
                                            <option value="Nill">Nill</option>
                                            <optgroup label="Common Subject">
                                                @foreach ($sclsub as $sclsubval) 
                                                <option value="{{ $sclsubval->sub }}">{{ $sclsubval->sub }}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Extra Subject">
                                                @foreach ($extsub as $sclexsubval) 
                                                <option value="{{ $sclexsubval->exsub }}">{{ $sclexsubval->exsub }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    <!--</div>-->
                                </div>                                                
                                @endif

                                <?php
                            }
                            ?>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                        @elseif($scltyp == 'c')
                        <form action="{{ url('/create-exm-routine/') }}" method="POST" role="form">
                            @csrf
                            <input type="hidden" name="rtnTyp" value="{{ $scltyp }}" />
                            <div class="form-group">
                                <label for="exmdte">Exam Date *</label>
                                <input name="exmdte" id="exmdte" type="text" class="form-control default-date-picker" onkeydown="return false" placeholder="Exam Date" required="required">
                            </div>

                            <?php
                            $exmtm = DB::table('exmtm')->select('*')->where('sclcd', $usrInfo->sclcd)->where('scltyp', 'c')->first();
                            $clgsub = DB::table('clgsub')->select('*')->orderBy('clgsub')->get();
                            $extsub = DB::table('extsub')->select('*')->where('sclcd', $usrInfo->sclcd)->orderBy('exsub')->get();
                            ?>
                            <div class="form-group">
                                <label for="exmTyp">Exam Type *</label>
                                <input name="exmTyp" id="exmTyp" type="text" class="form-control" onkeydown="return false" value = "{{ $exmtm->exmtyp }}">
                            </div>
                            <?php
                            for ($n = 11; $n <= 12; $n++) {
                                ?>
                                <div class="form-group col-md-4">
                                    <label for = "cls{{ $n }}" class="control-label" style = "color:#FF6C60;">Class</label>
                                    <input type="text" name = "cls{{ $n }}" id = "cls{{ $n }}" value = "<?php
                                    if ($n == 11) {
                                        echo 'Enter 1st Year';
                                    } else if ($n == 12) {
                                        echo 'Enter 2nd Year';
                                    }
                                    ?>" class="form-control" onkeydown="return false;" placeholder="Class Number">
                                </div>

                                <div class="<?php
                                if ($exmtm->sndtm != 0) {
                                    echo 'form-group col-md-4';
                                } else {
                                    echo 'form-group col-md-8';
                                }
                                ?>">
                                    <label for = "fstexm{{ $n }}" style = "color:#FF6C60;">{{ $exmtm->fsttm }}</label>
                                    <!--<div class="form-group">-->
                                        <select name="fstexm{{ $n }}[]" class="multiselect-ui form-control" id="fstexm{{ $n }}" required="required" multiple="multiple">
                                            <option value="">Select Subject</option>
                                            <option value="Nill">Nill</option>';
                                            <optgroup label="Common Subject">
                                                @foreach ($clgsub as $clgsubval) 
                                                <option value="{{ $clgsubval->clgsub }}">{{ $clgsubval->clgsub }}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Extra Subject">
                                                @foreach ($extsub as $sclexsubval) 
                                                <option value="{{ $sclexsubval->exsub }}">{{ $sclexsubval->exsub }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    <!--</div>-->
                                </div>

                                @if ($exmtm->sndtm != 0) 
                                <div class="form-group col-md-4">
                                    <label for = "sndexm{{ $n }}" style = "color:#FF6C60;">{{ $exmtm->sndtm }}</label>
                                    <!--<div class="form-group">-->
                                        <select name="sndexm{{ $n }}[]" id = "sndexm{{ $n }}" class="multiselect-ui form-control" required="required" multiple="multiple">
                                            <option value="">Select Subject</option>
                                            <option value="Nill">Nill</option>
                                            <optgroup label="Common Subject">
                                                @foreach ($clgsub as $clgsubval)
                                                <option value="{{ $clgsubval->clgsub }}">{{ $clgsubval->clgsub }}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Extra Subject">
                                                @foreach ($extsub as $sclexsubval)
                                                <option value="{{ $sclexsubval->exsub }}">{{ $sclexsubval->exsub }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    <!--</div>-->
                                </div>
                                @endif

                                <?php
                            }
                            ?>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                        @elseif($scltyp == 'b')
                        <form action="{{ url('/exam-routine/') }}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="scltp">Routine Type *</label>
                                <select name="scltp" id="scltp" class="form-control" required="required">
                                    <option value="">Select Classes</option>
                                    <option value="s">High School</option>
                                    <option value="c">Collage</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                        @endif
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
        <div class="form-group">
            <div class="col-md-4">
                <select id="" class="multiselect-ui form-control" multiple="multiple">
                    <optgroup label="One">
                        <option value="cheese">Cheese</option>
                        <option value="tomatoes">Tomatoes</option>
                        <option value="mozarella">Mozzarella</option>
                    </optgroup>
                    <optgroup label="Two">
                        <option value="mushrooms">Mushrooms</option>
                        <option value="pepperoni">Pepperoni</option>
                        <option value="onions">Onions</option>
                    </optgroup>
                </select>
            </div>
        </div>
    </section>
</section>
@endsection