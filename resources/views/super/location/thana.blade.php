@extends('super.index')
@section('content')
@section('title', 'Thana Create')




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
            <div class="col-lg-6">
              <section class="panel">
                  <header class="panel-heading">
                      @yield('title')
                  </header>

                <div class="panel-body">
                  
                <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                    <form id="data_form" action="{{ url('/thana-create') }}" method="post" class="form-inline" role="form">
                      @csrf
                        <div class="control-group">
                          <label class="control-label">Select Country</label>
                          <div class="controls">
                            <select name="cntid" id="cntid" onchange="ajaxGET('create_thana_division_id','{{URL::to('/division/')}}/'+this.value)" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                @if ($country->cnt == 'Bangladesh')
                                <option value="{{ $country->id }}">{{ $country->cnt }}</option>
                                @else
                                <option value="{{ $country->id }}" disabled="disabled">{{ $country->cnt }}</option>
                                @endif

                                @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Select Division</label>
                            <div class="controls">
                                <select name="create_thana_division_id" id="create_thana_division_id" onchange="ajaxGET('create_thana_dist_id','{{URL::to('/district/')}}/'+this.value)" class="form-control">
                                    <option value="">Select Country First</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                          <div class="controls">
                            <label class="control-label">District Name</label>
                            <select name="create_thana_dist_id" id="create_thana_dist_id" class="form-control">
                                <option value="">Select District First</option>
                            </select>
                          </div>
                        </div>
                        <div class="control-group">
                          <div class="controls">
                            <label class="control-label">Thana Name</label>
                            <input type="text" name="thn" class="form-control" id="thn" placeholder="Enter Thana Name">
                          </div>
                        </div>
                        <br>
                        <div class="control-group">
                          <div class="controls">
                            <button type="submit" class="btn btn-success">Add New Thana</button>
                          </div>
                        </div>
                    </form>

                </div>
              </section>
            </div>

              <div class="col-lg-6">
                              <?php
                                $message = Session::get('message');
                              ?>
                            @if ($message)
                              <div class="text-center alert alert-success">
                                {{ $message }}
                                {{ Session::put('message', null) }}
                             </div>
                            @endif
                <section class="panel">
                    <header class="panel-heading">
                        Thana List
                    </header>

                  <div class="panel-body">
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>SL.</th>
                                          <th>Thana Name</th>
                                          <th class="center">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                        <?php $i = 1; ?>
                  @foreach ($thanas as $thana)
                                      <tr>
                                          <td>{{ $i++ }}</td>
                                          <td>{{ $thana->thn }}</td>
                                          <td>
                                            <a class="btn btn-primary" href="{{ url('/thana-edit') }}/{{ $thana->id }}">Edit</a> || 
                                            <a class="btn btn-danger" href="{{ url('/thana-delete') }}/{{ $thana->id }}">Delete</a>
                                          </td>
                                      </tr>
                  @endforeach

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