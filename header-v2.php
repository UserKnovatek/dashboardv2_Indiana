<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
      <!-- Google Font: Source Sans Pro -->
      <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">-->
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
     
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/dist/css/adminlte.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
       <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/dashboardv2/dist/new_style.css"> 
      <!-- cdn Link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
       <?php wp_head();?>

          <!-- extra admin css plugin -->
           <!-- Daterange picker -->
       <!-- <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/daterangepicker/daterangepicker.css"> -->
        <!-- summernote -->
        <!-- <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/summernote/summernote-bs4.min.css">  -->
       <!-- JQVMap -->
       <!-- <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/jqvmap/jqvmap.min.css"> -->
   <!-- iCheck -->
   <!-- <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
   
      </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
    
      <?php 
        $directoryURI = $_SERVER['REQUEST_URI'];
        $path = parse_url($directoryURI, PHP_URL_PATH);
        $components = explode('dashboard/', $path);
        $first_part = $components[1];
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    ?>

     
        <!-- Navbar -->
      <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background:#ecbf55;">
         <div class="container">
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
               <!-- Left navbar links -->
               <ul class="navbar-nav">
                  <!---li class="nav-item">
                     <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                     </li------>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/about/" class="nav-link">About us</a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/volunteer/" class="nav-link">Volutner</a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/donation/" class="nav-link">Donate</a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/contact-us/" class="nav-link">Contact us</a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/virtual-ballot/" class="nav-link">Virtual Ballot</a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/logout/" class="nav-link">Logout</a>
                  </li>
               </ul>
               <!-- SEARCH FORM -->
            </div>
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
               <!-- Messages Dropdown Menu -->
               <!-- Notifications Dropdown Menu -->
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa fa-bars"></i></a>
               </li>
            </ul>
         </div>
      </nav>
   
   
     <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <!-- Brand Logo -->
         <a href="<?php echo home_url();?>" class="brand-link">
         <img src="https://dev.indianacitizen.org/wp-content/uploads/2022/06/logo_v2.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light" style="font-size: 16px;">THE INDIANA CITIZEN</span>
         </a>
         <!-- Sidebar -->
         <div class="sidebar" style="background:#ecbf55;">
            <!-- Sidebar user panel (optional) -->
            <!-- SidebarSearch Form -->
            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                     <a href="<?php echo get_home_url();?>/dashboard/my-representative"class="nav-link">
                        <p style="color:black;">
                           <i class="nav-icon fas fa fa-tachometer"></i>
                           MY Representatives 
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/dashboard/following" class="nav-link">
                        <p style="color:black;">
                           <i class="nav-icon fas fa fa-thumbs-up"></i>
                           Following
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/dashboard/track-legislation" class="nav-link">
                        <p style="color:black;">
                           <i class="nav-icon fas fa fa-table"></i>
                           Track legislation
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo get_home_url();?>/dashboard/newsfeed" class="nav-link">
                        <p style="color:black;">
                           <i class="nav-icon fas fa fa-rss"></i>
                           Newsfeed
                        </p>
                     </a>
                  </li>
               </ul>
            </nav>
      
               
            <div class="instruc">
						<?php 
						         if($path == '/dashboard/')
								{
									echo '<p class="ptext">You can view your representatives by selecting your voting district. If you don’t know your voting district, try typing your address into the search field</p>'; 
								}
						           if($first_part == 'my-representative/')
								{
									echo '<p class="ptext">You can view your representatives by selecting your voting district. If you don’t know your voting district, try typing your address into the search field</p>'; 
								}
						            if($first_part == 'newsfeed/')
								{
									echo '<p class="ptext">Create a newsfeed tailored to your interests by selecting the topics you’d like to read.</p>'; 
								}
						        if($first_part == 'following/')
								{
									echo '<p class="ptext">following data-> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s</p>'; 
								}
                              
						        if($first_part == 'track-legislation/')
								{
									echo '<p class="ptext">Here are the proposed new laws your representatives are considering. You can add bills to your Following page by clicking on the follow button</p>'; 
								}
						?>
					


            </div>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>
      
      <!-- php header close -->
      