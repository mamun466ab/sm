@extend('dboardcontainer')

@section('title', 'Add Subject')

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
                        <strong>Add Extra Subject</strong>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <form action="subject-add" method="POST" role="form" id="data_form">
                            @csrf
                            <div class="form-group">
                                <label for="subnme">Subject Name</label>
                                <input type="text" name="subnme" class="form-control" id="subnme" placeholder="Extra Subject Name">
                            </div>
                            <div class="form-group">
                                <label for="subcde">Subject Code</label>
                                <input type="text" name="subcde" class="form-control" id="subcde" placeholder="Extra Subject Code">
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