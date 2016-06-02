<!DOCTYPE html>
<html class=" ">
    <head>
        @include('backend::includes.header')
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class=" "><!-- START TOPBAR -->
        <div class='page-topbar '>
            <div class='logo-area'>

            </div>

            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                </div>    

                <div class='pull-right'>
                    <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="{{ $assetURL }}images/avatar.png" alt="user-image" class="img-circle img-inline">
                                <span><?php echo Session::get('admin_fullname')?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="<?php echo url('admin/permissions/edit/'.Session::get("admin_user_id"));?>">
                                        <i class="fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#help">
                                        <i class="fa fa-info"></i>
                                        Help
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="<?php echo url('admin/logout');?>">
                                        <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>     
                </div>    
            </div>

        </div>
        <!-- END TOPBAR -->
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <!-- SIDEBAR - START -->
            <div class="page-sidebar ">


                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="<?php echo url('admin/permissions/lists');?>">
                                <img src="{{ $assetURL }}images/avatar.png" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3>
                                <a href="<?php echo url('admin/permissions/lists')?>"><?php echo Session::get('admin_fullname')?></a>

                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>

                            <p class="profile-title"><?php echo Session::get('admin_username')?></p>

                        </div>

                    </div>
                    <!-- USER INFO - END -->



                    <ul class='wraplist'> 

                        {!! Nhiepphong\Backend\Http\Controllers\ModuleController::menu() !!}
                        
                    </ul>

                </div>
                <!-- MAIN MENU - END -->
            </div>
            <!--  SIDEBAR - END -->

            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper" style='margin-top:60px;display:inline-block;width:100%;padding:15px 15px 0 15px;'>
                    @yield('content')
                    <div class="clearfix"></div>
                </section>
            </section>
            <!-- END CONTENT -->  

        </div>
        <!-- END CONTAINER -->

        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
        @include('backend::includes.footer')
        
    </body>
</html>
