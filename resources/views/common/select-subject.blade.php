@extend('dboardcontainer')

@section('title', 'Select Subject')

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
                        <strong>Select Subject</strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <form action="select-subject" method="POST" role="form" id="data_form" class="form-horizontal" style="padding:15px;">
                            @csrf
                            <div class="form-group">
                                <label for="stdcls">Class</label>
                                <select name="stdcls" id="stdcls" class="form-control" onchange="ajaxGET('stdid','{{ URL::to('/student-list-option/') }}/'+this.value)">
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

                            <div class="form-group">
                                <label for="stdid">Select Student</label>
                                <select name="stdid" id="stdid" class="form-control">
                                    <option value="">Select Class First</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php
                                $cmnSub = DB::table('subject')->select('*')->get();
                                $sclcd = Session::get('usrInfo')->sclcd;
                                $extSub = DB::table('extsub')->select('*')->where('sclcd', $sclcd)->get();
                                ?>
                                <label for="cmnsub">Common Subject</label>
                                <div id="cmnsub">
                                    @foreach($cmnSub as $sub)
                                    <?php
                                    if ($sub->sts == 1):
                                        $chcked = 'checked="checked"';
                                    else:
                                        $chcked = '';
                                    endif;
                                    ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" {{ $chcked }} name="cmnsub[]" id="inlineCheckbox1" value="{{ $sub->subcd }}"> {{ $sub->sub }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="extsub">Common Subject</label>
                                <div id="extsub">
                                    @foreach($extSub as $exsub)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="extsub[]" id="inlineCheckbox1" value="{{ $exsub->exsubcd }}"> {{ $exsub->exsub }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <?php
                                $forthsub = DB::table('subject')->select('*')->where('sts', 4)->get();
                                ?>
                                <label for="frtsub">Forth Subject</label>
                                <div id="frtsub">
                                    @foreach($forthsub as $frsub)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="frtsub" id="inlineCheckbox1" value="{{ $frsub->subcd }}"> {{ $frsub->sub }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>

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