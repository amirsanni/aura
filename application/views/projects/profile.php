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

            <div class="col-sm-12 hidden" id="createProjectDiv" style="background-color:#FFFFF0">
                        <div class="row">
                            <i class="fa fa-times pull-right text-danger pointer closeCreateProject"></i>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <center><img src="" id='image' class="img-responsive" width="600px" height="400px"></center>
                                <br>
                                <label>Change Image(max file size; 500kb):</label>
                                <input type="file" id="image" multiple="" name="image[]" class="form-control">
                            </div>
                        </div>
                        
                        <form id='createProjectForm' name='createProjectForm' role='form'>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for='title' class="control-label">Title</label>
                                    <input type="text" id='title' class="form-control checkField" placeholder="Project Title">
                                    <span class="help-block" id="titleErr"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for='desc' class="control-label">Description</label>
                                    <textarea id='desc' class="form-control checkField" rows="10" cols="40" placeholder="Add Project Description"></textarea>
                                    <span class="help-block errMsg" id="descErr"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for='cat' class="control-label">Category</label>
                                    <textarea id='cat' class="form-control checkField" rows="10" cols="40" placeholder="Choose a category"></textarea>
                                    <span class="help-block errMsg" id="catErr"></span>
                                </div>
                            </div>

                            <input type="hidden" id="projectId">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary" id="addProjectSubmit">Save</button>
                                    <button class="btn btn-danger closeEditBlog">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
        <div id="userProjects" style="margin-top: 80px;">
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
                    <button id="createProject" class="btn btn-primary ">Create New Project</button>
                </div>    
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
        </div>    
            <!--body wrapper end-->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?=base_url()?>/public/js/jquery-migrate.js"></script>
<script src="<?=base_url()?>/public/js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="<?=base_url()?>/public/js/jquery.nicescroll.js"></script>
<!--common scripts for all pages-->
<script src="<?=base_url()?>/public/js/scripts.js"></script>
<script src="<?=base_url()?>/public/js/projects.js"></script>


</body>
