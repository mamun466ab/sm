@extends('super.index')
@section('content')
@section('title', 'School Wise Teachers List')

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      @yield('title') View
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

                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group pull-right">
                                  <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                                  </button>
                                  <ul class="dropdown-menu pull-right">
                                      <li><a href="#">Print</a></li>
                                      <li><a href="#">Save as PDF</a></li>
                                      <li><a href="#">Export to Excel</a></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="space15"></div>

                             <?php
                                $message = Session::get('message');
                              ?>
                            @if ($message)
                              <div class="text-center alert alert-success">
                                {{ $message }}
                                {{ Session::put('message', null) }}
                             </div>
                            @endif
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                  <th>SL.</th>
                                  <th>Name</th>
                                  <th>Photo</th>
                                  <th>Email</th>
                                  <th>Rank</th>
                                  <th>Mobile</th>
                                  <th>School Code</th>
                                  <th>Joining Date</th>
                                  <th>Details</th>
                              </tr>
                              </thead>
                              <tbody>
                          <?php
                            $i = 1;
                          ?>
                      @if (count($scl_tcrs) > 0)
                          @foreach ($scl_tcrs as $scl_tcr)

                              <tr class="">
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $scl_tcr->usrnme }}</td>
                                  <td><img src="{{ $scl_tcr->pic }}" width="50px" height="50px" alt="Photo"></td>
                                  <td>{{ $scl_tcr->usreml }}</td>
                                  <td>{{ $scl_tcr->usrrnk }}</td>
                                  <td>{{ $scl_tcr->usrmbl }}</td>
                                  <td>{{ $scl_tcr->sclcd }}</td>
                                  <td>{{ $scl_tcr->jondte }}</td>
                                  <td><a class="btn btn-primary" href="{{ url('/teacher-details') }}/{{ $scl_tcr->id }}"><i class="icon-eye-open"></i></a></td>
                              </tr>
                         
                           @endforeach
                          @elseif(count($scl_tcrs) == 0)
                             <tr class="aler alert-danger">
                                 <td colspan="9" style="text-align: center;">There is no school found!</td>
                             </tr>
                          @endif

                              </tbody>
                          </table>
                      </div>
                  </div>
              </section>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->



    @endsection