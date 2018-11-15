@extends('super.index')
@section('content')
@section('title', 'Country Create')




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
	                  <form id="data_form" action="{{ url('/country-create') }}" method="post" class="form-inline" role="form">
	                  	@csrf
	                      <div class="form-group">
	                          <label class="sr-only" for="cnt">Country Name</label>
	                          <input type="text" name="cnt" class="form-control" id="cnt" placeholder="Enter Country Name">
	                      </div>
	                      <button type="submit" class="btn btn-success">Add New Country</button>
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
	                      Division List
	                  </header>

		              <div class="panel-body">
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>SL.</th>
                                          <th>Country Name</th>
                                          <th class="center">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      	<?php $i = 1; ?>
									@foreach ($countries as $country)
                                      <tr>
                                          <td>{{ $i++ }}</td>
                                          <td>{{ $country->cnt }}</td>
                                          <td>
                                          	<a class="btn btn-primary" href="{{ url('/country-edit') }}/{{ $country->id }}">Edit</a> || 
                                          	<a class="btn btn-danger" href="{{ url('/country-delete') }}/{{ $country->id }}">Delete</a>
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



@endsection