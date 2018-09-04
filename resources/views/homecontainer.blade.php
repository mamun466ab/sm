<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>@yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('wbdlibs/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('wbdlibs/css/bootstrap-reset.css') }}" rel="stylesheet">
        <!--external css-->
        <link href="{{ asset('wbdlibs/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="{{ asset('wbdlibs/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('wbdlibs/css/style-responsive.css') }}" rel="stylesheet" />
        <script src="{{ asset('wbdlibs/ajax/ajax.js') }}"></script>
        <!-- HTML5 shim and Respond.js') }} IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="{{ asset('wbdlibs/js/html5shiv.js') }}"></script>
        <script src="{{ asset('wbdlibs/js/respond.min.js') }}"></script>
        
        
        <![endif]-->
        <style>
            .horizontal-menu ul li a{color: #fff;}
            .horizontal-menu ul li a:hover{color: #000; background: none;}
            .horizontal-menu ul li a:active{color: #000; background: none;}
            .horizontal-menu ul li a:focus{color: #000; background: none;}
        </style>
    </head>

    <body class="login-body">
        <section id="container" class="">
            <!--header start-->
            <header class="header" style="background-color: #59B2E0; font-size: 14px;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle white-bg" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!--logo start-->
                    <a href="{{URL::to('login')}}" class="logo" >WBDS<span>chools</span></a>
                    <!--logo end-->
                    <div class="horizontal-menu navbar-collapse collapse ">
                        <ul class="nav navbar-nav">
                            <li><a href="index.html">FEATURES</a></li>
                            <li><a href="{{ URL::to('/school-registration/') }}">SCHOOL REGISTRATION</a></li>
                            <li><a href="{{ URL::to('/teacher-registration/') }}">TEACHER REGISTRATION</a></li>
                            <li><a href="{{ URL::to('/student-registration/') }}">STUDENT REGISTRATION</a></li>
                            <li><a href="basic_table.html">ABOUT US</a></li>
                            <li><a href="basic_table.html">CONTACT US</a></li>
                            <li><a href="{{ URL::to('/login/') }}">LOGIN</a></li>
                            <li><a href="basic_table.html">FAQ'S</a></li>
                            <!--                            <li class="dropdown">
                                                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">Extra <b class=" icon-angle-down"></b></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="blank.html">Blank Page</a></li>
                                                                <li><a href="boxed_page.html">Boxed Page</a></li>
                                                                <li><a href="profile.html">Profile</a></li>
                                                                <li><a href="invoice.html">Invoice</a></li>
                                                                <li><a href="search_result.html">Search Result</a></li>
                                                                <li><a href="404.html">404 Error Page</a></li>
                                                                <li><a href="500.html">500 Error Page</a></li>
                                                            </ul>
                                                        </li>-->
                        </ul>

                    </div>

                </div>

            </header>


            <div class="container">

                @yield('content')

            </div>

        </section>
        <footer class="site-footer" style=" margin-top: 15px; background:none; color: #000; ">
            <div class="text-center">
                2018 &copy; WBDSchools-Abdullah Al Mamun.
                <!--              <a href="#" class="go-top">
                                  <i class="icon-angle-up"></i>
                              </a>-->
            </div>
        </footer>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{{ asset('wbdlibs/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('wbdlibs/js/bootstrap.min.js') }}"></script>

        <!-- Ajax script for form validation -->
        <script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#data_form').on('submit', function (e) {
    e.preventDefault();
    data = $(this).serialize();
    url = $(this).attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (data) {
            console.log(data);
            if ($.isEmptyObject(data.errors)) {
                console.log(data.success);
                $('#data_form')[0].reset();
                $('.text-danger').remove();
                $('.form-group').removeClass('has-error').removeClass('has-success');
                $('.print-success-msg').html(data.success);
                $('.print-success-msg').css('display', 'block');
            } else {
                printMessageErrors(data.errors);
            }
        }
    });
});

function printMessageErrors(msg) {
    $('.form-group').removeClass('has-error').find('.text-danger').remove();
    $.each(msg, function (key, value) {
        var element = $('#' + key);
        element.closest('div.form-group')
                .addClass(value.length > 0 ? 'has-error' : 'has-success');
        $('.control-label').css('color', '#797979');
        element.after('<span class="text-danger"><span class="glyphicon glyphicon-exclamation-sign text-danger"></span> ' + value + '</span>');
    });
}
        </script>
        <!-- Ajax -->

        <script type="text/javascript">
            $(document).ready(function () {
                $('#scl_nme').keyup(function () {
                    var org_name = $('#scl_nme').val();
                    var matches = org_name.match(/\b(\w)/g);
                    var org_code = matches.join('').toUpperCase();
                    $('#scl_cde').val(org_code);
                });
            });
        </script>
    </body>
</html>
