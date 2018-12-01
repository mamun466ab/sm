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
                        <strong>Add Class Time</strong><strong><a href="delete-class-time/{{Session::get('usrInfo')->sclcd}}" class="pull-right">Delete Class Time</a></strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <form action="class-time"                        method="POST" role="form">
                            @csrf

                            <div class="form-group">
                                <label for="ttlnum">Select Total Number of Class per Day *</label>
                                <select name="ttlnum" id="ttlnum" class="form-control" style="color: #000;" onchange="ajaxGET('classTime','{{ URL::to('/class-numbr/') }}/'+this.value)" required="required">
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

                            <div id="classTime" style="margin-bottom:15px;">
                                <font color="red">Please select per day class number first.</font>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>

                    </div>
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