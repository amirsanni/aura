<?php
defined('BASEPATH') OR exit('');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Design Aura: Connecting the dots:Home</title>

        <!--favicon--->
        <link href="favicon.ico" type="image/x-icon" rel="icon">
        <link href="favicon.ico" type="image/x-icon" rel="shortcut icon">
        
        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/homestyle.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/font-awesome.min.css">
        
        <!--JS-->
        <script src="<?=base_url()?>public/js/jquery.min.js"></script>

        <!-- Web Fonts -->        
        <link href='http://fonts.googleapis.com/css?family=Raleway:600,500,300,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>      

    </head>
    
    <body > 
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
        <!-- End Preloader-->

        <div class="container preview">
            <div class="row text-center">    	
                <!--    <h1>Design Aura</h1>   -->
                <div class="col-md-8 col-md-offset-2">
                <!--   <p style="color: #fff;">CONNECTING THE DOTS.</p>  -->
                </div>
            </div>
        </div>
        <div style="position: absolute; bottom: 410px; margin-left:515px; margin-right:200px; ">
            <img src="<?=base_url()?>public/images/background/logomed.png" alt="" />
        </div> 
        <div  style="position: relative; text-align: center; margin-top : 45%; ">
            <!--style="bottom : 0px; margin-top : 450px; margin-left:630px; margin-right:650px; text-align: center;"-->
            <a href="<?=base_url()?>projects">
                <img src="<?=base_url()?>public/images/discover.png" alt="Enter">
            </a>   
        </div>  


        <script src="<?=base_url()?>public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>public/js/app.js"></script>
        <script src="<?=base_url()?>public/js/home.js"></script>
        <script src="<?=base_url()?>public/js/jquery.mmenu.min.js"></script>
        <script src="<?=base_url()?>public/js/jquery.sticky.js"></script>
        <script src="<?=base_url()?>public/js/moderniz.js"></script>
    </body>
</html>