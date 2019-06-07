<!--<!doctype html>-->
<html class="no-js" lang="en">
   <?php    if (isset($this->session->userdata['logged_in'])) {        
      header("location: ". base_url()."admin/dashboard");    
      
      }    
      ?>    
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Login | Orient</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- favicon                        ============================================ -->        
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>includes/img/favicon.ico">
      <!-- Google Fonts                        ============================================ -->        
      <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
      <!-- Bootstrap CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/bootstrap.min.css">
      <!-- Bootstrap CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
      <!-- owl.carousel CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/owl.carousel.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/owl.theme.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/owl.transitions.css">
      <!-- animate CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/animate.css">
      <!-- normalize CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/normalize.css">
      <!-- main CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/main.css">
      <!-- morrisjs CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/morrisjs/morris.css">
      <!-- mCustomScrollbar CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/scrollbar/jquery.mCustomScrollbar.min.css">
      <!-- metisMenu CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/metisMenu/metisMenu.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/metisMenu/metisMenu-vertical.css">
      <!-- calendar CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/calendar/fullcalendar.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/calendar/fullcalendar.print.min.css">
      <!-- forms CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/form/all-type-forms.css">
      <!-- style CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/style.css">
      <!-- responsive CSS                        ============================================ -->        
      <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/responsive.css">
      <!-- modernizr JS                        ============================================ -->        
      <script src="js/vendor/modernizr-2.8.3.min.js"></script>    
   </head>
   <body>
      <!--[if lt IE 8]>                        
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->        
      <div class="error-pagewrap">
         <div class="error-page-int">
            <div class="text-center m-b-md custom-login">
               <h3>PLEASE LOGIN TO APP</h3>
               <p>This is the best app ever!</p>
            </div>
            <div class="content-error">
               <div class="hpanel">
                  <div class="panel-body">
                     <!--<form action="" id="loginForm" method="POST">-->
                            <?php
                            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'loginForm', 'method' => 'POST');
                            echo form_open_multipart('admin/login/user_login_process', $attributes);
                            if (isset($logout_message)) {
                                echo "<div class='message'>";
                                echo $logout_message;
                                echo "</div>";
                                }
                                echo "<div class='error_msg'>";
                                if (isset($error_message)) {
                                    echo $error_message;
                                    }
                                    echo validation_errors();
                                    echo "</div>";
                                    ?> 
                     
                     <div class="form-group">
                         <label class="control-label" for="username">Username</label>
                         <input type="text" placeholder="example@gmail.com" title="Please enter you email"  value="" name="email" id="username" class="form-control">
                         <span class="help-block small">Your unique email to app</span>
                     </div>
                     
                     <div class="form-group">
                         <label class="control-label" for="password">Password</label>
                         <input type="password" title="Please enter your password" placeholder="******"  value="" name="password" id="password" class="form-control">
                         <span class="help-block small">Your strong password</span>
                     </div>
                     
                     <!--                            
                     <div class="checkbox login-checkbox">
                     <label>
                     <input type="checkbox" class="i-checks"> Remember me </label>
                     <p class="help-block small">(if this is a private computer)</p>
                     </div>-->                           
                     <button class="btn btn-success btn-block loginbtn">Login</button>
                     <!--<a class="btn btn-default btn-block" href="<?php echo base_url() ?>admin/login/user_registration_show">Register</a>-->
                            <?php echo form_close(); ?>
                     
                  </div>
               </div>
            </div>
            <div class="text-center login-footer">
               <p>Copyright ©<?php echo date('Y'); ?> . All rights reserved. Developed by <a href="http://beasli.com">BeAsli</a></p>
            </div>
         </div>
      </div>
      <!-- jquery                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/vendor/jquery-1.12.4.min.js"></script>        
      <!-- bootstrap JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/bootstrap.min.js"></script>        
      <!-- wow JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/wow.min.js"></script>        
      <!-- price-slider JS                        ============================================ -->       
      <script src="<?php echo base_url() ?>includes/js/jquery-price-slider.js"></script>        
      <!-- meanmenu JS                        ============================================ -->       
      <script src="<?php echo base_url() ?>includes/js/jquery.meanmenu.js"></script>        
      <!-- owl.carousel JS                        ============================================ -->       
      <script src="<?php echo base_url() ?>includes/js/owl.carousel.min.js"></script>       
      <!-- sticky JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/jquery.sticky.js"></script>        
      <!-- scrollUp JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/jquery.scrollUp.min.js"></script>        
      <!-- mCustomScrollbar JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>        
      <script src="<?php echo base_url() ?>includes/js/scrollbar/mCustomScrollbar-active.js"></script>        
      <!-- metisMenu JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/metisMenu/metisMenu.min.js"></script>        
      <script src="<?php echo base_url() ?>includes/js/metisMenu/metisMenu-active.js"></script>       
      <!-- tab JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/tab.js"></script>       
      <!-- icheck JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/icheck/icheck.min.js"></script>        
      <script src="<?php echo base_url() ?>includes/js/icheck/icheck-active.js"></script>       
      <!-- plugins JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/plugins.js"></script>        
      <!-- main JS                        ============================================ -->        
      <script src="<?php echo base_url() ?>includes/js/main.js"></script>       
      <!-- tawk chat JS                        ============================================ -->        
      <!--<script src="<?php echo base_url() ?>includes/js/tawk-chat.js"></script>-->    
   </body>
</html>