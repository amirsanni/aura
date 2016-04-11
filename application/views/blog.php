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
                    <?php foreach ($news as $news_item): ?>
                    <!-- Blog Item -->
                    <li class="cbp-item ideas motion">
                        <a href="blog-posts/post1.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <?php $image = empty($news_item['default_image']) ? "download/default.jpg" : $news_item['default_image']?>
                                <img src="<?=base_url(); echo $image?>" class="img-responsive" 
                                     alt=<?php  echo $news_item['title']; ?> />                 
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
                            <a href="blog-posts/post1.html" class="cbp-l-grid-blog-title cbp-singlePage"><?php echo $news_item['title'];?></a>
                            <div class="cbp-l-grid-blog-date"><?php echo date('F d Y', strtotime($news_item['date_created']));?></div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">12 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc"><?=LimitCharacter($news_item['body'],200);?></div>                            
                  <?php endforeach; ?>        
                </ul>                                                
            </div>                                                   

        </div><!-- /row -->    
    </div><!-- /container -->
    <!-- End Blog -->
</div><!-- /site-wrapper -->
<!-- End Site Wrapper -->
<?php
function LimitCharacter($data,$limit = 20)
{
    if (strlen($data) > $limit)
    {
        $data = substr($data, 0, strrpos(substr($data, 0, $limit), ' ')) . '...';
        return $data;
    }
    else
    {
        return $data;
    }
}