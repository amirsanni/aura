<?php
defined('BASEPATH') OR exit('');
?>

<!-- Header Background Parallax Image -->   
        <div id="projects_bg">         
            <div class="head-title"> 
                <h2>Our Projects</h2>                        
            </div>
        </div>
        <!-- End Header Background Parallax Image -->              

 <body>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Project Categories
					<small>All Categories</small>
				</h1>
            </div>
        </div>
        <!-- /.row -->
        
        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-3 portfolio-item">
                <a href="#">
					<img class="img-responsive" src="<?=base_url()?>public/images/cat_image/Landscape-Architecture.jpg" alt="" />
                </a>
                <h3>
                    <a href="#">Architecture and Landscape</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-md-3 portfolio-item">
                <a href="#">
					<img class="img-responsive" src="<?=base_url()?>public/images/cat_image/art n craft.jpg" alt="" />
                </a>
                <h3>
                    <a href="#">Art and Craft</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <!-- /.row -->
        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                    <a href="<?=site_url('projects/index')?>">1</a>
                </li>
                <li class="active">
                    <a href="<?=site_url('projects/page_2')?>">2</a>
                </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- /.container -->
</body>