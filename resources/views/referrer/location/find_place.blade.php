@extends('super.index')
@section('content')
@section('title', 'Find Place')




<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
            <div class="row">
              <div class="col-lg-12">                
                <!---------- Menu---------->
                @include('super.location.menu')
              </div>
            </div>
            <div class="row">
            <div class="col-lg-12">
              <section class="panel">
                  <header class="panel-heading">
                      @yield('title')
                  </header>

                <div class="panel-body">
                  

                    <form action="{{ url('/find-place') }}" method="get" class="form-inline" role="form">
                      @csrf
                        <div class="form-group col-lg-4">
                            <label class="sr-only" for="searching_name">Country Name</label>
                            <input type="text" name="searching_name" class="form-control" id="searching_name" placeholder="Search Division, District and Thana">
                        </div>
                        <button type="submit" class="btn btn-success">Search Place</button>
                    </form>

                </div>
                  <div class="panel-body col-lg-7">
                            <?php
                                $message = Session::get('message');
                              ?>
                            @if ($message)
                              <div class="text-center alert alert-success">
                                {{ $message }}
                                {{ Session::put('message', null) }}
                             </div>
                            @endif
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>SL.</th>
                                          <th>Thana/Districit/Division Name</th>
                                          <th class="center">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                        $i = 1;
                                      ?>

                                      
                                      @if (isset($thanas) || isset($districts) || isset($divisions))
                                        @if(count($thanas) > 0 || count($districts) > 0 || count($divisions) > 0)

                                        @foreach ($thanas as $thn)
                                      <tr class="">
                                           <td>{{ $i++ }}</td>
                                           <td>{{ $thn->thn.", ".$thn->dst.", ".$thn->dvn." Division" }}</td>
                                           <td>
                                            <a class="btn btn-primary" href="{{ url('/thana-edit') }}/{{ $thn->id }}"><i class="icon-pencil"></i></a> ||
                                          <a class="btn btn-danger" href="{{ url('/thana-delete') }}/{{ $thn->id }}"><i class="icon-trash"></i></a></td>
                                       </tr>
                                       @endforeach


                                        @foreach ($districts as $dst)
                                      <tr class="">
                                           <td>{{ $i++ }}</td>
                                           <td>{{ $dst->dst.", ".$dst->dvn." Division" }}</td>
                                           <td>
                                            <a class="btn btn-primary" href="{{ url('/district-edit') }}/{{ $dst->id }}"><i class="icon-pencil"></i></a> ||
                                          <a class="btn btn-danger" href="{{ url('/district-delete') }}/{{ $dst->id }}"><i class="icon-trash"></i></a></td>
                                       </tr>
                                       @endforeach


                                        @foreach ($divisions as $dvn)
                                      <tr class="">
                                           <td>{{ $i++ }}</td>
                                           <td>{{ $dvn->dvn." Division" }}</td>
                                           <td>
                                            <a class="btn btn-primary" href="{{ url('/division-edit') }}/{{ $dvn->id }}"><i class="icon-pencil"></i></a> ||
                                          <a class="btn btn-danger" href="{{ url('/division-delete') }}/{{ $dvn->id }}"><i class="icon-trash"></i></a></td>
                                       </tr>
                                       @endforeach
                                    @elseif(count($thanas) == 0)
                                       <tr class="aler alert-danger">
                                           <td colspan="7" style="text-align: center;">Data Not Found!!</td>
                                       </tr>
                                    @endif
                                  @endif


                                      </tbody>
                          </table>
                                </div>
                          </div>
                  </div>
                </section>
              </div>
            </div>




              
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->



<script type="text/javascript">
    function ajaxGET(div, url, data) {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            $('#' + div).html("").css('color', '#000');
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                $('#' + div).append(xmlhttp.responseText);
//                document.getElementById(div).innerHTML = xmlhttp.responseText;
            } else {
                if (div == 'create_dist_division_id' || div == 'create_thana_division_id') {
                    document.getElementById(div).innerHTML = '<option value="">Select Country First</option>';
                    $('#' + div).css('color', 'red');
                } else if (div == 'create_thana_dist_id') {
                    document.getElementById(div).innerHTML = '<option value="">Select Division/State First</option>';
                    $('#' + div).css('color', 'red');
                } else if (div == 'org_cty') {
                    document.getElementById(div).innerHTML = '<option value="">Select Division/State First</option>';
                    $('#' + div).css('color', 'red');
                }
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send(data);
    }
</script>

@endsection