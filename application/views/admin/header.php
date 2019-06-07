<!doctype html>
<html class="no-js" lang="zxx">

    <?php
    if (isset($this->session->userdata['logged_in'])) {
        $name = ($this->session->userdata['logged_in']['name']);
        $email = ($this->session->userdata['logged_in']['email']);
    } else {
        header("location: ". base_url()."admin/login");
    }
    ?> 

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Orient</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon
                    ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('includes/img/favicon.ico'); ?>">
        <!-- Google Fonts
                    ============================================ -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
        <!-- Bootstrap CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/bootstrap.min.css'); ?>">
        <!-- Bootstrap CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/font-awesome.min.css'); ?>">
        <!-- owl.carousel CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/owl.carousel.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/css/owl.theme.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/css/owl.transitions.css'); ?>">
        <!-- animate CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/animate.css'); ?>">
        <!-- normalize CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/normalize.css'); ?>">
        <!-- meanmenu icon CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/meanmenu.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/css/summernote/summernote.css'); ?>">

        <!-- main CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/main.css'); ?>">
        <!-- educate icon CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/educate-custon-icon.css'); ?>">
        <!-- morrisjs CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/morrisjs/morris.css'); ?>">
        <!-- mCustomScrollbar CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/scrollbar/jquery.mCustomScrollbar.min.css'); ?>">
        <!-- metisMenu CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/metisMenu/metisMenu.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/css/metisMenu/metisMenu-vertical.css'); ?>">
        <!-- calendar CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/calendar/fullcalendar.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/css/calendar/fullcalendar.print.min.css'); ?>">
        <!-- style CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/style.css'); ?>">
        <!-- responsive CSS
                    ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('includes/css/responsive.css'); ?>">

        <!-- chosen CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('includes/css/chosen/bootstrap-chosen.css'); ?>">
    <!-- select2 CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('includes/css/select2/select2.min.css'); ?>">
        
        <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
        <!-- modernizr JS

                    ============================================ -->
        <script src="<?php echo base_url('includes/js/vendor/modernizr-2.8.3.min.js'); ?>"></script>
    </head>

    <body>
        <!--[if lt IE 8]>
                    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <!-- Start Left menu area -->
        <div class="left-sidebar-pro">
            <nav id="sidebar" class="">
                <div class="sidebar-header">
                    <a href="index.html"><img  width="100" class="main-logo" src="<?php echo base_url(); ?>includes/img/logo/logo.png" alt="" /></a>
                    <strong><a href="index.html"><img width="70" src="<?php echo base_url(); ?>includes/img/logo/logo.png" alt="" /></a></strong>
                </div>
                <div class="left-custom-menu-adp-wrap comment-scrollbar">
                    <nav class="sidebar-nav left-sidebar-menu-pro">
                        <ul class="metismenu" id="menu1" style="background-color: #000;">
                            <li class="active">
                                <a class="has-arrow" href="index.html">
                                    <!--<span class="educate-icon educate-home icon-wrap"></span>-->
                                    <span class="mini-click-non">Banner</span>
                                </a>
                                <ul class="submenu-angle" aria-expanded="true">
                                    <li><a title="Add Banner" href="<?php echo base_url() ?>admin/banner/add_banner"><span class="mini-sub-pro">Add Banner</span></a></li>
                                    <li><a title="Manage Banner" href="<?php echo base_url() ?>admin/banner"><span class="mini-sub-pro">Manage Banner</span></a></li>
                                </ul>
                            </li>
                            <!--                            <li>
                                                            <a title="Landing Page" href="events.html" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Event</span></a>
                                                        </li>-->
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-professor icon-wrap"></span>-->
                                    <span class="mini-click-non">Event</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Add Event" href="<?php echo base_url() ?>admin/event/add_event"><span class="mini-sub-pro">Add Event</span></a></li>
                                    <li><a title="Manage Event" href="<?php echo base_url() ?>admin/event/"><span class="mini-sub-pro">Manage Event</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-professor icon-wrap"></span>-->
                                    <span class="mini-click-non">Hierarchy Management</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <!-- <li><a title="Add Zone" href="<?php echo base_url() ?>admin/zone/add_zone"><span class="mini-sub-pro">Add Zone</span></a></li> -->
                                    <li><a title="Manage Zone" href="<?php echo base_url() ?>admin/zone/"><span class="mini-sub-pro">Manage Zone</span></a></li>
