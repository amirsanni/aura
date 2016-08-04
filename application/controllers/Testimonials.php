<?php
defined('BASEPATH') OR exit('');


/**
 * Description of Testimonials
 *
 * @author Ameer <amirsanni@gmail.com>
 * @date 30th RabAwwal, 1437AH
 * @date 11th Jan., 2016
 */
class Testimonials extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    
    public function index(){
        $json['curPage'] = "Testimonials";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Testimonials";
        $json['pageContent'] = $this->load->view('testimonials', '', TRUE);
        
        $this->load->view('main', $json);
    }
}
