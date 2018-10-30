@extend('dboardcontainer')

@section('title', 'Class Time')

@section('content')
<style type="text/css">
    .panel input{
        color: #000;
    }
</style>
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Select Total Number of Class per Day</strong><strong><a href="delete-class-time/{{Session::get('usrInfo')->sclcd}}" class="pull-right">Delete Class Time And Routine</a></strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <form action="{{ url('class-time') }}" method="POST" role="form">
                            @csrf

                            <div class="form-group">
                                <label for="ttlnum">Select Total Number of Class per Day *</label>
                                <select name="ttlnum" id="ttlnum" class="form-control" style="color: #000;" required="required">
                                    <option value="">Select Class Number</option>
                                    <option value="1">One</option>
                                    <option value="2">Tow</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                    <option value="5">Five</option>
                                    <option value="6">Six</option>
                                    <option value="7">Seven</option>
                                    <option value="8">Eight</option>
                                    <option value="9">Nine</option>
                                    <option value="10">Ten</option>
                                    <option value="11">Eleven</option>
                                    <option value="12">Twelve</option>
                                    <option value="13">Thirteen</option>
                                    <option value="14">Fourteen</option>
                                    <option value="15">Fifteen</option>
                                </select>
                            </div>

                            @if(Session::get('usrInfo')->scltyp == 'b')
                            <div class="form-group">
                                <label for="scltyp">Select Study Type *</label>
                                <select name="scltyp" id="scltyp" class="form-control" style="color: #000;" required="required">
                                    <option value="">Select Type</option>
                                    <option value="s">School</option>
                                    <option value="c">Collage</option>
                                </select>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </section>

                <?php
                if ($ttlNum != 0):
                    ?>
                    <section class="panel">
                        <header class="panel-heading">
                            <strong>Add Class Time</strong>
                        </header>
                        <div class="panel-body">
                            <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                            <form action="{{ url('insert-class-time') }}" method="POST">
                                @csrf

                                <input type="hidden" name="ttlnum" value="{{ $ttlNum }}" />
                                <input type="hidden" name="scltyp" value="{{ $scltyp }}" />
                                <div id="classTime" style="margin-bottom:15px;">
                                    @for ($i = 1; $i <= $ttlNum; $i++)
                                    <div class="row" style = "border-bottom:1px solid #eee;">
                                        <div class="form-group col-md-4">
                                            <label for = "cls{{$i}}" class="control-label">Class</label>
                                            <input type="text" name = "cls{{$i}}" id = "cls{{$i}}" value = "No - {{$i}} Class" class="form-control" readonly="readonly" placeholder="Class Number">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for = "from{{$i}}" class="control-label">Start Time</label>
                                            <div class="input-group bootstrap-timepicker">
                                                <input type="text" name = "from{{$i}}" id = "from{{$i}}" class = "form-control timepicker-default" placeholder="Form" onkeydown="return false" required="required">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for = "to{{$i}}" class="control-label">End Time</label>
                                            <div class="input-group bootstrap-timepicker">
                                                <input type="text" name = "to{{$i}}" id = "to{{$i}}" class="form-control timepicker-default" placeholder="To" onkeydown="return false;" required="required">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button"><i class="icon-time"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>

                        </div>
                    </section>
                    <?php
                endif;
                ?>
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