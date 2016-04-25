<?php
defined('BASEPATH') OR exit('');
?>
<link href="<?= base_url() ?>public/css/global.css" rel="stylesheet">

<link href="<?= base_url() ?>public/css/settings.css" rel="stylesheet">

<link href="<?= base_url() ?>public/css/blogstyle.css" rel="stylesheet">


<!-- Header Background Parallax Image -->
<div id="service_bg">
    <div class="head-title">
        <h2>Our Blog</h2>                
    </div>  
</div>
<!-- End Header Background Parallax Image -->


<!--Wrapper Section Start Here -->
<div id="wrapper" class="blog-page blog-details-page">

    <!--content Section Start Here -->
    <div id="content">
        <!--blog-content Section Start Here -->
        <section class="blog-content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7 col-md-9">

                        <div class="blog-listing clearfix">
                            <div class="blog-listing-pics">
                                <figure>
                                    <img src="<?=base_url($post_content['default_image'])?>" alt="" title="">
                                </figure>
                                <ul class="blog-comment">
                                    <li>
                                        <a href="#"> 
                                            <i class="fa fa-comments-o"></i> : 
                                            <?= $post_content['tot_comments'] + $post_content['tot_replies']?> 
                                        </a>
                                    </li>
                                    <li class="heart-status">
                                        <a href="#"> <i class="fa fa-heart-o"></i> : <?=$post_content['likes']?> </a>
                                    </li>
                                </ul>

                            </div>
                            <div class="blog-information animate-effect">
                                <h2><?= $post_content['title']; ?></h2>
                                <div class="blog-admin-info underline-label">
                                    <span class="admin">Author: <span><?= $post_content['author']; ?></span></span>
                                    <span>Date: <span><?= date('jS M, Y h:ia', strtotime($post_content['date_created'])); ?></span></span>
                                </div>

                                <p>
                                    <?= $post_content['body']; ?>
                                </p>

                            </div>
                        </div>


                        <div class="comment-blog-listing">

                            <h2>Comments</h2>
                            <div class="heading-details underline-label pointer loadComments" id="p-<?=$post_content['id']?>"> 
                                Load Comments
                            </div>

                            <ul class="user-comment-list hidden" id="showCommentsHere"></ul>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-5 col-md-3">

                        <div class="featured-blog">
                            <h2>Featured Posts</h2>
                            <span class="heading-details">- Lorem ipsum dolor sit amet ctetur.</span>

                            <ul class="featured-blog-list">
                                <li class="clearfix zoom">
                                    <figure>
                                        <a href="blog-details.html"><img src="assets/img/feature-blog-1.jpg" alt="" title=""/></a>
                                    </figure>
                                    <div class="featured-blog-descpt">
                                        <h5><a href="blog-details.html">Heading Here</a></h5>
                                        <span>By : <span>admin </span></span>
                                        <p>
                                            Lorem Ipsum is simply dummy text of
                                        </p>
                                    </div>
                                </li>
                                <li class="clearfix animate-effect zoom">
                                    <figure>
                                        <a href="blog-details.html"><img src="assets/img/feature-blog-2.jpg" alt="" title=""/></a>
                                    </figure>
                                    <div class="featured-blog-descpt">
                                        <h5><a href="blog-details.html">Heading Here</a></h5>
                                        <span>By : <span>admin </span></span>
                                        <p>
                                            Lorem Ipsum is simply dummy text of
                                        </p>
                                    </div>
                                </li>
                                <li class="clearfix animate-effect zoom">
                                    <figure>
                                        <a href="blog-details.html"><img src="assets/img/feature-blog-3.jpg" alt="" title=""/></a>

                                    </figure>
                                    <div class="featured-blog-descpt">
                                        <h5><a href="blog-details.html">Heading Here</a></h5>
                                        <span>By : <span>admin </span></span>
                                        <p>
                                            Lorem Ipsum is simply dummy text of
                                        </p>
                                    </div>
                                </li>
                                <li class="clearfix animate-effect zoom">
                                    <figure>
                                        <a href="blog-details.html"><img src="assets/img/feature-blog-4.jpg" alt="" title=""/></a>
                                    </figure>
                                    <div class="featured-blog-descpt">
                                        <h5><a href="blog-details.html">Heading Here</a></h5>
                                        <span>By : <span>admin </span></span>
                                        <p>
                                            Lorem Ipsum is simply dummy text of
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="follow-us animate-effect">
                            <h2>Follow us</h2>
                            <span class="heading-details">- Lorem ipsum dolor sit amet ctetur.</span>

                            <ul class="follow-us-list clearfix">
                                <li>
                                    <a href="#" class="fb-on fa fa-facebook"></a>
                                    <span>600 <span> likes</span> </span>
                                </li>
                                <li class="twitter-block">
                                    <a href="#" class="fb-on fa fa-twitter"></a>
                                    <span>600 <span> followers</span> </span>
                                </li>
                                <li class="plus-block">
                                    <a href="#" class="fb-on fa fa-google-plus"></a>
                                    <span>600 <span> followers</span> </span>
                                </li>
                            </ul>

                        </div>

                        <div class="tags animate-effect">
                            <h2>Tags</h2>
                            <span class="heading-details">- Lorem ipsum dolor sit amet ctetur.</span>
                            <ul class="tag-list clearfix">
                                <li>
                                    <a href="#">tag one</a>
                                </li>
                                <li>
                                    <a href="#">tag </a>
                                </li>
                                <li>
                                    <a href="#">tag three</a>
                                </li>
                                <li>
                                    <a href="#">tag</a>
                                </li>
                                <li>
                                    <a href="#">tag two</a>
                                </li>
                                <li>
                                    <a href="#">tag three</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!--blog-content Section End Here -->
        <section class="leave-comment">
            <div class="container">
                <div class="row">
                    <div id="success" >
                        <div role="alert" class="alert alert-success"><strong>Thanks</strong> for using our template. Your message has been sent.</div>
                    </div>
                    <div class="col-xs-12">
                        <h2>Leave comment</h2>
                        <span class="heading-details underline-label">- Lorem ipsum dolor sit amet, </span>
                    </div>
                    <form action="#" method="post">
                        <div class="col-xs-12 col-sm-6 col-md-5 form-block animate-effect">
                            <input type="text" placeholder="name*" id="name" />
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5 form-block animate-effect">
                            <input type="text" placeholder="email*" id="email" />
                        </div>
                        <div class="col-xs-12 col-md-10 form-block animate-effect">
                            <input type="text" placeholder="subject*" id="sub" />
                        </div>
                        <div class="col-xs-12 col-md-10 form-block animate-effect">
                            <textarea cols="1" rows="1" placeholder="Comment*" id="message"></textarea>
                        </div>
                        <div class="col-xs-12 submit-btn animate-effect">
                            <input type="button" id="submit" value="submit" class="detail-submit"/>

                        </div>

                    </form>

                </div>
            </div>

        </section>

    </div>
    <!--content Section End Here -->

</div>
<!--Wrapper Section End Here -->