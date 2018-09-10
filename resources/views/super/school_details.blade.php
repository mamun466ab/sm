@extends('super.index')
@section('content')
@section('title', 'School Details')

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
                                  <td>{{ $scl->jondte }}</td>
                              </tr>
                              <tr>
                                  <th>Expire Date</th>
                                  <td>{{ $scl->expdte }}</td>
                              </tr>
                              <tr>
                                  <th>Class Management</th>
                                  <td>1-10</td>
                              </tr>
                              <tr>
                                  <th>Total Students</th>
                                  <td>----</td>
                              </tr>
                              <tr>
                                  <th>class One Students</th>
                                  <td>----</td>
                              </tr>
                              <tr>
                                  <th>class Two Students</th>
                                  <td>----</td>
                              </tr>
                              <tr>
                                  <th>class Three Students</th>
                                  <td>----</td>
                              </tr>
                              <tr>
                                  <th>class Four Students</th>
                                  <td>----</td>
                              </tr>
                              <tr>
                                  <th>class Five Students</th>
                                  <td>----</td>
                              </tr>
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