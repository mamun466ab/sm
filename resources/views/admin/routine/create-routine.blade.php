@extend('dboardcontainer')

@section('title', 'Create Routine')

@section('content')
<style type="text/css">
    .panel input{
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
        overflow: hidden;
    }
</style>
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Create Class Routine</strong>
                    </header>

                    @if($num != 0)
                    <div class="panel-body">
                        <form action="{{ url('/routine-create/') }}" method="POST" role="form">
                            @csrf
                            <?php
                            $sclcd = Session::get('usrInfo')->sclcd;
                            $scltyp = Session::get('usrInfo')->scltyp;

                            if ($num == 6 OR $num == 7 OR $num == 8 OR $num == 9 OR $num == 10) {
                                $clstme = DB::table('clstme')->select('*')->whereRaw("sclcd = '$sclcd' AND scltyp = 's'")->get();
                            } elseif ($num == 11 or $num == 12) {
                                $clstme = DB::table('clstme')->select('*')->whereRaw("sclcd = '$sclcd' AND scltyp = 'c'")->get();
                            }

                            if ($num == 6 OR $num == 7 OR $num == 8 OR $num == 9 OR $num == 10) {
                                $cls = 's';
                            } elseif ($num == 11 or $num == 12) {
                                $cls = 'c';
                            }

                            if ($num == 6 OR $num == 7 OR $num == 8 OR $num == 9 OR $num == 10) {
                                $subject = DB::table('subject')->select('*')->orderBy('sub')->get();
                            } elseif ($num == 11 or $num == 12) {
                                $subject = DB::table('clgsub')->select('*')->orderBy('clgsub')->get();
                            }

                            $extSub = DB::table('extsub')->select('*')->where('sclcd', $sclcd)->orderBy('exsub')->get();
                            $i = 1;
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cls">Class *</label>
                                        <select name="cls" id="cls" class="form-control" style="color: #000;" required="required">
                                            <option value="">Select Class</option>
                                            @if($scltyp == 'b')
                                            <option <?php
                                            if ($num == 6) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="6">Six</option>
                                            <option <?php
                                            if ($num == 7) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="7">Seven</option>
                                            <option <?php
                                            if ($num == 8) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="8">Eight</option>
                                            <option <?php
                                            if ($num == 9) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="9">Nine</option>
                                            <option <?php
                                            if ($num == 10) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="10">Ten</option>
                                            <option <?php
                                            if ($num == 11) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="11">Enter 1st Year</option>
                                            <option <?php
                                            if ($num == 12) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="12">Enter 2nd Year</option>
                                            @elseif($scltyp == 's')
                                            <option <?php
                                            if ($num == 6) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="6">Six</option>
                                            <option <?php
                                            if ($num == 7) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="7">Seven</option>
                                            <option <?php
                                            if ($num == 8) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="8">Eight</option>
                                            <option <?php
                                            if ($num == 9) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="9">Nine</option>
                                            <option <?php
                                            if ($num == 10) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="10">Ten</option>
                                            @elseif($scltyp == 'c')
                                            <option <?php
                                            if ($num == 11) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="11">Enter 1st Year</option>
                                            <option <?php
                                            if ($num == 12) {
                                                echo 'selected="selected"';
                                            }
                                            ?> value="12">Enter 2nd Year</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="ttlcls" value="{{ count($clstme) }}" />
                            <input type="hidden" name="rtncls" value="{{ $cls }}" />
                            <div class="row" style="margin-bottom:15px; color: rgb(121, 121, 121); font-weight: bold; text-align: center;">
                                <div class="col-lg-2 text-info">
                                    Class Time
                                </div>
                                <div class="col-lg-10">
                                    <div class="col-lg-2 text-info">Saturday</div>
                                    <div class="col-lg-2 text-info">Sunday</div>
                                    <div class="col-lg-2 text-info">Monday</div>
                                    <div class="col-lg-2 text-info">Tuesday</div>
                                    <div class="col-lg-2 text-info">Wednesday</div>
                                    <div class="col-lg-2 text-info">Thursday</div>
                                </div>
                            </div>


                            @if (count($clstme) > 0)
                            <?php
                            foreach ($clstme as $clsTm):
                                ?>
                                <div class = "row" style="margin-bottom:15px;">
                                    <div class="col-lg-2">
                                        <input type = "text" name = "clstme{{ $i }}" class = "form-control" id = "clstme{{ $i }}" readonly="readonly" value = "{{ $clsTm->clstme }}">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="col-lg-2">
                                            <select name="sat{{ $i }}[]" id="sat{{ $i }}" class="multiselect-ui form-control" required="required" style="color:#000;" multiple="multiple" oninvalid="this.setCustomValidity('This field cannot be left blank.')">
                                                <option value="">Subject</option>
                                                <option value="Tiffin Time">Tiffin Time</option>
                                                <optgroup label="Common Subject">
                                                    @foreach ($subject as $cmnSub)
                                                    <?php
                                                    if (empty($cmnSub->sub)) {
                                                        $allsub = $cmnSub->clgsub;
                                                    } else {
                                                        $allsub = $cmnSub->sub;
                                                    }
                                                    ?>
                                                    <option value="{{ $allsub }}">{{ $allsub }}</option>
                                                    @endforeach
                                                </optgroup>

                                                <optgroup label="Extra Subject">
                                                    @foreach ($extSub as $exSub)
                                                    <option value="{{ $exSub->exsub }}">{{ $exSub->exsub }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <select name="sun{{ $i }}[]" id="sun{{ $i }}" class="multiselect-ui form-control" required="required" style="color:#000;" multiple="multiple">
                                                <option value="">Subject</option>
                                                <option value="Tiffin Time">Tiffin Time</option>
                                                <optgroup label="Common Subject">
                                                    @foreach ($subject as $cmnSub)
                                                    <?php
                                                    if (empty($cmnSub->sub)) {
                                                        $allsub = $cmnSub->clgsub;
                                                    } else {
                                                        $allsub = $cmnSub->sub;
                                                    }
                                                    ?>
                                                    <option value="{{ $allsub }}">{{ $allsub }}</option>
                                                    @endforeach
                                                </optgroup>

                                                <optgroup label="Extra Subject">
                                                    @foreach ($extSub as $exSub)
                                                    <option value="{{ $exSub->exsub }}">{{ $exSub->exsub }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <select name="mon{{ $i }}[]" id="mon{{ $i }}" class="multiselect-ui form-control" required="required" style="color:#000;" multiple="multiple">
                                                <option value="">Subject</option>
                                                <option value="Tiffin Time">Tiffin Time</option>
                                                <optgroup label="Common Subject">
                                                    @foreach ($subject as $cmnSub)
                                                    <?php
                                                    if (empty($cmnSub->sub)) {
                                                        $allsub = $cmnSub->clgsub;
                                                    } else {
                                                        $allsub = $cmnSub->sub;
                                                    }
                                                    ?>
                                                    <option value="{{ $allsub }}">{{ $allsub }}</option>
                                                    @endforeach
                                                </optgroup>

                                                <optgroup label="Extra Subject">
                                                    @foreach ($extSub as $exSub)
                                                    <option value="{{ $exSub->exsub }}">{{ $exSub->exsub }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <select name="tue{{ $i }}[]" id="tue{{ $i }}" class="multiselect-ui form-control" required="required" style="color:#000;" multiple="multiple">
                                                <option value="">Subject</option>
                                                <option value="Tiffin Time">Tiffin Time</option>
                                                <optgroup label="Common Subject">
                                                    @foreach ($subject as $cmnSub)
                                                    <?php
                                                    if (empty($cmnSub->sub)) {
                                                        $allsub = $cmnSub->clgsub;
                                                    } else {
                                                        $allsub = $cmnSub->sub;
                                                    }
                                                    ?>
                                                    <option value="{{ $allsub }}">{{ $allsub }}</option>
                                                    @endforeach
                                                </optgroup>

                                                <optgroup label="Extra Subject">
                                                    @foreach ($extSub as $exSub)
                                                    <option value="{{ $exSub->exsub }}">{{ $exSub->exsub }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <select name="wed{{ $i }}[]" id="wed{{ $i }}" class="multiselect-ui form-control" required="required" style="color:#000;" multiple="multiple">
                                                <option value="">Subject</option>
                                                <option value="Tiffin Time">Tiffin Time</option>
                                                <optgroup label="Common Subject">
                                                    @foreach ($subject as $cmnSub)
                                                    <?php
                                                    if (empty($cmnSub->sub)) {
                                                        $allsub = $cmnSub->clgsub;
                                                    } else {
                                                        $allsub = $cmnSub->sub;
                                                    }
                                                    ?>
                                                    <option value="{{ $allsub }}">{{ $allsub }}</option>
                                                    @endforeach
                                                </optgroup>

                                                <optgroup label="Extra Subject">
                                                    @foreach ($extSub as $exSub)
                                                    <option value="{{ $exSub->exsub }}">{{ $exSub->exsub }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <select name="thu{{ $i }}[]" id="thu{{ $i }}" class="multiselect-ui form-control" required="required" style="color:#000;" multiple="multiple">
                                                <option value="">Subject</option>
                                                <option value="Tiffin Time">Tiffin Time</option>
                                                <optgroup label="Common Subject">
                                                    @foreach ($subject as $cmnSub)
                                                    <?php
                                                    if (empty($cmnSub->sub)) {
                                                        $allsub = $cmnSub->clgsub;
                                                    } else {
                                                        $allsub = $cmnSub->sub;
                                                    }
                                                    ?>
                                                    <option value="{{ $allsub }}">{{ $allsub }}</option>
                                                    @endforeach
                                                </optgroup>

                                                <optgroup label="Extra Subject">
                                                    @foreach ($extSub as $exSub)
                                                    <option value="{{ $exSub->exsub }}">{{ $exSub->exsub }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                            @endif
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                    @endif

                    @if($num == 0)
                    <div class="panel-body">
                        <?php
                        if (Session::get('msg') != NULL) {
                            echo '<div class="alert alert-success print-success-msg text-center">';
                            echo Session::get('msg');
                            echo '</div>';
                            Session::forget('msg');
                        }
                        ?>

                        <?php
                        if (Session::get('errors') != NULL) {
                            echo '<div class="alert alert-danger print-success-msg text-center">';
                            echo Session::get('errors');
                            echo '</div>';
                            Session::forget('errors');
                        }
                        $scltyp = Session::get('usrInfo')->scltyp;
                        ?>

                        <form action="{{ url('/create-routine/') }}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="cls">Class *</label>
                                <select name="cls" id="cls" class="form-control" style="color: #000;" required="required">
                                    <option value="">Select Class</option>
                                    @if($scltyp == 'b')
                                    <option value="6">Six</option>
                                    <option value="7">Seven</option>
                                    <option value="8">Eight</option>
                                    <option value="9">Nine</option>
                                    <option value="10">Ten</option>
                                    <option value="11">Enter 1st Year</option>
                                    <option value="12">Enter 2nd Year</option>
                                    @elseif($scltyp == 's')
                                    <option value="6">Six</option>
                                    <option value="7">Seven</option>
                                    <option value="8">Eight</option>
                                    <option value="9">Nine</option>
                                    <option value="10">Ten</option>
                                    @elseif($scltyp == 'c')
                                    <option value="11">Enter 1st Year</option>
                                    <option value="12">Enter 2nd Year</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </section>
</section>
@endsection