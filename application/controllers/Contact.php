<?php
defined('BASEPATH') OR exit('');


/**
 * Description of Contact
 *
 * @author Ameer <amirsanni@gmail.com>
 * @date 30th RabAwwal, 1437AH
 * @date 11th Jan., 2016
 */
class Contact extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    
    public function index(){
        $json['curPage'] = "contact";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Contact";
        $json['pageContent'] = $this->load->view('contact', '', TRUE);
        
        $this->load->view('main', $json);
    }
}
