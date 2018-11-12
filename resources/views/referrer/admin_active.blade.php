@extends('super.index')
@section('content')
@section('title', 'Active Schools Admin')

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      @yield('title') View
                  </header>
                  <div class="panel-body">
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
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Genger</th>
                                  <th>School Code</th>
                                  <th>School Name</th>
                                  <th>Rank</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                          <?php
                            $i = 1;
                          ?>
                      @if (count($scl_admin_reqs) > 0)
                          @foreach ($scl_admin_reqs as $scl_admin_req)

                              <tr class="">
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $scl_admin_req->usrnme }}</td>
                                  <td>{{ $scl_admin_req->usreml }}</td>
                                  <td>phone number</td>
                                  <td>{{ $scl_admin_req->usrgnr }}</td>
                                  <td>{{ $scl_admin_req->sclcd }}</td>
                                  <td>{{ $scl_admin_req->sclnme }}</td>
                                  <td>{{ $scl_admin_req->usrrnk }}</td>
                                  <td><a class="btn btn-danger" href="{{ url('/admin-deactivate') }}/{{ $scl_admin_req->id }}">Deactive</a></td>
                              </tr>
                         
                           @endforeach
                          @elseif(count($scl_admin_reqs) == 0)
                             <tr class="aler alert-danger">
                                 <td colspan="9" style="text-align: center;">There is no Active Admin now</td>
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