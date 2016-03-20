<?php
defined('BASEPATH') OR exit('');


/**
 * Description of Projects
 *
 * @author Ameer <amirsanni@gmail.com>
 * @date 30th RabAwwal, 1437AH
 * @date 11th Jan., 2016
 */
class Projects extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    
    public function index(){
        $json['curPage'] = "projects";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Projects";
        $json['pageContent'] = $this->load->view('projects', '', TRUE);
        
        $this->load->view('main', $json);
    }
}
