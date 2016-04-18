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
        <link href='http://fonts.googleapis.com/css?family=Exo:400,300,300italic,500,400italic,500italic,600,600italic,700,700italic%7CMerriweather:400,300,300italic,400italic,700,700italic%7COpen+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800%7CMontserrat:400,700%7CLibre+Baskerville:400,700' rel='stylesheet' type='text/css'>
        
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
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/main.css">
        
        <!---JS--->
        <script src="<?=base_url()?>public/js/jquery.min.js"></script>
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

        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-fixed-top header-nav" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>   
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
                        <?php if(isset($_SESSION['full_name'])): ?>
                        <li><a>Welcome <?=$_SESSION['full_name']?></a></li>
                        <?php else: ?>
                        <li class="pointer">
                            <a><button id='logInMenuClk' class='btn btn-primary btn-sm'>Log in</button></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- Navbar -->

        <!---Page Content--->
        <?=$pageContent?>
        <!---Page Content ends--->

        <!-- Footer -->
        <div id="footer">
            <div class="container">   
                <div class="row">                                                         
                    <!-- Copyright -->                                                       
                    <div class="col-sm-6 col-md-6 f-copyright">                        
                        <span>&copy; Copyright Design Aura - All Rights Reserved</span>                        
                    </div>                      
                    <div class="col-sm-6 col-md-6">
                        <!-- Social Icons -->                              
                        <ul class="footer-social">
                        <!--<li><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>  -->
                            <li>
                                <a href="http://www.facebook.com" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                            <li><a href="http://www.twitter.com" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                            <li><a href="http://www.skype.com/myskypename" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
                            <li><a href="https://www.pinterest.com/" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x fa-inverse"></i></span></a></li>
                            <li><a href="https://www.instagram.com/" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span></a></li>
                        </ul>
                    </div>
                </div><!-- /row -->
            </div><!-- /container -->
        </div>        
        <!-- End Footer -->
        
        
        <!---Signup and login Modal--->
        <div class="modal fade signLogModal" role='dialog' data-backdrop='static' id='signLogModal'>
            <div class="modal-dialog">
                <!---- Sign up div----->
                <div class="modal-content" id='signUpDiv'>
                    <div class="modal-header">
                        <button class="close" data-dismiss='modal'>&times;</button>
                        <h4 class="text-center">Sign Up</h4>
                        <div class="text-center" id='signupFMsg'></div>
                    </div>
                    <div class="modal-body">
                        <form id='signupForm' name="signupForm">
                            <div class="row">
                                <div class="col-sm-6 form-group-sm">
                                    <label for='firstName' class="control-label">First Name</label>
                                    <input type="text" id='firstName' class="form-control checkField" placeholder="First Name" autofocus>
                                    <span class="help-block errMsg" id="firstNameErr"></span>
                                </div>
                                <div class="col-sm-6 form-group-sm">
                                    <label for='lastName' class="control-label">Last Name</label>
                                    <input type="text" id='lastName' class="form-control checkField" placeholder="Last Name">
                                    <span class="help-block errMsg" id="lastNameErr"></span>
                                </div>
                            </div>
							
							
							<div class="row">
                                <div class="col-sm-6 form-group-sm">
                                    <label for='username' class="control-label">Username</label>
                                    <input type="text" id='username' class="form-control checkField" placeholder="Username">
                                    <span class="help-block errMsg" id="usernameErr"></span>
                                </div>
                                <div class="col-sm-6 form-group-sm">
                                    <label for='mobile_1' class="control-label">Mobile Number</label>
                                    <input type="tel" id='mobile_1' class="form-control checkField" placeholder="Mobile Number">
                                    <span class="help-block errMsg" id="mobile_1Err"></span>
                                </div>
                            </div>
							
                            
                            <div class="row">
                                <div class="col-sm-6 form-group-sm">
                                    <label for='emailOrig' class="control-label">E-mail</label>
                                    <input type="email" id='emailOrig' class="form-control checkField" placeholder="E-mail">
                                    <span class="help-block errMsg" id="emailOrigErr"></span>
                                </div>
                                
                                <div class="col-sm-6 form-group-sm">
                                    <label for='emailDup' class="control-label">Re-type E-mail</label>
                                    <input type="email" id='emailDup' class="form-control" placeholder="Re-type E-mail">
                                    <span class="help-block errMsg" id="emailDupErr"></span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 form-group-sm">
                                    <label for='pwordOrig' class="control-label">Password</label>
                                    <input type="password" id='pwordOrig' class="form-control checkField" placeholder="Password">
                                    <span class="help-block errMsg" id="pwordOrigErr"></span>
                                </div>
                                <div class="col-sm-6 form-group-sm">
                                    <label for='pwordDup' class="control-label">Re-type Password</label>
                                    <input type="password" id='pwordDup' class="form-control" placeholder="Re-type Password">
                                    <span class="help-block errMsg" id="pwordDupErr"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left">Have an account? <a id='loginClk' class="pointer text-info"> Log in </a></div>
                        <button type='button' id='signupSubmit' class="btn btn-primary">Sign Up</button>
                        <button type='button' class="btn btn-danger" data-dismiss='modal'>Close</button>
                    </div>
                </div>
                <!---- End of sign up div----->
                
                
                
                
                <!---- Log in div below----->
                <div class="modal-content hidden" id='logInDiv'>
                    <div class="modal-header">
                        <button class="close" data-dismiss='modal'>&times;</button>
                        <h4 class="text-center">Log In</h4>
                        <div id="logInFMsg" class="text-center errMsg"></div>
                    </div>
                    <div class="modal-body">
                        <form id='loginForm' name="loginForm">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for='email' class="control-label">E-mail</label>
                                    <input type="email" id='emailLogIn' class="form-control checkField" placeholder="E-mail" autofocus>
                                    <span class="help-block errMsg" id="emailLogInErr"></span>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for='logInPassword' class="control-label">Password</label>
                                    <input type="password" id='logInPassword'class="form-control checkField" placeholder="Password">
                                    <span class="help-block errMsg" id="logInPasswordErr"></span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 pull-left">
                                    <input type="checkbox" class="control-label" id='remMe'> Remember me
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-2 pull-right">
                                    <button id='loginSubmit' class="btn btn-primary">Log in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left">Need an account? 
                            <button id='signUpClk' class="btn btn-primary"> Sign Up </button>
                        </div>
                    </div>
                </div>
                <!---- End of log in div----->
            </div>
        </div>
        <!---end of signup/login Modal-->
        
        <script src="<?=base_url()?>/public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>/public/js/main.js"></script>
        <script src="<?=base_url()?>/public/js/access.js"></script>
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