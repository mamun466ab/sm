<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="{{ asset('wbdlibs/img/favicon.png') }}">

        <title>@yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('wbdlibs/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('wbdlibs/css/bootstrap-reset.css') }}" rel="stylesheet">
        <!--external css-->
        <link href="{{ asset('wbdlibs/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('wbdlibs/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" />
        <link href="{{ asset('wbdlibs/assets/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
        <link href="{{ asset('wbdlibs/assets/bootstrap-timepicker/compiled/timepicker.css') }}" rel="stylesheet" />
        <!--<link href="{{ asset('wbdlibs/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>-->
        <!--<link href="{{ asset('wbdlibs/css/owl.carousel.css') }}" rel="stylesheet" type="text/css">-->
        <!-- Custom styles for this template -->
        <link href="{{ asset('wbdlibs/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('wbdlibs/css/style-responsive.css') }}" rel="stylesheet" />
        <link href="{{ asset('wbdlibs/css/bootstrap-multiselect.css') }}" rel="stylesheet" />
        <!--<link href="{{ asset('/resources/demos/style.css') }}" rel="stylesheet" />-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="{{ asset('wbdlibs/js/html5shiv.js') }}"></script>
          <script src="{{ asset('wbdlibs/js/respond.min.js') }}"></script>
        <![endif]-->
    </head>

    <body>
        <section id="container" >
            <!--<div class="row">-->

            <!--</div>-->
            <!--header start-->
            <header class="header white-bg" style="padding: 0 0;">
                <div class="col-lg-12 hidden-sm" style="background: #033; color: #fff; padding: 2px; font-weight: bold;">
                    <span style="padding-left: 15px;">{{ Session::get('usrInfo')->sclnme }}</span>
                    <span class="pull-right" style="padding-right: 15px;">Expire Date : {{ Session::get('usrInfo')->expdte }}</span>
                </div>
                <div class="sidebar-toggle-box" style="margin-left: 15px;">
                    <div data-original-title="Hide/Show Left Menu" data-placement="right" class="icon-reorder tooltips"></div>
                </div>
                <!--logo start-->
                <a href="{{ url('/') }}" class="logo">WBDS<span>chools</span></a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">
                        <!-- settings start -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-tasks"></i>
                                <span class="badge bg-success">6</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <div class="notify-arrow notify-arrow-green"></div>
                                <li>
                                    <p class="green">You have 6 pending tasks</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Dashboard v1.3</div>
                                            <div class="percent">40%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Database Update</div>
                                            <div class="percent">60%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Iphone Development</div>
                                            <div class="percent">87%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                                <span class="sr-only">87% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Mobile App</div>
                                            <div class="percent">33%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
                                                <span class="sr-only">33% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Dashboard v1.3</div>
                                            <div class="percent">45%</div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                <span class="sr-only">45% Complete</span>
                                            </div>
                                        </div>

                                    </a>
                                </li>
                                <li class="external">
                                    <a href="#">See All Tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- settings end -->
                        <!-- inbox dropdown start-->
                        <li id="header_inbox_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-envelope-alt"></i>
                                <span class="badge bg-important">5</span>
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <div class="notify-arrow notify-arrow-red"></div>
                                <li>
                                    <p class="red">You have 5 new messages</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="{{ asset('wbdlibs/img/avatar-mini.jpg') }}"></span>
                                        <span class="subject">
                                            <span class="from">Jonathan Smith</span>
                                            <span class="time">Just now</span>
                                        </span>
                                        <span class="message">
                                            Hello, this is an example msg.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="{{ asset('wbdlibs/img/avatar-mini2.jpg') }}"></span>
                                        <span class="subject">
                                            <span class="from">Jhon Doe</span>
                                            <span class="time">10 mins</span>
                                        </span>
                                        <span class="message">
                                            Hi, Jhon Doe Bhai how are you ?
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="{{ asset('wbdlibs/img/avatar-mini3.jpg') }}"></span>
                                        <span class="subject">
                                            <span class="from">Jason Stathum</span>
                                            <span class="time">3 hrs</span>
                                        </span>
                                        <span class="message">
                                            This is awesome dashboard.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="{{ asset('wbdlibs/img/avatar-mini4.jpg') }}"></span>
                                        <span class="subject">
                                            <span class="from">Jondi Rose</span>
                                            <span class="time">Just now</span>
                                        </span>
                                        <span class="message">
                                            Hello, this is metrolab
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">See all messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- inbox dropdown end -->
                        <!-- notification dropdown start-->
                        <li id="header_notification_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <i class="icon-bell-alt"></i>
                                <span class="badge bg-warning">7</span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <div class="notify-arrow notify-arrow-yellow"></div>
                                <li>
                                    <p class="yellow">You have 7 new notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-danger"><i class="icon-bolt"></i></span>
                                        Server #3 overloaded.
                                        <span class="small italic">34 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-warning"><i class="icon-bell"></i></span>
                                        Server #10 not respoding.
                                        <span class="small italic">1 Hours</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-danger"><i class="icon-bolt"></i></span>
                                        Database overloaded 24%.
                                        <span class="small italic">4 hrs</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-success"><i class="icon-plus"></i></span>
                                        New user registered.
                                        <span class="small italic">Just now</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-info"><i class="icon-bullhorn"></i></span>
                                        Application error.
                                        <span class="small italic">10 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">See all notifications</a>
                                </li>
                            </ul>
                        </li>
                        <!-- notification dropdown end -->
                    </ul>
                    <!--  notification end -->
                </div>
                <div class="top-nav" style="margin-right: 15px;">
                    <!--search & user info start-->
                    <ul class="nav pull-right top-menu">
                        <li>
                            <input type="text" class="form-control search" placeholder="Search">
                        </li>
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="{{ asset('wbdlibs/img/avatar1_small.jpg') }}">
                                <span class="username">{{ Session::get('usrInfo')->usrnme }}</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li><a href="profile"><i class=" icon-suitcase"></i>Profile</a></li>
                                <li><a href="{{ url('/settings') }}"><i class="icon-cog"></i> Settings</a></li>
                                <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="icon-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!--search & user info end-->
                </div>
            </header>
            <!--header end-->
            @yield('leftmenu')
            @yield('content')
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2018 &copy; WBDSchool-Abdullah Al Mamun And Ruhul Amin.
                    <a href="#" class="go-top">
                        <i class="icon-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>
        <!-- js placed at the end of the document so the pages load faster -->
        <!--<script src="{{ asset('wbdlibs/js/jquery.js') }}"></script>-->
        <!--<script src="{{ asset('wbdlibs/js/jquery-1.8.3.min.js') }}"></script>-->
        <!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
        <script type="text/javascript" src="{{ asset('wbdlibs/js/jquery-1.12.4.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/js/bootstrap.min.js') }}"></script>
        <script class="include" type="text/javascript" src="{{ asset('wbdlibs/js/jquery.dcjqaccordion.2.7.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/js/jquery.scrollTo.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/js/jquery.nicescroll.js') }}"></script>
        <!--<script src="{{ asset('wbdlibs/js/jquery.sparkline.js') }}" type="text/javascript"></script>-->
        <!--<script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>-->
        <!--<script src="{{ asset('wbdlibs/js/owl.carousel.js') }}" ></script>-->
        <!--<script src="{{ asset('wbdlibs/js/jquery.customSelect.min.js') }}" ></script>-->
        <script type="text/javascript" src="{{ asset('wbdlibs/js/respond.min.js') }}" ></script>

        <!--Date timepicker--> 
        <script type="text/javascript" src="{{ asset('wbdlibs/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/assets/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>

        <!--common script for all pages-->
        <script type="text/javascript" src="{{ asset('wbdlibs/js/common-scripts.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/js/advanced-form-components.js') }}"></script>

        <!--script for this page-->
        <!--<script src="{{ asset('wbdlibs/js/sparkline-chart.js') }}"></script>-->
    <!--<script src="{{ asset('wbdlibs/js/easy-pie-chart.js') }}"></script>-->
        <script type="text/javascript" src="{{ asset('wbdlibs/js/count.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/js/bootstrap-multiselect.js') }}"></script>
        <script type="text/javascript" src="{{ asset('wbdlibs/ajax/ajax.js') }}"></script>
        <script type="text/javascript">
$(function () {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
        </script>
        @yield('customjs')
        <script type="text/javascript" src="{{ asset('wbdlibs/ajax/ajaxValidation.js') }}"></script>
    </body>
</html>
