@extend('dboardcontainer')

@section('title', 'Exam Routine')

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
                        if (Session::get('msg') != NULL) {
                            echo '<div class="alert alert-success print-success-msg text-center">';
                            echo Session::get('msg');
                            echo '</div>';
                            Session::forget('msg');
                        }
                        ?>
                        <form action="{{ url('/create-exm-routine/') }}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="rtnTyp">Routine Type *</label>
                                <select name="rtnTyp" id="rtnTyp" class="form-control" required="required" onchange="ajaxGET('exmRtn','{{ URL::to('/exm-rtn/') }}/'+this.value)">
                                    <option value="">Select Classes</option>
                                    <option value="s">High School</option>
                                    <option value="c">Collage</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exmdte">Exam Date *</label>
                                <input name="exmdte" id="exmdte" type="text" class="form-control default-date-picker" onkeydown="return false" placeholder="Exam Date" required="required">
                            </div>

                            <div id="exmRtn"></div>

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