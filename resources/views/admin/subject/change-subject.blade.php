@extend('dboardcontainer')

@section('title', 'Change Subject')

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
                        <strong>Change Subject</strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <form action="subject-change" method="POST" role="form" class="form-horizontal" style="padding:15px;" id="data_form">
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
                                <select name="stdid" id="stdid" class="form-control" onchange="ajaxGET('selectedSubject','{{ URL::to('/selected-subject/') }}/'+this.value)">
                                    <option value="">Select Class First</option>
                                </select>
                            </div>

                            <div id="selectedSubject">
                                
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