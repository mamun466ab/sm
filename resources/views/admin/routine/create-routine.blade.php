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
                        <strong>Create Class Routine</strong>
                    </header>
                    <div class="panel-body">
                            <?php
                                if(Session::get('msg') != NULL){
                                    echo '<div class="alert alert-success print-success-msg text-center">';
                                    echo Session::get('msg');
                                    echo '</div>';
                                    Session::forget('msg');
                                }
                            ?>
                        
                            <?php
                                if(Session::get('errors') != NULL){
                                    echo '<div class="alert alert-danger print-success-msg text-center">';
                                    echo Session::get('errors');
                                    echo '</div>';
                                    Session::forget('errors');
                                }
                                $scltyp = Session::get('usrInfo')->scltyp;
                            ?>
                        
                        <form action="routine-create" method="POST" role="form">
                            @csrf

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cls">Class *</label>
                                        <select name="cls" id="cls" class="form-control" style="color: #000;" required="required" onchange="ajaxGET('clsRtn','{{ URL::to('/cls-rtn/') }}/'+this.value)">
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
                                </div>
                            </div>
                            
                            <div id="clsRtn"></div>
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