<!-- 
                                    <li><a title="Add State Head" href="<?php echo base_url() ?>admin/state_head/add_state"><span class="mini-sub-pro">Add State Head</span></a></li>
                                    <li><a title="Manage State Head" href="<?php echo base_url() ?>admin/state_head/"><span class="mini-sub-pro">Manage State Head</span></a></li>

                                    <li><a title="Add Area Manager" href="<?php echo base_url() ?>admin/area_manager/add_am"><span class="mini-sub-pro">Add Area Manager</span></a></li>
                                    <li><a title="Manage Area Manager" href="<?php echo base_url() ?>admin/area_manager/"><span class="mini-sub-pro">Manage Area Manager</span></a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-student icon-wrap"></span>--> 
                                    <span class="mini-click-non">News Notification</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Send News Notification" href="<?php echo base_url() ?>admin/notification/"><span class="mini-sub-pro">Send News Notification</span></a></li>
                                    <!--<li><a title="Manage News Notification" href="#"><span class="mini-sub-pro">Manage News Notification</span></a></li>-->
                                </ul>
                            </li>
                            <!-- <li>
                                <a class="has-arrow" href="#" aria-expanded="false"> -->
                                    <!--<span class="educate-icon educate-course icon-wrap"></span>--> 
                                    <!-- <span class="mini-click-non">User</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Add User" href="#"><span class="mini-sub-pro">Add User</span></a></li>
                                    <li><a title="Manage User" href="#"><span class="mini-sub-pro">Manage User</span></a></li>
                                </ul>
                            </li> -->
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-course icon-wrap"></span>--> 
                                    <span class="mini-click-non">Category</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Add Category" href="<?php echo base_url() ?>admin/category/add_category/0"><span class="mini-sub-pro">Add Category</span></a></li>
                                    <li><a title="Manage Category" href="<?php echo base_url() ?>admin/category/index/0/0"><span class="mini-sub-pro">Manage Category</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-course icon-wrap"></span>--> 
                                    <span class="mini-click-non">Product</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Add Product" href="<?php echo base_url() ?>admin/product/add_product"><span class="mini-sub-pro">Add Product</span></a></li>
                                    <li><a title="Manage Product" href="<?php echo base_url() ?>admin/product"><span class="mini-sub-pro">Manage Product</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-course icon-wrap"></span>--> 
                                    <span class="mini-click-non">Order</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <!--<li><a title="Add Order" href="#"><span class="mini-sub-pro">Add Order</span></a></li>-->
                                    <li><a title="Manage Order" href="#"><span class="mini-sub-pro">Manage Order & History</span></a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a class="has-arrow" href="#" aria-expanded="false"> -->
                                    <!--<span class="educate-icon educate-course icon-wrap"></span>--> 
                                   <!--  <span class="mini-click-non">Team</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Add State Head" href="<?php echo base_url() ?>admin/state_head/add_state"><span class="mini-sub-pro">Add State Head</span></a></li>
                                    <li><a title="Manage Team" href="<?php echo base_url() ?>admin/state_head/"><span class="mini-sub-pro">Manage Team</span></a></li>
                                </ul>
                            </li> -->
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-course icon-wrap"></span>--> 
                                    <span class="mini-click-non">About Us</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Manage About Us" href="<?php echo base_url() ?>admin/aboutus/"><span class="mini-sub-pro">Manage About Us</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <!--<span class="educate-icon educate-course icon-wrap"></span>--> 
                                    <span class="mini-click-non">Contact Us</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Manage Contact Us"  href="<?php echo base_url() ?>admin/contactus/"><span class="mini-sub-pro">Manage Contact Us</span></a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- End Left menu area -->
        <!-- Start Welcome area -->
        <div class="all-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="logo-pro">
                            <a href="<?php echo base_url(); ?>dashboard"><img width="100" class="main-logo" src="<?php echo base_url(); ?>includes/img/logo/logo.png" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-advance-area">
                <div class="header-top-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header-top-wraper">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                            <div class="menu-switcher-pro">
                                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="educate-icon educate-nav"></i>
                                                </button>
                                            </div>
                                        </div
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 pull-right">
                                            <div class="header-right-info">
                                                <ul class="nav navbar-nav mai-top-nav header-right-menu">

                                                    <li class="nav-item">
                                                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <img src="<?php echo base_url(); ?>includes/img/product/pro4.jpg" alt="" />
                                                            <span class="admin-name"><?php echo $name; ?></span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                        <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
