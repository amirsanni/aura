<?php
defined('BASEPATH') OR exit('');
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title><?=$pageTitle?></title>    

        <!-- Web Fonts -->        
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway:600,500,300,400">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700">
        
        <!--favicon--->
        <link href="favicon.ico" type="image/x-icon" rel="icon">
        <link href="favicon.ico" type="image/x-icon" rel="shortcut icon">
        
        <!---CSS-->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/revolution/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/extralayers.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/revolution/rs-plugin/css/settings.css">
        <link rel="owl.theme"  type="text/css" href="<?=base_url()?>public/css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/cubeportfolio.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/jquery.mmenu.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/videostyle.css">
        
        <!---JS--->
        <script src="<?=base_url()?>public/js/jquery-1.11.1.min.js"></script>
    </head>
    <body> 

        <!--Start Preloader-->
        <div id="preloader">
            <div class="preloader-container">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>
        <!--End Preloader-->

        <video id="bgVideo" poster="<?=base_url()?>public/images/bgVideo.png" preload="auto" autoplay="autoplay" loop="loop" muted >
            <!-- Video is embedded in the WEBM format
            <source src="..\img\bgVideo.webm" type="video/webm"> -->
            <video src="<?=base_url()?>public/files/bgmovie.mp4"></video>
        </video>

        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-fixed-top header-nav" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <!-- Logo -->        
                    <a class="navbar-brand" href="<?=base_url()?>">Design Aura</a>      
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<?=$curPage == 'blog' ? 'active' : ''?>">
                            <a href="<?=site_url('blog')?>">Blog</a>
                        </li>
                        <li class="<?=$curPage == 'about' ? 'active' : ''?>">
                            <a href="<?=site_url('about')?>">About</a>
                        </li>                                                                            
                        <li class="<?=$curPage == 'projects' ? 'active' : ''?>">
                            <a href="<?=site_url('projects')?>">Search and Explore</a>
                        </li>                    
                        <li class="<?=$curPage == 'testimonials' ? 'active' : ''?>">
                            <a href="<?=site_url('testimonials')?>">Testimonials</a>
                        </li>                        
                        <li class="<?=$curPage == 'contact' ? 'active' : ''?>">
                            <a href="<?=site_url('contact')?>">Contact</a>
                        </li>   
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- Navbar -->


        <!--Page Content-->
        <?=$pageContent?>
        <!--Page Content ends-->

        <script src="<?=base_url()?>/public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>/public/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?=base_url()?>/public/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?=base_url()?>/public/js/jquery.cubeportfolio.min.js"></script>
        <script src="<?=base_url()?>/public/js/owl.carousel.js"></script>
        <script src="<?=base_url()?>/public/js/moderniz.js"></script>
        <script src="<?=base_url()?>/public/js/jquery.sticky.js"></script>
        <script src="<?=base_url()?>/public/js/jquery.mmenu.min.js"></script>
        <script src="<?=base_url()?>/public/js/app.js"></script>
        <script src="<?=base_url()?>/public/js/homeScript.js"></script>
        <script src="<?=base_url()?>/public/js/global.js"></script>
    </body>
</html>
