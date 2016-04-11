<?php
defined('BASEPATH') OR exit('');
?>
 
<html>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/bootstrap/css/style_overlay1.css">
    <body>

<!-- Header Background Parallax Image -->   
        <div id="projects_bg">         
            <div class="head-title"> 
                <h2>Our Projects</h2>                        
            </div>
        </div>
        <!-- End Header Background Parallax Image -->
        
<?php echo $this->Html->link('add', array('controller'=>'images', 'action'=>'add'));?>
    <h2 style="text-align: left;padding-left: 20px;">Picture Gallery</h2>
                <div id="effect-1" class="grid">
            <?php foreach ($images as $image): ?>
                        <!-- Portfolio Item (image and description) -->
                        <div class="thumbnail">
                            <a class="image-item" href=<?php echo "/designAura/gallery/" .$image['Image']['path'];?> >
                                    <?php echo $this->Html->image("/gallery/" . $image['Image']['path'], array('alt' => "")); ?>
                               </a>  
                    </div>
            <?php endforeach; ?>
</div>
        
    <div>
        <?php 
        //show page numbers
  //      echo $this->Paginator->numbers();  
        echo $this->Paginator->next('Show more...');    ?> 
     </div> 
    
        <script type="text/javascript">
            window.onload = function(){
                var options =
                {
                    srcNode: ('thumbnail', 'img'),             // grid items (class, node)
                    margin: '20px',             // margin in pixel, default: 0px
                    width: '250px',             // grid item width in pixel, default: 220px
                    max_width: '',              // dynamic gird item width if specified, (pixel)
                    resizable: true,            // re-layout if window resize
                    transition: 'all 0.5s ease' // support transition for CSS3, default: all 0.5s ease
                }
                document.querySelector('.grid').gridify(options);
            }
        </script>   
       
          <script>
            $(function(){
              var $container = $('.image');

              $container.infinitescroll({
                navSelector  : '.next',    // selector for the paged navigation 
                nextSelector : '.next a',  // selector for the NEXT link (to page 2)
                itemSelector : '.gallery-image',     // selector for all items you'll retrieve
                debug         : true,
                dataType      : 'html',
                loading: {
                    finishedMsg: 'No more posts to load. All Hail Star Wars God!',
                    img: '<?php echo $this->webroot; ?>img/AjaxLoader.gif'
                  }
                }
              );
            });
 
        </script>
    </body>
	<script src="<?=base_url()?>/public/bootstrap/js/jquery.infinitescroll.js"></script>
    <script src="<?=base_url()?>/public/bootstrap/js/jquery.manual-trigger.js"></script>
	<script src="<?=base_url()?>/public/bootstrap/js/jquery.gridify.js"></script>
</html>

