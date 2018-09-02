@extend('dboardcontainer')

@section('title', 'Edit Profile')

@section('content')

<style>
    .form-control {
        color: #000;
    }
</style>{



<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <aside class="profile-nav col-lg-3">
                <section class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <img src="{{ asset('wbdlibs/img/profile-avatar.jpg') }}" alt="">
                        </a>
                        <h1>Jonathan Smith</h1>
                        <p>jsmith@flatlab.com</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="{{ url('/profile/') }}"> <i class="icon-user"></i> Profile</a></li>
                        <!--<li><a href="profile-activity.html"> <i class="icon-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a></li>-->
                        <li><a href="{{ url('/edit-profile/') }}"> <i class="icon-edit"></i> Edit profile</a></li>
                    </ul>

                </section>
            </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              <h1>Edit Profile</h1>
                          </div>
                          <div class="panel-body bio-graph-info">                              
                              <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                      <label for="about"  class="col-lg-2 control-label">About Me</label>
                                      <div class="col-lg-10">
                                          <textarea name="about" id="about" class="form-control" cols="30" rows="10">My Name is Ruhul</textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="usrnme" class="col-lg-2 control-label">Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" name="usrnme" class="form-control" id="usrnme" value="{{ Session::get('usrInfo')->usrnme }}" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="country" class="col-lg-2 control-label">Country</label>
                                      <div class="col-lg-6">
                                          <input type="text" name="country" class="form-control" id="country" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="birth" class="col-lg-2 control-label">Birthday</label>
                                      <div class="col-lg-6">
                                          <input name="birth" type="text" class="form-control" id="birth" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="email" class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input name="email" type="text" class="form-control" id="email" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="mobile" class="col-lg-2 control-label">Mobile</label>
                                      <div class="col-lg-6">
                                          <input name="mobile" type="text" class="form-control" id="mobile" placeholder=" ">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success">Save</button>
                                          <button type="button" class="btn btn-default">Cancel</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> Sets New Password & Avatar</div>
                              <div class="panel-body">
                                  <form class="form-horizontal" role="form">
                                      <div class="form-group">
                                          <label for="crnt_psd" class="col-lg-2 control-label">Current Password</label>
                                          <div class="col-lg-6">
                                              <input name="crnt_psd" type="password" class="form-control" id="crnt_psd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="new_psd" class="col-lg-2 control-label">New Password</label>
                                          <div class="col-lg-6">
                                              <input name="new_psd" type="password" class="form-control" id="new_psd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="new_psd" class="col-lg-2 control-label">Re-type New Password</label>
                                          <div class="col-lg-6">
                                              <input name="new_psd" type="password" class="form-control" id="new_psd" placeholder=" ">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label">Change Profile Photo</label>
                                          <div class="col-lg-6">
                                              <input type="file" class="file-pos" id="exampleInputFile">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button type="submit" class="btn btn-info">Save</button>
                                              <button type="button" class="btn btn-default">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>
        </div>

        <!-- page end-->
    </section>
</section>
@endsection