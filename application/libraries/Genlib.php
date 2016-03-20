<?php
defined('BASEPATH') OR exit('Access Denied');
require_once './application/controllers/functions.php';

/**
 * Description of Genlib
 * Class deals with functions needed in multiple controllers to avoid repetition in each of the controllers
 *
 * @author Amir <amirsanni@gmail.com>
 */
class Genlib {
    protected $CI;
    
    public function __construct() {
        $this->CI = &get_instance();
    }
    
    
    /**
     * 
     * @param type $sname
     * @param type $semail
     * @param type $rname
     * @param type $remail
     * @param type $subject
     * @param type $message
     * @param type $replyToEmail
     * @param type $files
     * @return type
     */
    public function send_email($sname, $semail, $rname, $remail, $subject, $message, $replyToEmail="", $files=""){
        $this->CI->email->from($semail, $sname);
        $this->CI->email->to($remail, $rname);
        $replyToEmail ? $this->CI->email->reply_to($replyToEmail, $sname) : "";
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        
        //include attachment if $files is set
        if($files){
            foreach($files as $fileLink){
                $this->CI->email->attach($fileLink, 'inline');
            }
        }

        $send_email = $this->CI->email->send();
        
        
        return $send_email ? TRUE : FALSE;
    }
    
    
    
    /**
     * send a welcome message to new users
     * @param type $name
     * @param type $email
     * @return string
     */
    public function sendWelcomeMessage($name, $email){
        //set values to pass to view that will generate the message
        $data['name'] = $name;
        $data['email'] = $email;
        
        $message = $this->CI->load->view('welcome', $data, TRUE);
        
        
        $this->send_email('Smartag', 'noreply@smartagapp.com', $name, $email, "Welcome to Smartag", $message);
        
        
        //$this->sendCEOWelcomeMsg($name, $email);
        
        return "";
    }
    
    
    /**
     * Send CEO's welcome message
     * @param type $name
     * @param type $email
     * @return string
     */
    private function sendCEOWelcomeMsg($name, $email){
        $message = "Hi $name,
            <p>I'm Femi, the CEO of Einsight, the company that brought you Smartag. 
            You have joined the elite group of Smartag's users and I am glad to welcome you to better productivity.</p>
            
            <p>Smartag is an enterprise application that allows you and your team(s) to collaborate and capture knowledge effortlessly.</p>
            
            <p>
            Ready to try it out? 
            Click <a href=''> here </a> to see some popular use cases for Smartag.
            </p>
            
            <p> - Olufemi Aiki, CEO of Einsight Limited. </p>
            <br>
            <small>P.S. Need help getting started? Check our <a href='".site_url('faq')."'> FAQ </a> page 
            or reply to this email with any questions. I will gladly reply you.</small>";
        
        
        $this->send_email("Olufemi Aiki", "olufemi.aiki@smartagapp.com", $name, $email, "Welcome on Board", $message);
        
        
        return "";
    }
	
	
	
