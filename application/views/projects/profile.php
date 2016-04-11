<?php
defined('BASEPATH') OR exit('');
//var_dump($user);
// echo $user[0]['username']; exit;
?>

    <!--common style-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/profile-style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/style-responsive.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

<body>
            <!-- profile head start-->
            <div class="profile-hero" style="margin-top: 80px;">
                <div class="profile-intro">
                    <?php $image = empty($user[0]['logo']) ? "public/images/profile/img1.jpg" : $user[0]['logo']?>
                    <img src="<?=base_url(); echo $image;?>" alt=""/>
                    <h1><?php echo $user[0]['username'];?></h1>
                    <span><?php echo $user[0]['profession'];?></span>
                </div>
                <div class="profile-value-info">
                    <div class="info">
                        <span>92</span>
                        Projects
                    </div>
                    <div class="info">
                        <span>5 stars</span>
                        ratings
                    </div>
                </div>
            </div>
            <!-- profile head end-->

            <!--body wrapper start-->
            <div class="wrapper no-pad">

            <div class="profile-desk">
            <aside class="p-aside">
                <section class="panel profile-info">
                    
                </section>

                <div class="profile-timeline">
                    
                </div>

            </aside>
            <aside class="p-short-info">
                
                <div class="widget">
                    <div class="title">
                        <h1>About</h1>
                    </div>
                    <p class="mbot20">Hello I am Dave Gomache  a web and user interface designer. I love to work with the application interface and the web elements.
                    </p>
                    <div class="bio-row">
                        <p><span>Gender </span> Male </p>
                    </div>
                    <div class="bio-row">
                        <p><span> Project Done </span> 50 + </p>
                    </div>
                    <div class="bio-row">
                        <p><span> Skills </span> HTML, CSS, JavaScript </p>
                    </div>
                </div>

                <div class="widget">
                    <div class="title">
                        <h1 class="pull-left">Performance</h1>
                        <a href="#" class="pull-right v-all"> View All </a>
                    </div>
                    <ul class="p-list">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i> Total Product Sales  <span class="pull-right">23456</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i>  Total Product Refer  <span class="pull-right">$234</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i>  Total Earn  <span class="pull-right"> $345000</span>
                            </a>
                        </li>
                    </ul>

                </div>

               


                <div class="widget">
                    <div class="twt-feed">
                        <img src="<?=base_url(); echo $image;?>" alt=""/>
                        <h2><a href="#"><?php echo $user[0]['username'];?></a></h2>
                        <p>You can always reach us via email at info@designaura.com.ng</p>
                    </div>

                </div>

            </aside>
            </div>

            </div>
            <!--body wrapper end-->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?=base_url()?>/public/js/jquery-migrate.js"></script>
<script src="<?=base_url()?>/public/js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="<?=base_url()?>/public/js/jquery.nicescroll.js"></script>
<!--common scripts for all pages-->
<script src="<?=base_url()?>/public/js/scripts.js"></script>


</body>
