@extends('super.index')
@section('content')
@section('title', 'Registered School List')

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
                                  <th>School Name</th>
                                  <th>Email</th>
                                  <th>School Code</th>
                                  <th>Adress</th>
                                  <th>Joining Date</th>
                                  <th>Expire Date</th>
                                  <th>Details</th>
                              </tr>
                              </thead>
                              <tbody>
                          <?php
                            $i = 1;
                          ?>
                      @if (count($sclreg) > 0)
                          @foreach ($sclreg as $scl)

                              <tr class="">
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $scl->sclnme }}</td>
                                  <td>{{ $scl->scleml }}</td>
                                  <td>{{ $scl->sclcde }}</td>
                                  <td>{{ $scl->scladr }}</td>
                                  <td>{{ $scl->jondte }}</td>
                                  <td>{{ $scl->expdte }}</td>
                                  <td><a class="btn btn-primary" href="{{ url('/school-details') }}/{{ $scl->id }}"><i class="icon-eye-open"></i></a></td>
                              </tr>
                         
                           @endforeach
                          @elseif(count($sclreg) == 0)
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