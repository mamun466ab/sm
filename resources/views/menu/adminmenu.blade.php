@extend('dboardcontainer')
@section('leftmenu')
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="{{ url('/') }}">
                    <i class="icon-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li>
                <a href="index.html">
                    <i class="icon-user"></i>
                    <span>Nominal Roll</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" <?php if(isset($addTcrActive)){ echo $addTcrActive;}elseif(isset($addStdActive)){ echo $addStdActive;} ?>>
                    <i class="icon-user"></i>
                    <span>Add Member</span>
                </a>
                <ul class="sub">
                    <li <?php if(isset($addTcrActive)){ echo $addTcrActive;} ?>><a  href="{{ url('/add-teacher/') }}">Add Teacher</a></li>
                    <li <?php if(isset($addStdActive)){ echo $addStdActive;} ?>><a  href="{{ url('/add-student/') }}">Add Student</a></li>
                </ul>
            </li>
            
            <li>
                <a href="add-subject">
                    <i class="icon-book"></i>
                    <span>Add Subject</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="icon-book"></i>
                    <span>UI Elements</span>
                </a>
                <ul class="sub">
                    <li><a  href="general.html">General</a></li>
                    <li><a  href="buttons.html">Buttons</a></li>
                    <li><a  href="widget.html">Widget</a></li>
                    <li><a  href="slider.html">Slider</a></li>
                    <li><a  href="nestable.html">Nestable</a></li>
                    <li><a  href="font_awesome.html">Font Awesome</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="icon-cogs"></i>
                    <span>Components</span>
                </a>
                <ul class="sub">
                    <li><a  href="grids.html">Grids</a></li>
                    <li><a  href="calendar.html">Calendar</a></li>
                    <li><a  href="gallery.html">Gallery</a></li>
                    <li><a  href="todo_list.html">Todo List</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="icon-tasks"></i>
                    <span>Form Stuff</span>
                </a>
                <ul class="sub">
                    <li><a  href="form_component.html">Form Components</a></li>
                    <li><a  href="advanced_form_components.html">Advanced Components</a></li>
                    <li><a  href="form_wizard.html">Form Wizard</a></li>
                    <li><a  href="form_validation.html">Form Validation</a></li>
                    <li><a  href="dropzone.html">Dropzone File Upload</a></li>
                    <li><a  href="inline_editor.html">Inline Editor</a></li>
                    <li><a  href="image_cropping.html">Image Cropping</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="icon-th"></i>
                    <span>Data Tables</span>
                </a>
                <ul class="sub">
                    <li><a  href="basic_table.html">Basic Table</a></li>
                    <li><a  href="responsive_table.html">Responsive Table</a></li>
                    <li><a  href="dynamic_table.html">Dynamic Table</a></li>
                    <li><a  href="advanced_table.html">Advanced Table</a></li>
                    <li><a  href="editable_table.html">Editable Table</a></li>
                </ul>
            </li>
            <li>
                <a  href="inbox.html">
                    <i class="icon-envelope"></i>
                    <span>Mail </span>
                    <span class="label label-danger pull-right mail-info">2</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class=" icon-bar-chart"></i>
                    <span>Charts</span>
                </a>
                <ul class="sub">
                    <li><a  href="morris.html">Morris</a></li>
                    <li><a  href="chartjs.html">Chartjs</a></li>
                    <li><a  href="flot_chart.html">Flot Charts</a></li>
                    <li><a  href="xchart.html">xChart</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="icon-shopping-cart"></i>
                    <span>Shop</span>
                </a>
                <ul class="sub">
                    <li><a  href="product_list.html">List View</a></li>
                    <li><a  href="product_details.html">Details View</a></li>
                </ul>
            </li>
            <li>
                <a href="google_maps.html" >
                    <i class="icon-map-marker"></i>
                    <span>Google Maps </span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="icon-glass"></i>
                    <span>Extra</span>
                </a>
                <ul class="sub">
                    <li><a  href="blank.html">Blank Page</a></li>
                    <li><a  href="lock_screen.html">Lock Screen</a></li>
                    <li><a  href="profile.html">Profile</a></li>
                    <li><a  href="invoice.html">Invoice</a></li>
                    <li><a  href="search_result.html">Search Result</a></li>
                    <li><a  href="404.html">404 Error</a></li>
                    <li><a  href="500.html">500 Error</a></li>
                </ul>
            </li>
            <li>
                <a  href="login.html">
                    <i class="icon-user"></i>
                    <span>Login Page</span>
                </a>
            </li>

            <!--multi level menu start-->
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="icon-sitemap"></i>
                    <span>Multi level Menu</span>
                </a>
                <ul class="sub">
                    <li><a  href="javascript:;">Menu Item 1</a></li>
                    <li class="sub-menu">
                        <a  href="boxed_page.html">Menu Item 2</a>
                        <ul class="sub">
                            <li><a  href="javascript:;">Menu Item 2.1</a></li>
                            <li class="sub-menu">
                                <a  href="javascript:;">Menu Item 3</a>
                                <ul class="sub">
                                    <li><a  href="javascript:;">Menu Item 3.1</a></li>
                                    <li><a  href="javascript:;">Menu Item 3.2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!--multi level menu end-->

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
@endsection