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
		
		$this->load->model('Design_model');
    }
    
    
    public function index(){
        $json['curPage'] = "projects";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Projects";
        $json['pageContent'] = $this->load->view('projects/index', '', TRUE);
        
        $this->load->view('main', $json);
    }

    public function page_2(){
        $json['curPage'] = "projects";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Projects";
        $json['pageContent'] = $this->load->view('projects/page_2', '', TRUE);
        
        $this->load->view('main', $json);
    }

    public function portfolio(){
        $json['curPage'] = "projects";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Projects";
        $json['pageContent'] = $this->load->view('projects/portfolio', '', TRUE);

   //     $this->load->model('Design_model');
     //   $data[] = $this->Design_model->getprojectmod();

        $this->load->view('main', $json);
    }

    public function profile($username){
         
      //  $username = $this->uri->segment(3);
        if(isset($username) === true && empty($username) === false){        
          //  echo $username;
          $user_id = $this->Design_model->agent_id_from_username($username);
            if(empty($user_id) === false){
                foreach ($user_id as $user) {
                 //   var_dump($user->agent_id); exit;
                    $profile_data['user'] = $this->Design_model->user_data($user->id, 'username', 'profession', 'logo','mobile_1', 'email', 'country');
                }
            }else{
                header('Location: index.php');
            exit();
            } 
        } else {
            header('Location: index.php');
            exit(); }
        $json['curPage'] = "projects";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Projects";
        $json['pageContent'] = $this->load->view('projects/profile', $profile_data, TRUE);

   //     $this->load->model('Design_model');
     //   $data[] = $this->Design_model->getprojectmod();

        $this->load->view('main', $json);
    }

}
