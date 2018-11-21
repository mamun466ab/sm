@extend('dboardcontainer')

@section('title', 'View Result')

@section('content')
<style type="text/css">
    .txtbold{
        font-weight: bold;
    }

    .txtcntr{
        text-align: center;
    }

    .font{
        font-family: 'Brush Script MT';
    }

    .rslttbl td, .rslttbl th {
        vertical-align: middle !important;
        padding: 6px !important;
    }

    .grdpnt tr td, .grdpnt tr th{
        padding: 0 3px;
        line-height: 12px;
        text-align: center;
    }
</style>
<!--main content start-->
<section id="main-content" style="padding-top: 15px;">
    <section class="wrapper">
        <?php
        $scltyp = Session::get('usrInfo')->scltyp;
        ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <select name="std_cls" id="std_cls" class="form-control" style="color: #000; padding: 6px;" onchange="ajaxGET('stdInfo','{{ URL::to('/list-student/') }}/'+this.value)">
                    <option value="">Select Class</option>
                    @if($scltyp == 's')
                    <option value="6">Class Six</option>
                    <option value="7">Class Seven</option>
                    <option value="8">Class Eight</option>
                    <option value="9">Class Nine</option>
                    <option value="10">Class Ten</option>
                    @elseif($scltyp == 'c')
                    <option value="11">Enter 1st Year</option>
                    <option value="12">Enter 2nd Year</option>
                    @else
                    <option value="6">Class Six</option>
                    <option value="7">Class Seven</option>
                    <option value="8">Class Eight</option>
                    <option value="9">Class Nine</option>
                    <option value="10">Class Ten</option>
                    <option value="11">Enter 1st Year</option>
                    <option value="12">Enter 2nd Year</option>
                    @endif
                </select>
            </div>
        </div>
        <!-- page start-->
        <div class="row" style="margin-top: 15px;">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php
                        $sclcd = Session::get('usrInfo')->sclcd;
                        $sclInfo = DB::table('sclreg')
                                ->join('usrdst', 'sclreg.dstid', '=', 'usrdst.id')
                                ->join('usrthn', 'sclreg.thnid', '=', 'usrthn.id')
                                ->select('sclreg.*', 'usrdst.dst', 'usrthn.thn')
                                ->where('sclreg.sclcd', $sclcd)
                                ->first();
                        $ttlNum = 0;
                        $ttlGPA = 0;
                        $ttlNumWExt = 0;
                        $ttlGPAWExt = 0;
                        ?>
                        <p style="text-align: center;">
                            <span style="font-size: 33px; font-weight: bold;">{{ $sclInfo->sclnme }}</span><br />
                            <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->scladr }}</span><br />
                            <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->thn }}, {{ $sclInfo->dst }}</span><br />
                        </p>
                        <strong>Academic Transcript</strong>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <div class="" style="width: 8.27in; height: 11.69in; margin: auto; padding: 15px; border: 10px #666 ridge; font-size: 17px; color: #000; position: relative;">
                                <img src="{{ asset('wbdlibs/logo/BAF-Monogram1.gif') }}" alt="School/Collage Logo." style="position:absolute;" width="70px" />
                                <p style="text-align: center; font-family: 'Times New Roman', Times, serif !important;">
                                    <span style="font-size: 30px; font-weight: bold;">{{ $sclInfo->sclnme }}</span><br />
                                    <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->scladr }}</span><br />
                                    <span style="font-size: 18px; font-weight: bold;">{{ $sclInfo->thn }}, {{ $sclInfo->dst }}</span><br />
                                    <span style="font-size: 20px; font-weight: bold;">1st Terms Examination 2018</span><br />
                                </p>

                                <hr>

                                <p style="text-align: center;">
                                    <span style="font-size: 20px; color: #666; font-weight: bold;"><u>Academic Transcript</u></span><br />
                                </p>
                                <table border="0" style="line-height: 28px; margin-bottom: 15px; float: left;">
                                    <tr>
                                        <td class="txtbold">Name of Student</td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td class="font">
                                            @if(isset($stdInfo))
                                            {{ $stdInfo->usrnme }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txtbold">Father's Name </td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td class="font">
                                            @if(isset($stdInfo))
                                            {{ $stdInfo->fthr }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txtbold">Mother's Name </td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td class="font">
                                            @if(isset($stdInfo))
                                            {{ $stdInfo->mthr }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txtbold">Class </td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td>
                                            @if(isset($stdInfo))
                                            @if($stdInfo->stdcls == 6)
                                            Six
                                            @elseif($stdInfo->stdcls == 7)
                                            Seven
                                            @elseif($stdInfo->stdcls == 8)
                                            Eight
                                            @elseif($stdInfo->stdcls == 9)
                                            Nine
                                            @elseif($stdInfo->stdcls == 10)
                                            Ten
                                            @elseif($stdInfo->stdcls == 11)
                                            Enter 1st Year
                                            @elseif($stdInfo->stdcls == 12)
                                            Enter 2nd Year
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txtbold">Roll No </td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td>
                                            @if(isset($stdInfo))
                                            {{ $stdInfo->stdrol }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txtbold">Date of Birth </td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td>
                                            @if(isset($stdInfo))
                                            {{ $stdInfo->dob }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <table class="pull-right grdpnt" border="1" style="font-size:12px;">
                                    <tr>
                                        <th>Latter<br />Grade</th><th>Class<br />Interval</th><th>Grade<br />Point</th>
                                    </tr>
                                    <tr>
                                        <td>A+</td> <td>80-100</td> <td>5.00</td>
                                    </tr>
                                    <tr>
                                        <td>A</td> <td>70-79</td> <td>4.00</td>
                                    </tr>
                                    <tr>
                                        <td>A-</td> <td>60-69</td ><td>3.50</td>
                                    </tr>
                                    <tr>
                                        <td>B</td> <td>50-59</td> <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td>C</td> <td>40-49</td> <td>2.00</td>
                                    </tr>
                                    <tr>
                                        <td>D</td> <td>33-39</td> <td>1.00</td>
                                    </tr>
                                    <tr>
                                        <td>F</td> <td>00-32</td> <td>0.00</td>
                                    </tr>
                                </table>

                                <table class="table table-bordered table-striped table-condensed rslttbl" style="font-size:13px;">
                                    <thead>
                                        <tr>
                                            <th class="txtcntr">Sl No</th>
                                            <th class="txtcntr">Name of Subject</th>
                                            <th class="txtcntr">Number</th>
                                            <th class="txtcntr">Letter Grade</th>
                                            <th class="txtcntr">Grade Point</th>
                                            <th class="txtcntr">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="stdInfo">
                                        <?php
                                        $i = 1;
                                        ?>
                                        @if(count($rstInfo) > 0)
                                        @foreach($rstInfo as $rstval)
                                        <?php
                                        $ttlNum += $rstval->num;
                                        $ttlNumWExt += $rstval->num;
                                        ?>
                                        <tr>
                                            <td align='center'>{{ $i }}.</td>
                                            <td>{{ $rstval->sub }}</td>
                                            <td align='center'>{{ $rstval->num }}</td>
                                            <td align='center'>
                                                @if($rstval->num <= 32)
                                                F
                                                @elseif($rstval->num >= 33 AND $rstval->num <= 39)
                                                D
                                                @elseif($rstval->num >= 40 AND $rstval->num <= 49)
                                                C
                                                @elseif($rstval->num >= 50 AND $rstval->num <= 59)
                                                B
                                                @elseif($rstval->num >= 60 AND $rstval->num <= 69)
                                                A-
                                                @elseif($rstval->num >= 70 AND $rstval->num <= 79)
                                                A
                                                @elseif($rstval->num >= 80 AND $rstval->num <= 100)
                                                A+
                                                @endif
                                            </td>
                                            <td align='center'>
                                                @if($rstval->num <= 32)
                                                0.00
                                                @elseif($rstval->num >= 33 AND $rstval->num <= 39)
                                                1.00 <?php $ttlGPA += 1; $ttlGPAWExt += 1; ?>
                                                @elseif($rstval->num >= 40 AND $rstval->num <= 49)
                                                2.00 <?php $ttlGPA += 2; $ttlGPAWExt += 2; ?>
                                                @elseif($rstval->num >= 50 AND $rstval->num <= 59)
                                                3.00 <?php $ttlGPA += 3; $ttlGPAWExt += 3; ?>
                                                @elseif($rstval->num >= 60 AND $rstval->num <= 69)
                                                3.50 <?php $ttlGPA += 3.50; $ttlGPAWExt += 3.50; ?>
                                                @elseif($rstval->num >= 70 AND $rstval->num <= 79)
                                                4.00 <?php $ttlGPA += 4; $ttlGPAWExt += 4; ?>
                                                @elseif($rstval->num >= 80 AND $rstval->num <= 100)
                                                5.00 <?php $ttlGPA += 5; $ttlGPAWExt += 5; ?>
                                                @endif
                                            </td>
                                            <td align='center'>
                                                @if($rstval->num <= 32)
                                                <span class="text-danger">Fail</span>
                                                @else
                                                Pass
                                                @endif
                                            </td>
                                        </tr>
                                        <?php
                                        @$i++
                                        ?>
                                        @endforeach
                                        
                                        @if(count($rsltExtInfo) > 0)
                                        @foreach($rsltExtInfo as $rstExtval)
                                        <?php
                                        $ttlNumWExt += $rstExtval->num;
                                        ?>
                                        <tr>
                                            <td align='center'>{{ $i }}.</td>
                                            <td>{{ $rstExtval->sub }}</td>
                                            <td align='center'>{{ $rstExtval->num }}</td>
                                            <td align='center'>
                                                @if($rstExtval->num <= 32)
                                                F
                                                @elseif($rstExtval->num >= 33 AND $rstExtval->num <= 39)
                                                D
                                                @elseif($rstExtval->num >= 40 AND $rstExtval->num <= 49)
                                                C
                                                @elseif($rstExtval->num >= 50 AND $rstExtval->num <= 59)
                                                B
                                                @elseif($rstExtval->num >= 60 AND $rstExtval->num <= 69)
                                                A-
                                                @elseif($rstExtval->num >= 70 AND $rstExtval->num <= 79)
                                                A
                                                @elseif($rstExtval->num >= 80 AND $rstExtval->num <= 100)
                                                A+
                                                @endif
                                            </td>
                                            <td align='center'>
                                                @if($rstExtval->num <= 32)
                                                0.00
                                                @elseif($rstExtval->num >= 33 AND $rstExtval->num <= 39)
                                                1.00 <?php $ttlGPAWExt += 1; ?>
                                                @elseif($rstExtval->num >= 40 AND $rstExtval->num <= 49)
                                                2.00 <?php $ttlGPAWExt += 2; ?>
                                                @elseif($rstExtval->num >= 50 AND $rstExtval->num <= 59)
                                                3.00 <?php $ttlGPAWExt += 3; ?>
                                                @elseif($rstExtval->num >= 60 AND $rstExtval->num <= 69)
                                                3.50 <?php $ttlGPAWExt += 3.50; ?>
                                                @elseif($rstExtval->num >= 70 AND $rstExtval->num <= 79)
                                                4.00 <?php $ttlGPAWExt += 4; ?>
                                                @elseif($rstExtval->num >= 80 AND $rstExtval->num <= 100)
                                                5.00 <?php $ttlGPAWExt += 5; ?>
                                                @endif
                                            </td>
                                            <td align='center'>
                                                @if($rstval->num <= 32)
                                                <span class="text-danger">Fail</span>
                                                @else
                                                Pass
                                                @endif
                                            </td>
                                        </tr>
                                        <?php
                                        @$i++
                                        ?>
                                        @endforeach
                                        @endif
                                        
                                        @if(!empty($rsltFrthInfo))
                                        <?php
                                        $ttlNum += $rsltFrthInfo->num;
                                        $ttlNumWExt += $rsltFrthInfo->num;
                                        ?>
                                        <tr>
                                            <td align='center'>{{ $i }}.</td>
                                            <td>{{ $rsltFrthInfo->sub }} (Additional Subject)</td>
                                            <td align='center'>{{ $rsltFrthInfo->num }}</td>
                                            <td align='center'>
                                                @if($rsltFrthInfo->num <= 32)
                                                F
                                                @elseif($rsltFrthInfo->num >= 33 AND $rsltFrthInfo->num <= 39)
                                                D
                                                @elseif($rsltFrthInfo->num >= 40 AND $rsltFrthInfo->num <= 49)
                                                C
                                                @elseif($rsltFrthInfo->num >= 50 AND $rsltFrthInfo->num <= 59)
                                                B
                                                @elseif($rsltFrthInfo->num >= 60 AND $rsltFrthInfo->num <= 69)
                                                A-
                                                @elseif($rsltFrthInfo->num >= 70 AND $rsltFrthInfo->num <= 79)
                                                A
                                                @elseif($rsltFrthInfo->num >= 80 AND $rsltFrthInfo->num <= 100)
                                                A+
                                                @endif
                                            </td>
                                            <td align='center'>
                                                @if($rsltFrthInfo->num <= 32)
                                                0.00
                                                @elseif($rsltFrthInfo->num >= 33 AND $rsltFrthInfo->num <= 39)
                                                1.00
                                                @elseif($rsltFrthInfo->num >= 40 AND $rsltFrthInfo->num <= 49)
                                                2.00
                                                @elseif($rsltFrthInfo->num >= 50 AND $rsltFrthInfo->num <= 59)
                                                3.00 <?php $ttlGPA += 1; $ttlGPAWExt += 1; ?>
                                                @elseif($rsltFrthInfo->num >= 60 AND $rsltFrthInfo->num <= 69)
                                                3.50 <?php $ttlGPA += 1.5; $ttlGPAWExt += 1.5; ?>
                                                @elseif($rsltFrthInfo->num >= 70 AND $rsltFrthInfo->num <= 79)
                                                4.00 <?php $ttlGPA += 2; $ttlGPAWExt += 2; ?>
                                                @elseif($rsltFrthInfo->num >= 80 AND $rsltFrthInfo->num <= 100)
                                                5.00 <?php $ttlGPA += 3; $ttlGPAWExt += 3; ?>
                                                @endif
                                            </td>
                                            <td align='center'>
                                                @if($rstval->num <= 32)
                                                <span class="text-danger">Fail</span>
                                                @else
                                                Pass
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        @endif
                                    </tbody>
                                </table>
                                
                                <table border="0" style="line-height: 23px; margin-bottom: 15px; float: left; font-size: 14px;">
                                    <tr>
                                        <td class="txtbold">Total Number <span style="font-size:12px;">(Without Extra Subject)</span></td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td>
                                            {{ $ttlNum }}
                                        </td>
                                    </tr>
                                    @if(count($rsltExtInfo) > 0)
                                    <tr>
                                        <td class="txtbold">Total Number <span style="font-size:12px;">(With Extra Subject)</span></td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td>
                                            {{ $ttlNumWExt }}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="txtbold">GPA <span style="font-size:12px;">(Without Extra Subject)</span></td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td><?php $rsltgpa = number_format($ttlGPA/count($rstInfo), 2); ?>
                                            {{ $rsltgpa }}
                                            @if($rsltgpa >= 1 And $rsltgpa < 2)
                                            (D)
                                            @elseif($rsltgpa >= 2 And $rsltgpa < 3)
                                            (C)
                                            @elseif($rsltgpa >= 3 And $rsltgpa < 3.5)
                                            (B)
                                            @elseif($rsltgpa >= 3.5 And $rsltgpa < 4)
                                            (A-)
                                            @elseif($rsltgpa >= 4 And $rsltgpa < 5)
                                            (A)
                                            @elseif($rsltgpa >= 5)
                                            (A+)
                                            @endif
                                        </td>
                                    </tr>
                                    @if(count($rsltExtInfo) > 0)
                                    <tr>
                                        <td class="txtbold">GPA <span style="font-size:12px;">(With Extra Subject)</span></td> <td class="txtbold"> &nbsp;:&nbsp; </td>
                                        <td> <?php $ttlsub = (count($rsltExtInfo) + count($rstInfo)); $extrslt = number_format(($ttlGPAWExt/$ttlsub), 2); ?>
                                            {{ $extrslt }}
                                            @if($extrslt >= 1 And $extrslt < 2)
                                            (D)
                                            @elseif($extrslt >= 2 And $extrslt < 3)
                                            (C)
                                            @elseif($extrslt >= 3 And $extrslt < 3.5)
                                            (B)
                                            @elseif($extrslt >= 3.5 And $extrslt < 4)
                                            (A-)
                                            @elseif($extrslt >= 4 And $extrslt < 5)
                                            (A)
                                            @elseif($extrslt >= 5)
                                            (A+)
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                                    <span  style="position: absolute; bottom: 60px; right: 15px; font-size: 14px;">School/Collage Authority</span>
                                <span style="font-family: cursive; position: absolute; bottom: 0px; left: 15px; font-size: 13px;">Date of publication of result : 2018-11-21</span>
                            </div>
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