<!--                                                            <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic"></span>My Account</a>
                                                            </li>
                                                            <li><a href="#"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                                                            </li>
                                                            <li><a href="#"><span class="edu-icon edu-money author-log-ic"></span>User Billing</a>
                                                            </li>
                                                            <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                                                            </li>-->
                                                            <li><a href="<?php echo base_url() ?>admin/login/logout"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu start -->
                <div class="mobile-menu-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="mobile-menu">
                                    <nav id="dropdown">
                                        <ul class="mobile-menu-nav">
                                            <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul class="collapse dropdown-header-top">
                                                    <li><a href="index.html">Dashboard v.1</a></li>
                                                    <li><a href="index-1.html">Dashboard v.2</a></li>
                                                    <li><a href="index-3.html">Dashboard v.3</a></li>
                                                    <li><a href="analytics.html">Analytics</a></li>
                                                    <li><a href="widgets.html">Widgets</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="events.html">Event</a></li>
                                            <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="demoevent" class="collapse dropdown-header-top">
                                                    <li><a href="all-professors.html">All Professors</a>
                                                    </li>
                                                    <li><a href="add-professor.html">Add Professor</a>
                                                    </li>
                                                    <li><a href="edit-professor.html">Edit Professor</a>
                                                    </li>
                                                    <li><a href="professor-profile.html">Professor Profile</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#demopro" href="#">Students <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="demopro" class="collapse dropdown-header-top">
                                                    <li><a href="all-students.html">All Students</a>
                                                    </li>
                                                    <li><a href="add-student.html">Add Student</a>
                                                    </li>
                                                    <li><a href="edit-student.html">Edit Student</a>
                                                    </li>
                                                    <li><a href="student-profile.html">Student Profile</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#democrou" href="#">Courses <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="democrou" class="collapse dropdown-header-top">
                                                    <li><a href="all-courses.html">All Courses</a>
                                                    </li>
                                                    <li><a href="add-course.html">Add Course</a>
                                                    </li>
                                                    <li><a href="edit-course.html">Edit Course</a>
                                                    </li>
                                                    <li><a href="course-profile.html">Courses Info</a>
                                                    </li>
                                                    <li><a href="course-payment.html">Courses Payment</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#demolibra" href="#">Library <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="demolibra" class="collapse dropdown-header-top">
                                                    <li><a href="library-assets.html">Library Assets</a>
                                                    </li>
                                                    <li><a href="add-library-assets.html">Add Library Asset</a>
                                                    </li>
                                                    <li><a href="edit-library-assets.html">Edit Library Asset</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#demodepart" href="#">Departments <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="demodepart" class="collapse dropdown-header-top">
                                                    <li><a href="departments.html">Departments List</a>
                                                    </li>
                                                    <li><a href="add-department.html">Add Departments</a>
                                                    </li>
                                                    <li><a href="edit-department.html">Edit Departments</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#demomi" href="#">Mailbox <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="demomi" class="collapse dropdown-header-top">
                                                    <li><a href="mailbox.html">Inbox</a>
                                                    </li>
                                                    <li><a href="mailbox-view.html">View Mail</a>
                                                    </li>
                                                    <li><a href="mailbox-compose.html">Compose Mail</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">Interface <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                                    <li><a href="google-map.html">Google Map</a>
                                                    </li>
                                                    <li><a href="data-maps.html">Data Maps</a>
                                                    </li>
                                                    <li><a href="pdf-viewer.html">Pdf Viewer</a>
                                                    </li>
                                                    <li><a href="x-editable.html">X-Editable</a>
                                                    </li>
                                                    <li><a href="code-editor.html">Code Editor</a>
                                                    </li>
                                                    <li><a href="tree-view.html">Tree View</a>
                                                    </li>
                                                    <li><a href="preloader.html">Preloader</a>
                                                    </li>
                                                    <li><a href="images-cropper.html">Images Cropper</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#Chartsmob" href="#">Charts <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="Chartsmob" class="collapse dropdown-header-top">
                                                    <li><a href="bar-charts.html">Bar Charts</a>
                                                    </li>
                                                    <li><a href="line-charts.html">Line Charts</a>
                                                    </li>
                                                    <li><a href="area-charts.html">Area Charts</a>
                                                    </li>
                                                    <li><a href="rounded-chart.html">Rounded Charts</a>
                                                    </li>
                                                    <li><a href="c3.html">C3 Charts</a>
                                                    </li>
                                                    <li><a href="sparkline.html">Sparkline Charts</a>
                                                    </li>
                                                    <li><a href="peity.html">Peity Charts</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#Tablesmob" href="#">Tables <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="Tablesmob" class="collapse dropdown-header-top">
                                                    <li><a href="static-table.html">Static Table</a>
                                                    </li>
                                                    <li><a href="data-table.html">Data Table</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#formsmob" href="#">Forms <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="formsmob" class="collapse dropdown-header-top">
                                                    <li><a href="basic-form-element.html">Basic Form Elements</a>
                                                    </li>
                                                    <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                                    </li>
                                                    <li><a href="password-meter.html">Password Meter</a>
                                                    </li>
                                                    <li><a href="multi-upload.html">Multi Upload</a>
                                                    </li>
                                                    <li><a href="tinymc.html">Text Editor</a>
                                                    </li>
                                                    <li><a href="dual-list-box.html">Dual List Box</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#Appviewsmob" href="#">App views <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="Appviewsmob" class="collapse dropdown-header-top">
                                                    <li><a href="basic-form-element.html">Basic Form Elements</a>
                                                    </li>
                                                    <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                                    </li>
                                                    <li><a href="password-meter.html">Password Meter</a>
                                                    </li>
                                                    <li><a href="multi-upload.html">Multi Upload</a>
                                                    </li>
                                                    <li><a href="tinymc.html">Text Editor</a>
                                                    </li>
                                                    <li><a href="dual-list-box.html">Dual List Box</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                                <ul id="Pagemob" class="collapse dropdown-header-top">
                                                    <li><a href="login.html">Login</a>
                                                    </li>
                                                    <li><a href="register.html">Register</a>
                                                    </li>
                                                    <li><a href="lock.html">Lock</a>
                                                    </li>
                                                    <li><a href="password-recovery.html">Password Recovery</a>
                                                    </li>
                                                    <li><a href="404.html">404 Page</a></li>
                                                    <li><a href="500.html">500 Page</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu end -->
