<?php
defined('BASEPATH') OR exit('');
?>

<div id="about_bg">
    <div class="head-title">
        <h2>Our Testimonials</h2>                
    </div>  
</div>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/sliderarrow.css" />
<script src="<?=base_url()?>public/js/jssor.slider.mini.js"></script>
<script src="<?=base_url()?>public/js/slidermain.js"></script>  

<!-- Jssor Slider Begin -->
<!-- You can move inline styles to css file or css block. -->
<div id="slider1_container" style="position: relative; top: 0px;  margin-left: auto; margin-right: auto; width: 1200px;
     height: 500px; overflow: hidden;">
    <!-- Slides Container -->
    <div u="slides" style="cursor: move; position: absolute; align: center; top: 0px; width: 1200px; height: 500px;
         overflow: hidden;">
        <div><img src="<?=base_url()?>public/images/blog/blog_1.jpg" alt="" /></div>
        <div><img src="<?=base_url()?>public/images/blog/blog_2.jpg" alt="" /></div>
        <div><img src="<?=base_url()?>public/images/blog/blog_3.jpg" alt="" /></div>
        <div><img src="<?=base_url()?>public/images/blog/blog_4.jpg" alt="" /></div>
        <div><img src="<?=base_url()?>public/images/blog/blog_5.jpg" alt="" /></div>
        <div><img src="<?=base_url()?>public/images/blog/blog_6.jpg" alt="" /></div>
        <div><img src="<?=base_url()?>public/images/blog/blog_7.jpg" alt="" /></div>
        <div><img src="<?=base_url()?>public/images/blog/blog_8.jpg" alt="" /></div>
    </div>
    <!-- Arrow Left -->
    <span u="arrowleft" class="jssora13l" style="width: 40px; height: 50px; top: 123px; left: 30px;">
    </span>
    <!-- Arrow Right -->
    <span u="arrowright" class="jssora13r" style="width: 40px; height: 50px; top: 123px; right: 30px">
    </span>
</div>