@extends('super.index')
@section('content')
@section('title', 'School Admin Details')

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

                        @foreach ($sclreg as $scl)

                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <tr>
                                  <th>School Name</th>
                                  <td>{{ $scl->sclnme }}</td>
                              </tr>
                              <tr>
                                  <th>Payment</th>
                                  <td><span class="label label-success">Success</span></td>
                              </tr>
                              <tr>

                                  <?php
                                    $sclcd = $scl->sclcde;
                                    $admin = DB::table('usrreg')
                                              ->where('sclcd', $sclcd)
                                              ->where('usrpwr', '1')
                                              ->get(); 
                                  ?>
                                  <th>School Current Admin Name</th>
                                  @foreach ($admin as $adm)
                                  <td><a href="{{ url('/school-admin-view') }}/{{ $adm->id }}" class="label label-inverse">
                                    {{ $adm->usrnme }}
                                  </a></td>
                                  @endforeach
                              </tr>
                              <tr>
                                  <th>School Teachers</th>
                                  <td><a href="{{ url('/school-teachers-view') }}/{{ $scl->sclcde }}" class="btn btn-primary">Teachers View</a></td>
                              </tr>
                              <tr>
                                  <th>Email</th>
                                  <td>{{ $scl->scleml }}</td>
                              </tr>
                              <tr>
                                  <th>School Code</th>
                                  <td>{{ $scl->sclcde }}</td>
                              </tr>
                              <tr>
                                  <th>Adress</th>
                                  <td>{{ $scl->scladr.", ".$scl->thn }}</td>
                              </tr>
                              <tr>
                                  <th>Joining Date</th>
                                  <td>{{ $scl->jondt }}</td>
                              </tr>
                              <tr>
                                  <th>Expire Date</th>
                                  <td>{{ $scl->expdte }}</td>
                              </tr>
                              <tr>
                                  <th>Class Management</th>
                                  <td>1-10</td>
                              </tr>
                              <?php
                                $sclcd = $scl->sclcde;
                                $totalstn = DB::table('clsrol')
                                              ->where('sclcd', $sclcd)
                                              ->count();
                                $cls6stn = DB::table('clsrol')
                                        ->where('sclcd', $sclcd)
                                        ->where('stdcls', '6')
                                        ->count();
                                $cls7stn = DB::table('clsrol')
                                        ->where('sclcd', $sclcd)
                                        ->where('stdcls', '7')
                                        ->count();
                                $cls8stn = DB::table('clsrol')
                                        ->where('sclcd', $sclcd)
                                        ->where('stdcls', '8')
                                        ->count();
                                $cls9stn = DB::table('clsrol')
                                        ->where('sclcd', $sclcd)
                                        ->where('stdcls', '9')
                                        ->count();
                                $cls10stn = DB::table('clsrol')
                                        ->where('sclcd', $sclcd)
                                        ->where('stdcls', '10')
                                        ->count();
                                $cls11stn = DB::table('clsrol')
                                        ->where('sclcd', $sclcd)
                                        ->where('stdcls', '11')
                                        ->count();
                                $cls12stn = DB::table('clsrol')
                                        ->where('sclcd', $sclcd)
                                        ->where('stdcls', '12')
                                        ->count();
                              ?>
                              <tr>
                                  <th>Total Students</th>
                                  <td>{{ $totalstn }}</td>
                              </tr>

                              @if ($cls6stn > 0)
                              <tr>
                                  <th>class Six Students</th>
                                  <td>{{ $cls6stn }}</td>
                              </tr>
                              @endif

                              @if ($cls7stn > 0)
                              <tr>
                                  <th>class 7 Students</th>
                                  <td>{{ $cls7stn }}</td>
                              </tr>
                              @endif

                              @if ($cls8stn > 0)
                              <tr>
                                  <th>class 8 Students</th>
                                  <td>{{ $cls8stn }}</td>
                              </tr>
                              @endif

                              @if ($cls9stn > 0)
                              <tr>
                                  <th>class 9 Students</th>
                                  <td>{{ $cls9stn }}</td>
                              </tr>
                              @endif

                              @if ($cls10stn > 0)
                              <tr>
                                  <th>class 10 Students</th>
                                  <td>{{ $cls10stn }}</td>
                              </tr>
                              @endif

                              @if ($cls11stn > 0)
                              <tr>
                                  <th>class 11 Students</th>
                                  <td>{{ $cls11stn }}</td>
                              </tr>
                              @endif

                              @if ($cls12stn > 0)
                              <tr>
                                  <th>class 12 Students</th>
                                  <td>{{ $cls12stn }}</td>
                              </tr>
                              @endif

                          </table>
                           @endforeach
                      </div>
                  </div>
              </section>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->



    @endsection