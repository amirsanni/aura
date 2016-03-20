<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Agent
 *
 * @author Amir <amirsanni@gmail.com>
 * @date 29th Jan, 2016
 */
class Agent extends CI_Model{
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
    public function add($_cp, $email, $password){
        $data = ['contact_person'=>$_cp, 'email'=>$email, 'password'=>$password];
        
        $this->db->set('created_on', 'NOW()', FALSE);
        
        $this->db->insert('agents', $data);
        
        if($this->db->affected_rows()){
            return $this->db->insert_id();
        }
        
        else{
            return FALSE;
        }
    }
}