    public function determineDevice(){
        $this->CI->load->library('user_agent');
        
        //if it is not a mobile device, stay in domain
        if(!$this->CI->agent->is_mobile()){
            return "";
        }
        
        else{
            //get the current url
            //modify the url to the mobile platform
            //redirect user to the new url
            //baseUrl() is in functions.php and it equals "http://m.smartagapp.com/"
            
            $url = str_replace(base_url(), baseUrl(), current_url());
            
            //if it has query string, add it to the url to redirect to
            $newUrl = $_SERVER['QUERY_STRING'] ? $url . "?" . $_SERVER['QUERY_STRING'] : $url;
            
            redirect($newUrl);
        }
    }
    
    
    
    
    public function checkLogin(){
        if(empty($_SESSION['userId'])){
            //redirect to log in page
            $currentUrl = $_SERVER['QUERY_STRING'] ? current_url() . "?" . $_SERVER['QUERY_STRING'] : current_url();
            
            redirect('access/login?red_uri='. urlencode($currentUrl));//redirects to login page
        }
        
        else{
            return "";
        }
    }
	
	
    /**
     * 
     * @param type $email
     * @return string
     */
    public function setSessionData($email){
        //get details needed to put in session using the given email and set them
        $this->CI->db->select('agent_id, email, contact_person, logo');
        $this->CI->db->where('email', $email);
        
        $run_q = $this->CI->db->get('agents');
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                $_SESSION['agentId'] = $get->agent_id;
                $_SESSION['agentEmail'] = $get->email;
                $_SESSION['agentName'] = $get->contact_person;
                $_SESSION['companyLogo'] = "../agents/".$get->agent_id."/".$get->logo;
            }
        }
        
        return "";
    }
    
    
    
    /**
     * Ensure request is an AJAX request
     * @return string
     */
    public function ajaxOnly(){
        //display uri error if request is not from AJAX
        if(!$this->CI->input->is_ajax_request()){
            redirect(base_url());
        }
        
        else{
            return "";
        }
    }
    
    
    /**
     * Creates thumbnail of an image
     * @param type $relFilePath
     * @return boolean
     */
    public function createThumb($relFilePath){
        
        $config['image_library'] = 'gd2';
        $config['source_image'] = $relFilePath;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 320;
        $config['height']         = 50;

        $this->CI->load->library('image_lib', $config);

        if (!$this->CI->image_lib->resize()) {
            return FALSE;
        }
        
        else{
            return TRUE;
        }
    }
    
    
    /**
     * Sets the message to return for file upload
     * @param type $files
     * @param type $error
     * @return string
     */
    public function setFileUploadMsg($files, $error, $errCount){
        //if the file is just one, return CI error message if it fails or success if otherwise
        //if the number of files sent to be uploaded is more than one, check whether $error is set and set msg as appropriate
        
        if(count($files) == 1){
            return $error ? $error : "File Successfully Uploaded";
        }
        
        else if(count($files) > 1){
            return $error ? $errCount ." file(s) could not be uploaded" : "Files Successfully Uploaded";
        }
        
        else{
            return "Invalid File";
        }
    }
    
    
    /**
     * Calculate the size of a file or diskSpace and format it based on the size
     * @param type $size
     * @return type
     */
    public function formatFileSize($size){
        if($size < 1000){
            $newSize = $size."B";
        }
        
        else if($size > 1000 && $size < 1000000){
            $newSize = round($size/1000, 2)."KB";
        }
        
        else{
            $newSize = round($size/1000000, 2)."MB";
        }
        
        return $newSize;
    }
    
    
    
    /**
     * Converts date and time to users' current date and time based on his timezone
     * @param type $timestamp
     */
    public function convertToCurrentTimezone($timestamp){
        $dateInGMT = date('Y-m-d H:i:s', local_to_gmt($timestamp));//convert timestamp to gmt

        $date = new DateTime($dateInGMT);//create new dateTime object
        
        //if offset from gmt is positive, add the offset to GMT
        if(isset($_SESSION['offset']) && $_SESSION['offset'] >= 0){
            
            $date->add(new DateInterval('PT'.$_SESSION['offset'].'M'));
        
            $msg = $date->format('Y-m-d H:i:s');
        }
        
        
        //else if offset from GMT is negative, subtract the offset from GMT
        else if(isset($_SESSION['offset']) && $_SESSION['offset'] < 0){
            //remove the negative sign before the offset to prevent php error
            $offset = str_replace("-", "", $_SESSION['offset']);
            
            $date->sub(new DateInterval('PT'.$offset.'M'));
        
            $msg = $date->format('Y-m-d H:i:s');
        }
        
        
        //if the session variable is not set at all, return the date back formatted
        else{
            $msg = date('Y-m-d H:i:s', $timestamp);
        }
        
        return $msg;
    }
    
    
    
    /**
     * Convert to gmt based on user's gmt offset
     * @param type $timestamp
     * @return type
     */
    public function convertToUTC($timestamp){
        $dateInGMT = date('Y-m-d H:i:s', local_to_gmt($timestamp));//convert timestamp to gmt

        $date = new DateTime($dateInGMT);//create new dateTime object
        
        //if offset from gmt is positive, subtract the offset from GMT
        //i.e. if tz is GMT+2, convert to gmt by subtracting 2hrs
        if(isset($_SESSION['offset']) && $_SESSION['offset'] >= 0){
            
            $date->sub(new DateInterval('PT'.$_SESSION['offset'].'M'));
        
            $msg = $date->format('Y-m-d H:i:s');
        }
        
        
        //else if offset from GMT is negative, add the offset to GMT
        //i.e. if tz is GMT-3, convert to gmt by adding 3hrs
        else if(isset($_SESSION['offset']) && $_SESSION['offset'] < 0){
            //remove the negative sign before the offset to prevent php error
            $offset = str_replace("-", "", $_SESSION['offset']);
            
            $date->add(new DateInterval('PT'.$offset.'M'));
        
            $msg = $date->format('Y-m-d H:i:s');
        }
        
        
        //if the session variable is not set at all, return the date back formatted
        else{
            $msg = date('Y-m-d H:i:s', $timestamp);
        }
        
        return $msg;
    }
    
    
    /**
     * Set and return pagination configuration
     * @param type $totalRows
     * @param type $urlToCall
     * @param type $limit
     * @param type $attributes
     * @return boolean
     */
    public function setPaginationConfig($totalRows, $urlToCall, $limit, $attributes){
        $config = ['total_rows'=>$totalRows, 'base_url'=>base_url().$urlToCall, 'per_page'=>$limit, 'uri_segment'=>3,
            'num_links'=>$totalRows/$limit, 'use_page_numbers'=>TRUE, 'first_link'=>FALSE, 'last_link'=>FALSE,
            'prev_link'=>'&lt;&lt;', 'next_link'=>'&gt;&gt;', 'full_tag_open'=>"<ul class='pagination'>", 'full_tag_close'=>'</ul>', 
            'num_tag_open'=>'<li>', 'num_tag_close'=>'</li>', 'next_tag_open'=>'<li>', 'next_tag_close'=>'</li>',
            'prev_tag_open'=>'<li>', 'prev_tag_close'=>'</li>', 'cur_tag_open'=>'<li><a><b style="color:black">', 
            'cur_tag_close'=>'</b></a></li>', 'attributes'=>$attributes];
        
        
        return $config;
    }
}