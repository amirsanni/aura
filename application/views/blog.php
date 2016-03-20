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

            <!-- Blog Filters -->
            <div id="filters-blog" class="cbp-l-filters-list hidden-xs">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item cbp-l-filters-list-first">All (<div class="cbp-filter-counter"></div>)</div>
                <div data-filter=".ideas" class="cbp-filter-item">Interior Ideas (<div class="cbp-filter-counter"></div>)</div>
                <div data-filter=".house-design" class="cbp-filter-item">House Design (<div class="cbp-filter-counter"></div>)</div>
                <div data-filter=".decoration" class="cbp-filter-item">Decoration (<div class="cbp-filter-counter"></div>)</div>
                <div data-filter=".motion" class="cbp-filter-item cbp-l-filters-list-last">Motion (<div class="cbp-filter-counter"></div>)</div>
            </div>

            <div id="grid-blog" class="cbp-l-grid-blog">
                <ul>
                    <!-- Blog Item -->
                    <li class="cbp-item ideas motion">
                        <a href="blog-posts/post1.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_1.jpg" class="img-responsive" 
                                     alt="Specifie an alternate text for an image" />                 
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post1.html" class="cbp-l-grid-blog-title cbp-singlePage">Lorem ipsum dolor sit amet</a>
                            <div class="cbp-l-grid-blog-date">20 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">12 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>                            
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item house-design decoration">
                        <a href="blog-posts/post2.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_2.jpg" alt="Enter" />                   
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post2.html" class="cbp-l-grid-blog-title cbp-singlePage">Consectetuer adipiscing elit sed diam </a>
                            <div class="cbp-l-grid-blog-date">11 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">1 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item ideas motion">
                        <a href="blog-posts/post3.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_3.jpg" alt="Specifie an alternate text for an image" />                   
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post3.html" class="cbp-l-grid-blog-title cbp-singlePage">Nonummy nibh euismod tincidunt</a>
                            <div class="cbp-l-grid-blog-date">2 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">22 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item house-design ideas">
                        <a href="blog-posts/post4.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_4.jpg" alt="Specifie an alternate text for an image">                    
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post4.html" class="cbp-l-grid-blog-title cbp-singlePage">Ut laoreet dolore magna aliquam</a>
                            <div class="cbp-l-grid-blog-date">2 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">22 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item motion decoration">
                        <a href="blog-posts/post5.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog_5.jpg" alt="Specifie an alternate text for an image">                    
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post5.html" class="cbp-l-grid-blog-title cbp-singlePage">Erat volutpat ut wisi enim ad</a>
                            <div class="cbp-l-grid-blog-date">2 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">22 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item ideas motion">
                        <a href="blog-posts/post6.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_6.jpg" alt="Specifie an alternate text for an image">                    
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post6.html" class="cbp-l-grid-blog-title cbp-singlePage">Minim veniam quis nostrud exerc</a>
                            <div class="cbp-l-grid-blog-date">2 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">22 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item house-design ideas">
                        <a href="blog-posts/post7.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_7.jpg" alt="Specifie an alternate text for an image">                    
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post7.html" class="cbp-l-grid-blog-title cbp-singlePage">Tation ullamcorper suscipit lobortis</a>
                            <div class="cbp-l-grid-blog-date">2 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">22 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item ideas decoration">
                        <a href="blog-posts/post8.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_8.jpg" alt="Specifie an alternate text for an image">                    
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post8.html" class="cbp-l-grid-blog-title cbp-singlePage">Nisl ut aliquip ex ea commodo</a>
                            <div class="cbp-l-grid-blog-date">2 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">22 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>

                    <!-- Blog Item -->
                    <li class="cbp-item motion decoration">
                        <a href="blog-posts/post9.html" class="cbp-caption cbp-singlePage">
                            <!-- Blog Image -->
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?=base_url()?>public/images/blog/blog_9.jpg" alt="Specifie an alternate text for an image">                    
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">View Post</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Blog Information -->
                        <div class="text-center">
                            <a href="blog-posts/post9.html" class="cbp-l-grid-blog-title cbp-singlePage">Consequat duis autem vel eum</a>
                            <div class="cbp-l-grid-blog-date">2 december 2013</div>
                            <div class="cbp-l-grid-blog-split">|</div>
                            <a href="#" class="cbp-l-grid-blog-comments">22 comments</a>
                        </div>
                        <div class="cbp-l-grid-blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat magna aliquam erat volutpat.</div>
                    </li>                            
                </ul>                                                
            </div>                                                   

        </div><!-- /row -->    
    </div><!-- /container -->
    <!-- End Blog -->
</div><!-- /site-wrapper -->
<!-- End Site Wrapper -->