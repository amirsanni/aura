<?php
defined('BASEPATH') OR exit();

/**
 * Description of Subscription
 *
 * @author Amir <amirsanni@gmail.com>
 * @date 27th July, 2015
 */
class Subscription extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        //determine user's device and redirect if necessary
        $this->gen->determineDevice();
        
        $this->load->model(['subscriptions']);
    }
    
    
    
    public function unsubscribe($random, $userCode, $subscriptionType, $userEmail, $userId, $rand){
        //validate user's details
        //userCode, email and id must match
        //then unsubscribe user from $subscriptionType
        
        if(!$random || !$userCode || !$subscriptionType || !$userEmail || !$userId || !$rand){
            $this->load->view('error', ['msg'=>'Broken or Expired Link']);
        }
        
        $email = str_replace(['at', 'dot'], ['@', '.'], $userEmail);
        
        $validateUserInfo = $this->users->checkUserDetailsMatch($userId, $email, $userCode);
        
        if($validateUserInfo){
            /*
             * unsubscribe user from $subscriptionType
             * function header: changeSubscription($userId, $colName, $subValue)
             */
            $this->subscriptions->changeSubscription($userId, $subscriptionType, 0);
            
            $this->load->view('error', ['msg'=>'You have been unsubscribed']);
        }
        
        else{
            $this->load->view('error', ['msg'=>'Broken or Expired Link']);
        }
    }
}
