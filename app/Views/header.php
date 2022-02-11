<!DOCTYPE html>
<html>
    <head>

        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	

        <title><?php echo $title; ?></title>	

        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="Porto - Responsive HTML5 Template">
        <meta name="author" content="okler.net">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo ASSETS_FOLDER; ?>img/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="<?php echo ASSETS_FOLDER; ?>img/apple-touch-icon.png">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">



        <!-- Web Fonts  -->
        <link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>vendor/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>vendor/animate/animate.compat.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>vendor/simple-line-icons/css/simple-line-icons.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>vendor/owl.carousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>vendor/owl.carousel/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>vendor/magnific-popup/magnific-popup.min.css">

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>css/theme.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>css/theme-elements.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>css/theme-blog.css">
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>css/theme-shop.css">



        <!-- Demo CSS -->
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>css/demos/demo-seo.css">
        <!-- Skin CSS -->
        <link id="skinCSS" rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>css/skins/skin-seo.css">

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo ASSETS_FOLDER; ?>css/custom.css">

        <!-- Head Libs -->
        <script src="<?php echo ASSETS_FOLDER; ?>vendor/modernizr/modernizr.min.js"></script>

<!--        <style>
            .ourprojects{
            box-shadow: 1px 2px 12px 1px rgba(0,0,0,1);
            -webkit-box-shadow: 1px 2px 12px 1px rgba(0,0,0,1);
            -moz-box-shadow: 1px 2px 12px 1px rgba(0,0,0,1);
            }
        </style>-->
        
    </head>
    <body data-target="#header" data-spy="scroll" data-offset="100">

        <div class="body">
            <?php 
            if($title == 'HOME'){ ?>
            <header id="header" class="header-transparent header-effect-shrink appear-animation" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}" data-appear-animation="fadeIn" data-appear-animation-delay="200">
            <?php }else{ ?>
            <header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': true, 'stickyStartAt': 70, 'stickyChangeLogo': false, 'stickyHeaderContainerHeight': 70}">
            <?php } ?>
                <div class="header-body border-top-0 header-body-bottom-border">
                    <div class="header-container container">
                        <div class="header-row">
                            <div class="header-column">
                                <div class="header-row">
                                    <div class="header-logo">
                                        <a href="<?php echo base_url(); ?>">
                                            <img alt="Porto" width="180" height="75" data-sticky-width="180" data-sticky-height="75" src="<?php echo ASSETS_FOLDER; ?>img/logo-default-slim.png">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="header-column justify-content-end">
                                <div class="header-row">
                                    <div class="header-nav header-nav-links justify-content-start order-2 order-lg-1">
                                        <div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                            <nav class="collapse">
                                                <ul class="nav nav-pills" id="mainNav">
                                                    <li class="dropdown">

                                                        <a class="dropdown-item active" data-hash data-hash-offset="95" href="<?php echo base_url('aboutus'); ?>">About Us</a>

                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="dropdown-item"  data-hash data-hash-offset="95" href="<?php echo base_url('ourprojects'); ?>">Issues And Views</a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="dropdown-item"  data-hash data-hash-offset="95" href="<?php echo base_url('donateus'); ?>">How You Can Help</a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="dropdown-item"  data-hash data-hash-offset="95" href="<?php echo base_url('blogs'); ?>">Blog</a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="dropdown-item"  data-hash data-hash-offset="95" href="<?php echo base_url('contactus'); ?>">Contact Us</a>
                                                    </li>                                                  
                                                </ul>
                                            </nav>
                                        </div>
                                        <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                    </div>
                                    <a class="btn btn-primary font-weight-semibold text-3 btn-px-5 btn-py-2 order-1 order-lg-2 d-none d-md-block mr-3 mr-lg-0" data-hash data-hash-offset="65" href="#">Donate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>