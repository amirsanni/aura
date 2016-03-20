<?php
defined('BASEPATH') OR exit('');


/**
 * Description of Blog
 *
 * @author Ameer <amirsanni@gmail.com>
 * @date 30th RabAwwal, 1437AH
 * @date 11th Jan., 2016
 */
class Blog extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    
    public function index(){
        $json['curPage'] = "blog";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Blog";
        $json['pageContent'] = $this->load->view('blog', '', TRUE);
        
        $this->load->view('main', $json);
    }
}
