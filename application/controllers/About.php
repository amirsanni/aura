<?php
defined('BASEPATH') OR exit('');


/**
 * Description of About
 *
 * @author Ameer <amirsanni@gmail.com>
 * @date 30th RabAwwal, 1437AH
 * @date 11th Jan., 2016
 */
class About extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    
    public function index(){
        $json['curPage'] = "about";
        $json['pageTitle'] = "Design Aura: Connecting the dots:About";
        $json['pageContent'] = $this->load->view('about', '', TRUE);
        
        $this->load->view('main', $json);
    }
}
