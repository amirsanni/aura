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
        $json['curPage'] = "Projects";
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

    public function gallery(){

        $data['projects'] = $this->Design_model->getprojectmod();
//var_dump($data); exit;
        $json['curPage'] = "projects";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Projects";
        $json['pageContent'] = $this->load->view('projects/gallery', $data, TRUE);
        
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
          $user_id = $this->Design_model->agent_id_from_username($username);}
          else {
            $username = null;
             }
            if(empty($user_id) === false or empty($username)){
                foreach ($user_id as $user) {
                 //   var_dump($user->agent_id); exit;
                    $profile_data['user'] = $this->Design_model->user_data($user->id, 'username', 'profession', 'logo', 'country');
                }
            }else{
                redirect('projects');
                exit();
            }  

            if ($this->input->post() !== FALSE) {           
                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Project Title', 'trim|required');           

                if ($this->form_validation->run() !== FALSE) {                

                    $title = $this->input->post('title');
                    $description = $this->input->post('description');

                    if (!empty($_FILES['images']['name'][0])) {
                        if ($this->upload_files($title, $_FILES['images']) === FALSE) {
                            $profile_data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                        }
                    }                   

                    if (!isset($profile_data['error'])) {
                        $this->admin_model->add_estate($title, $description, $image_name);    
                        $this->session->set_flashdata('suc_msg', 'Your project has been added successfully'); 
                    //    redirect('projects');    
                    }          
                }
            }

        $profile_data['suc_msg'] = $this->session->flashdata('suc_msg');
        $profile_data['projects'] = $this->Design_model->getprojectmod();
//        var_dump($profile_data); exit;
        $json['curPage'] = "projects";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Projects";
        $json['pageContent'] = $this->load->view('projects/profile', $profile_data, TRUE);

   //     $this->load->model('Design_model');
     //   $data[] = $this->Design_model->getprojectmod();

        $this->load->view('main', $json);
    }

    private function upload_files($title, $files)
    {
        $config = array(
            'upload_path'   => "../project_images/",
            'allowed_types' => 'jpg|gif|png',
            'encrypt_name'  => TRUE,
            'overwrite'     => 1,  
            'max_size'      => 500,                     
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }

}
