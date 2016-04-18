<?php
defined('BASEPATH') OR exit('');
?>
<!DOCTYPE html>

<!-- Header Background Parallax Image -->
<div id="projects_bg">         
    <div class="head-title"> 
        <h2>Our Projects</h2>                        
    </div>
</div>
<!-- End Header Background Parallax Image -->        

        <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>public/css/mainImage.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>public/css/7531339.css" />
      </head>

  <body class="">
            

        <div id="menu-mobile"></div>
        <div class="box-overlay"></div>
    
       <section id="content">
        <div class="block last">
            <div class="inner full-width">
                <div class="grid">
                    <ul class="masonry" id="masonry-1">
                    <?php foreach ($projects as $project): ?>
                        <li class="col n-2-5">
                            <div class="box-default box-post">
                                <figure class="rollover">
                                    <a href="http://www.awwwards.com/free-ebook-web-ui-design-for-the-human-eye-colors-space-contrast.html">
                                        <img width="459" height="330" src="<?=base_url(); echo "public/", $project['default_image']?>" alt="<?php echo $project['title']?>" />
                                                        </a>
                                </figure>
                                <div class="info">
                                    <h3 class="x-bold"><a href="http://www.awwwards.com/free-ebook-web-ui-design-for-the-human-eye-colors-space-contrast.html"><?php echo $project['title']?></a></h3>
                                    <div class="row author">
                                        <strong><a href="http://www.awwwards.com/category/web-design-tag/">By: <?php echo $project['username']?></a></strong>
                                    </div>
                                    <div class="row category">
                                        <strong><a href="http://www.awwwards.com/category/web-design-tag/"><?php echo $project['name']?></a></strong>
                                    </div>
                                    <div class="row date"><?php echo date('F d Y', strtotime($project['date_created']));?></div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>
    </section>
   

            <script src="<?=base_url()?>public/js/7c16508.js"></script>

    <script src="<?=base_url()?>public/js/jquery.masonry.js"></script>
    <script src="<?=base_url()?>public/js/jquery.images-loaded.js"></script>
    <script src="<?=base_url()?>public/js/jquery.infinite-scroll.js"></script>
    <script>
        function showListMosaic(){
            /* MOSAIC 1 */
            var container1 = $('#masonry-1');
            setTimeout(function(){ 
                container1.imagesLoaded( function(){
                    container1.masonry({
                        itemSelector : 'li'
                    });
                });
            }, 600);
            /* INFINITE LOAD 1 */
            container1.infinitescroll({
                    navSelector  : '.paginate',
                    nextSelector : '.paginate .next',
                    itemSelector : '#masonry-1 li'
                },
                function( newElements1 ) {
                    var $newElems1 = $( newElements1 ).css({ opacity: 0 });
                    $newElems1.imagesLoaded(function(){
                        $newElems1.animate({ opacity: 1 });
                        container1.masonry( 'appended', $newElems1, true );
                    });
                }
            );
        }
        $(document).ready(showListMosaic);
        $(window).resize(showListMosaic);
    </script>
  </body>
