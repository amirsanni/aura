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
        $json['curPage'] = "Contact";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Contact";
        $json['pageContent'] = $this->load->view('contact', '', TRUE);
        
        $this->load->view('main', $json);
    }
	
	
	
	
	public function emailus(){
        $name = $this->input->post("name", TRUE);
        $email = $this->input->post('email', TRUE);
        $msg = $this->input->post('msg', TRUE);
        $phone = $this->input->post("phone", TRUE);
        $subject = "Design Aura User";
        
        $fMsg = $msg . "<br><small><p>{$name},</p><p>{$email},</p><p>{$phone}</p></small>";
        
        //method header: send_email($sname, $semail, $rname, $remail, $subject, $message, $replyToEmail="", $files="")
        $done = $this->genlib->send_email($name."(".$email.")", "info@designaura.com.ng", 'Design Aura', "hello@designaura.com.ng", $subject, $fMsg, $email, "");
        
        $json['status'] = $done ? 1 : 0;
        
        //save email in db even if it was not successfully sent to our email
        //log_email($name, $email, $subject, $phone, $msg)
        $this->genmod->log_message($name, $email, $subject, $phone, $msg);
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
