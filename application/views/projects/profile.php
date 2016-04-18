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
    <style type='text/css'>
        .tp-caption.medium_grey{position:absolute;color:#fff;text-shadow:0px 2px 5px rgba(0,0,0,0.5);font-weight:700;font-size:20px;
            line-height:20px;font-family:Arial;padding:2px 4px;margin:0px;border-width:0px;border-style:none;background-color:#888;
            white-space:nowrap}.tp-caption a{color:#fff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;
            -o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.clx-btn-slider{padding:15px 21px;  border:2px solid #d0cdce;  
            text-transform:uppercase; color:#fff !important; font-size:16px; font-weight:700}.clx-btn-slider:hover{background:rgba(0,0,0,0.6)}
            .entry-meta span{color: #6f6f6f; margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; font-family: 'Lato';}
    </style>

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

                    <div class="row" style="box-sizing: border-box; margin: 0; padding: 0; border: 0; display: block; outline: none;">
                        <?php foreach ($projects as $project): ?>
                        <article id="post-267" style="min-height: 178px; padding: 30px; position: relative; margin-bottom: 20px; display: block; background: #EFE9E9;" >
                            <!---- ========== POST CONTENT ========== ---->
                            <div class="content-article  clearfix">

                                <h1 style="margin-bottom: 20px; font-size: 18px; color: #eeeeee; line-height: 25px">
                                    <a href="awesome-video-post-type/index.html">
                                    <?php echo $project['title']?></a>
                                </h1>

                                <div class="entry-meta" style="margin-bottom: 15px; margin: 0; padding: 0; border: 0;">

                                    
                                    <span style="margin-right: 20px; ">
                                        <i class="fa fa-user"></i>
                                        master                 in                 
                                        <a href="category/new-music/index.html" rel="category tag"><?php echo $project['name']?></a>  </span>

                                    <span style="margin-right: 20px; ">
                                        <i class="fa fa-comment"></i>
                                        <a href="#" rel="23 comments">
                                            <a href="awesome-video-post-type/index.html#respond" title="Comment on Awesome Video Post Type"> 0 comments</a>                </a>
                                    </span>
                                
                                    <span style="margin-right: 20px; "><i class="fa fa-clock-o"></i><a class="date"><?php echo date('F d Y', strtotime($project['date_created']));?></a></span>
                                    
                                </div>
                                <hr>
                                <div class="entry-content" style="margin-bottom: 15px;">
                                    <p><?php echo $project['description']?></p>
                                </div>

                                <a class="read-more" style="color: #fff; display: block; padding: 8px 20px; background: rgba(142, 68, 173, 0.99); float: left; text-transform: capitalize;" href="awesome-video-post-type/index.html" >View <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <!---- ========== END POST CONTENT ========== ---->

                        </article>
                        <?php endforeach; ?>
                    </div>    
                </section>

            </aside>
            <aside class="p-short-info">
                <div class="widget">
                    <button id="createProject" class="btn btn-primary " >Create New Project</button>
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

<!--Nice Scroll
<script src="<?=base_url()?>/public/js/jquery.nicescroll.js"></script>-->
<!--common scripts for all pages-->
<script src="<?=base_url()?>/public/js/scripts.js"></script>
<script src="<?=base_url()?>/public/js/projects.js"></script>


</body>
