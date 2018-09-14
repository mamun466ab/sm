@extend('dboardcontainer')

@section('title', 'Add Subject')

@section('content')
<section id="main-content" style="margin-bottom: 400px; padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
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
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Add Extra Subject</strong>
                    </header>
                    <div class="panel-body">
                        <form action="subject-add" method="POST" role="form" id="data_form">
                            @csrf
                            <div class="form-group">
                                <label for="subnme">Subject Name</label>
                                <input type="text" name="subnme" class="form-control" id="subnme" placeholder="Extra Subject Name">
                            </div>
                            <div class="form-group">
                                <label for="subcde">Subject Name</label>
                                <input type="text" name="subcde" class="form-control" id="subcde" placeholder="Extra Subject Code">
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection