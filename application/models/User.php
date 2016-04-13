<?php
defined('BASEPATH') OR exit('');

/**
 * Description of User
 *
 * @author Amir <amirsanni@gmail.com>
 * @date 29th Jan, 2016
 */
class User extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    
    /**
     * 
     * @param type $_cp
     * @param type $email
     * @param type $password
     * @return boolean
     */
    public function add($username, $first_name, $last_name, $email, $mobile_1, $password){
        $data = ['username'=>$username, 'first_name'=>$first_name, 'last_name'=>$last_name, 'email'=>$email, 'mobile_1'=>$mobile_1, 'password'=>$password];
        
        $this->db->set('signup_date', 'NOW()', FALSE);
        
        $this->db->insert('users', $data);
        
        if($this->db->affected_rows()){
            return $this->db->insert_id();
        }
        
        else{
            return FALSE;
        }
    }
}
