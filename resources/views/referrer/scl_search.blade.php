@extends('super.index')
@section('content')
@section('title', 'Registered School List')

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header cla
                  ss="panel-heading">
                      <a href="{{ url('/search-school-list') }}" class="btn btn-primary">@yield('title') View</a>
                  </header>
                  <div class="panel-body">
                    <form action="{{ url('/search-school-list') }}" method="get" class="form-inline" role="form">
                      @csrf
                        <div class="form-group col-lg-4">
                            <label class="sr-only" for="searching_name">Country Name</label>
                            <input type="text" name="searching_name" class="form-control" id="searching_name" placeholder="Search by School Code or Name">
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
                @if (isset($data))
                        @if (count($data) > 0)
                          @foreach ($data as $sclsrc)
                              <tr class="">
                                <td>{{ $i++ }}</td>
                                <td>{{ $sclsrc->sclnme }}</td>
                                <td>{{ $sclsrc->scleml }}</td>
                                <td>{{ $sclsrc->sclcd }}</td>
                                <td>{{ $sclsrc->scladr }}</td>
                                <td>{{ $sclsrc->jondt }}</td>
                                <td>{{ $sclsrc->expdte }}</td>
                                <td><a class="btn btn-primary" href="{{ url('/school-details') }}/{{ $sclsrc->id }}"><i class="icon-eye-open"></i></a></td>
                            </tr>                       
                         @endforeach
                        @elseif(count($data) == 0)
                           <tr class="aler alert-danger">
                               <td colspan="9" style="text-align: center;">Searching value not match!</td>
                           </tr>
                        @endif
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