@extend('dboardcontainer')

@section('title', 'Settings')

@section('content')
<!--main content start-->
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <!-- page start-->
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Settings</strong>
                    </header>
                    <div class="panel-body" style="font-size: 14px;">
                        <section>
                            <?php
                                $usrInfo = Session::get('usrInfo');
                            ?>
                            @if($usrInfo->usrpwr == 1)
                            <div class="row" style="border-bottom: 1px solid #eeeeee; border-top: 1px solid #eeeeee; padding: 10px 15px 5px 15px; line-height: 30px;">
                                <div class="col-md-10 col-sm-12">
                                    <div class="col-md-3" style="font-weight: bold;">Result System</div>
                                    <div class="col-md-7">Do you want to include extra subject number when you create a result?</div>
                                        <?php
                                            $sclCde = Session::get('usrInfo')->sclcd;
                                            $rssettng = DB::table('sttng')->select('sttng')->where('sclcd', $sclCde)->where('sttngnm', 'rs')->first();
                                            if($rssettng->sttng == 1):
//                                                echo 'Yes';
                                                $yes = 'selected="selected"';
                                            $btn = 'btn-info';
                                            else:
                                                $yes = '';
                                            endif;
                                            if($rssettng->sttng == 0):
                                                $no = 'selected="selected"';
                                            $btn = 'btn-danger';
                                            else:
                                                $no = '';
                                            endif;
                                            ?>
                                    <div class="col-md-2">
                                        <table border="0">
                                            <tr>
                                                <td id="rslt">
                                                    <select class="btn {{ $btn }} btn-sm" style="padding: 0px; font-weight: bold;" onchange="ajaxGET('rslt','{{ url('/settings-rslt-sstm/') }}/'+this.value)">
                                                        <option value="Yes" {{ $yes }}>Yes</option>
                                                        <option value="No" {{ $no }}>No</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </section>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
@endsection