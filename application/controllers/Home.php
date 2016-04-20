<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Home
 *
 * @author Amir <amirsanni@gmail.com>
 * @date 30th RabAwwal, 1437AH
 * @date 11th Jan., 2016
 */
class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
        $this->load->model('user');
    }
    
    /**
     * 
     */
    public function index(){
        $json['curPage'] = "Home Page";
        $json['pageTitle'] = "Design Aura: Connecting the dots:About";
        $json['pageContent'] = $this->load->view('home', '', TRUE);
        
        $this->load->view('homemain', $json);
    }
    
    
    
    /**
     * 
     */
    public function signup(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        
		$this->form_validation->set_rules('username', 'Username', ['required', 'trim', 'max_length[20]'], 'is_unique[users.username]', ['required'=>"Username is required"]);
        $this->form_validation->set_rules('firstName', 'First name', ['required', 'trim', 'max_length[20]'], ['required'=>"first name is required"]);
        $this->form_validation->set_rules('lastName', 'Last name', ['required', 'trim', 'max_length[20]'], ['required'=>"last name is required"]);
        $this->form_validation->set_rules('emailOrig', 'E-mail', ['required', 'trim', 'valid_email', 'is_unique[users.email]'], ['required'=>"please provide your e-mail address", 'is_unique'=>"E-mail exists"]);
        $this->form_validation->set_rules('emailDup', 'E-mail Confirmation', ['required', 'trim', 'valid_email', 'matches[emailOrig]'], ['required'=>"please retype your e-mail address"]);
		$this->form_validation->set_rules('mobile_1', 'Mobile', ['required', 'trim', 'max_length[20]'], 'is_unique[users.mobile_1]', ['required'=>"Mobile Number is required"]);
        $this->form_validation->set_rules('pwordOrig', 'Password', ['required'], ['required'=>"Enter your preferred password"]);
        $this->form_validation->set_rules('pwordDup', 'Password Confirmation', ['required', 'matches[pwordOrig]'], ['required'=>"Please retype your password"]);
        
        if($this->form_validation->run() !== FALSE){
            /**
             * insert info into db
             * function header: add($username, $first_name, $last_name, $email, $mobile_1, $password)
             */
            
            //encrypt the password
            $password = password_hash(set_value('pwordOrig'), PASSWORD_BCRYPT);
            
            $inserted = $this->user->add(set_value('username'), set_value('firstName'), set_value('lastName'), set_value('emailOrig'), set_value('mobile_1'), $password);
            
            
            $json = $inserted ? ['status'=>1] : ['status'=>-1];
        }
        
        else{
            //return all error messages
            $json = $this->form_validation->error_array();//get an array of all errors
            $json['status'] = 0;
        }
                    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    
    
    
    public function login(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        
        $this->form_validation->set_rules('emailLogIn', 'E-mail', ['required', 'trim', 'valid_email'], ['required'=>"Enter your e-mail address"]);
        $this->form_validation->set_rules('logInPassword', 'Password', ['required'], ['required'=>"Enter your password"]);
        
        if($this->form_validation->run() !== FALSE){
            /*
             * If all fields are filled, then check db if user with email exist.
             * If yes, verify password
             * If no, return error message
             */
            
            $givenEmail = set_value('emailLogIn');
            $givenPassword = set_value('logInPassword');
            
            $pwordInDb = $this->genmod->getTableCol('users', 'password', 'email', set_value('emailLogIn'));
            
            //if email exists, password will be returned, else "false" will be returned. So we proceed by verifying the returned password
            $verified = password_verify($givenPassword, $pwordInDb);
            
            if($verified){
                $json['status'] = 1;
                
                //set session data
                $this->genlib->setSessionData($givenEmail);
            }
            
            else{
                $json['status'] = 0;
                $json['msg'] = "Incorrect Email/Password combination";
            }
        }
        
        else{
            //return all error messages
            $json = $this->form_validation->error_array();//get an array of all errors
            $json['status'] = 0;
        }
                    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
