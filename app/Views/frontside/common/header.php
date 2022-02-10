<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>

        <!-- Meta Tags -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="FundPro - Nonprofit, Crowdfunding & Charity HTML5 Template" />
        <meta name="keywords" content="charity,crowdfunding,nonprofit,orphan,Poor,funding,fundrising,ngo,children" />
        <meta name="author" content="ThemeMascot" />
        <!-- Page Title -->
        <title><?php echo $title; ?></title>
        <!-- Favicon and Touch Icons -->
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>images/favicon.png" rel="shortcut icon" type="image/png">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>images/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

        <!-- Stylesheet -->
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/jquery-ui.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/animate.css" rel="stylesheet" type="text/css">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/css-plugin-collections.css" rel="stylesheet"/>
        <!-- CSS | menuzord megamenu skins -->
        <link id="menuzord-menu-skins" href="<?php echo FRONT_ASSETS_FOLDER; ?>css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
        <!-- CSS | Main style file -->
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/style-main.css" rel="stylesheet" type="text/css">
        <!-- CSS | Preloader Styles -->
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/preloader.css" rel="stylesheet" type="text/css">
        <!-- CSS | Custom Margin Padding Collection -->
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
        <!-- CSS | Responsive media queries -->
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/responsive.css" rel="stylesheet" type="text/css">
        <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
        <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

        <!-- Revolution Slider 5.x CSS settings -->
        <link  href="<?php echo FRONT_ASSETS_FOLDER; ?>js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
        <link  href="<?php echo FRONT_ASSETS_FOLDER; ?>js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
        <link  href="<?php echo FRONT_ASSETS_FOLDER; ?>js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

        <!-- CSS | Theme Color -->
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>css/colors/theme-skin-orange.css" rel="stylesheet" type="text/css">

        <!-- external javascripts -->
        <script src="<?php echo FRONT_ASSETS_FOLDER; ?>js/jquery-2.2.4.min.js"></script>
        <script src="<?php echo FRONT_ASSETS_FOLDER; ?>js/jquery-ui.min.js"></script>
        <script src="<?php echo FRONT_ASSETS_FOLDER; ?>js/bootstrap.min.js"></script>
        <!-- JS | jquery plugin collection for this theme -->
        <script src="<?php echo FRONT_ASSETS_FOLDER; ?>js/jquery-plugin-collection.js"></script>

        <!-- Revolution Slider 5.x SCRIPTS -->
        <script src="<?php echo FRONT_ASSETS_FOLDER; ?>js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?php echo FRONT_ASSETS_FOLDER; ?>js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="">
        <div id="wrapper" class="clearfix">
            <!-- preloader -->
<!--            <div id="preloader">
                <div id="spinner">
                    <div class="preloader-dot-loading">
                        <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
                    </div>
                </div>
                <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
            </div> -->

            <!-- Header -->
            <header class="header">
                <div class="header-top bg-theme-colored sm-text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="widget no-border m-0">
                                    <ul class="styled-icons icon-dark icon-theme-colored icon-sm sm-text-center">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="widget no-border m-0">
                                    <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-white"></i> <a class="text-white" href="#">123-456-789</a> </li>
                                        <li class="text-white m-0 pl-10 pr-10"> <i class="fa fa-clock-o text-white"></i> Mon-Fri 8:00 to 2:00 </li>
                                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-white"></i> <a class="text-white" href="#">contact@yourdomain.com</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="widget no-border m-0">
                                    <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                                        <li class="mt-sm-10 mb-sm-10">
                                            <!-- Modal: Appointment Starts -->
                                            <a class="btn btn-default btn-flat btn-xs bg-light p-5 font-11 pl-10 pr-10 ajaxload-popup" href="ajax-load/donation-form.html">Donate Now</a>
                                        </li> 
                                        
                                        
                                        <?php if(!isset($_SESSION['customer'])){
                                         ?>
                                            <li class="mt-sm-10 mb-sm-10">
                                                <a class="btn btn-default btn-flat btn-xs bg-light p-5 font-11 pl-10 pr-10" href="<?php echo FRONT_LOGIN_LINK; ?>">Login</a>
                                            </li>
                                        <?php
                                        }else{
                                            ?>
                                            <li class="mt-sm-10 mb-sm-10">
                                                <a class="btn btn-default btn-flat btn-xs bg-light p-5 font-11 pl-10 pr-10" href="<?php echo FRONT_LOGOUT_LINK; ?>">Logout</a>
                                            </li>
                                        <?php
                                        }?>                                                                                
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-nav">
                    <div class="header-nav-wrapper navbar-scrolltofixed bg-silver-light">
                        <div class="container">
                            <nav id="menuzord-right" class="menuzord default no-bg">
                                <a class="menuzord-brand pull-left flip" href="<?php echo BASE_URL; ?>"><img src="<?php echo FRONT_ASSETS_FOLDER; ?>images/logo-wide.png" alt=""></a>
                                <ul class="menuzord-menu">
                                    <li class="active"><a href="<?php echo BASE_URL; ?>">Home</a>
                                    </li>                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>