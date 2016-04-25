<?php
defined('BASEPATH') OR exit('');
?>
<!-- Header Background Parallax Image -->
<div id="service_bg">
    <div class="head-title">
        <h2>Our Blog</h2>                
    </div>  
</div>
<!-- End Header Background Parallax Image -->        

<!-- Site Wrapper -->
<div class="site-wrapper padding-bottom">

    <!-- Blog -->
    <div class="container">
        <div class="row">

            <div id="grid-blog" class="cbp-l-grid-blog">
                <ul>
                    <?php if ($all_posts): ?>
                        <?php foreach ($all_posts as $get): ?>
                            <!-- Blog Item -->
                            <li class="cbp-item ideas motion">
                                <?php $post_title = url_title($get['title'], "-", TRUE); ?>
                                <?php $blog_link = base_url()."blog/view/".$get['id']."/".$post_title ?>
                                <a href="<?=$blog_link?>" class="cbp-caption">
                                    <!-- Blog Image -->
                                    <div class="cbp-caption-defaultWrap">
                                        <?php $image = empty($get['default_image']) ? "download/default.jpg" : $get['default_image'] ?>
                                        <img src="<?= base_url($image) ?>" class="img-responsive" alt=<?= $get['title'] ?> />                 
                                    </div>
                                    <div class="cbp-caption-activeWrap">
                                        <div class="cbp-l-caption-alignCenter">
                                            <div class="cbp-l-caption-body">
                                                <div class="cbp-l-caption-text">View Blog Post </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- Blog Information -->
                                <div class="text-center">
                                    <a href="<?= $blog_link ?>" class="cbp-l-grid-blog-title"><?= ucwords($get['title']); ?></a>
                                    <div class="cbp-l-grid-blog-date"><?= date('jS M, Y', strtotime($get['date_created'])); ?></div>
                                    <div class="cbp-l-grid-blog-split">|</div>
                                    <a href="#" class="cbp-l-grid-blog-comments">
                                    <?=$get['tot_comments'] + $get['tot_replies']?> comments
                                    </a>
                                </div>
                                <div class="cbp-l-grid-blog-desc"><?= word_limiter($get['body'], 20); ?></div>                            
                            <?php endforeach; ?> 
                        <?php else: ?>
                        No Posts Found
                    <?php endif; ?>
                </ul>                                                
            </div>                                                   

        </div><!-- /row -->    
    </div><!-- /container -->
    <!-- End Blog -->
</div><!-- /site-wrapper -->
<!-- End Site Wrapper -->