<?php
defined('BASEPATH') OR exit('');
?>
<!-- Header Background Parallax Image -->
<div id="blog_bg">
    <div class="head-title">
        <h2>Contact Us</h2>                
    </div>  
</div>
<!-- End Header Background Parallax Image -->                

<!-- Contact Form (name, email, phone and message inputs for your email form "should change your email adress in contact.php file") -->     
<div class="bg-color padding-top-x2">
    <div class="container padding-bottom">
        <div class="col-lg-12" id="contact">                
            <div id="message"></div>
            <form method="post" action="http://Design Aura.denisgriu.com/contact.php" name="contactform" id="contactform">
                <fieldset>
                    <div class="col-md-6">

                        <!-- Description -->                                        
                        <h3>We'd love to hear from you</h3>   
                        <br>                                     
                        <p>Design aura is an internet based business with Nigeria as its root market base. Originality is an integral part of her services.</p>
                        <br>
                        <div class="row">
                            <!-- Adress -->                       
                            <div class="col-sm-3 col-md-6">
                                <div class="col-sm-2 contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="col-sm-10">
                                    <span><b>Address</b></span> 
                                    <address>                            
                                        <small>
                                            10, Kernel Street, off Bode Thomas,<br>
                                            Surulere, Lagos.                                                            
                                        </small>                               
                                    </address>             
                                </div>                   
                            </div>

                            <!-- Phone -->
                            <div class="col-sm-3 col-md-6">
                                <div class="col-sm-2 contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="col-sm-10">
                                    <span><b>Phone</b></span>
                                    <address>                            
                                        <small>                                                           
                                            08058334158, 07019103413  
                                        </small>
                                    </address>            
                                </div>                    
                            </div>
                        </div>

                        <div class="row">
                            <!-- Fax -->
                            <div class="col-sm-3 col-md-6">
                                <div class="col-sm-2 contact-icon">
                                    <i class="fa fa-fax"></i>
                                </div>

                            </div> 

                            <!-- Email -->
                            <div class="col-sm-3 col-md-6">
                                <div class="col-sm-2 contact-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="col-sm-10">
                                    <span><b>Email</b></span>
                                    <address>                            
                                        <small>
                                            designaurainc@gmail.com                   
                                        </small>
                                    </address>
                                </div>
                            </div>                                                                                        
                        </div>
                        <br>
                        <div class="row">                                            
                            <div class="col-sm-3 col-md-12">
                                <ul class="contact-social">
                                    <li><a href="http://www.facebook.com"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="http://www.twitter.com"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="http://www.skype.com/myskypename"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="https://www.pinterest.com/"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="https://www.instagram.com/"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6"> 
                        <!-- Name -->
                        <input name="name" type="text" id="name" size="30" value="" placeholder="Name"/>
                        <br />
                        <!-- Email -->
                        <input name="email" type="text" id="email" size="30" value="" placeholder="Email"/>
                        <br /> 
                        <!-- Phone -->
                        <input name="phone" type="text" id="phone" size="30" value="" placeholder="Phone"/>

                        <!-- Message -->                                                                        
                        <textarea name="comments" cols="40" rows="5" id="comments" placeholder="Message"></textarea>

                        <!-- Submit Button -->                                        
                        <button type="submit" class="btn btn-default btn-submit submit" id="submit" value="Submit">Submit</button>

                    </div>

                </fieldset>
            </form>
        </div>
    </div>   
</div>          
<!-- End Contact Form -->

<!-- Google Map (adress on map can be changed in app.js file) -->
<div id="map-canvas"></div>
<!-- End Google Map -->