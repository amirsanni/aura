<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Design_model
 *
 * @author Amir <amirsanni@gmail.com>
 */
class Design_model extends CI_Model{
   
    public function getprojectmod($id = FALSE)
     {
        if ($id === FALSE)
        {
                $this->db->select('projects.id, title, default_image, pr_categories.name, description, users.username, date_created, last_edited, published');
                $this->db->join('users', 'users.id=projects.user_id');
                $this->db->join('pr_categories', 'pr_categories.id=projects.category_id');
                
                $run_q = $this->db->get('projects');
                
                if($run_q->num_rows() > 0){
                    return $run_q->result_array();
                }
                
                else{
                    return FALSE;
                }
        }

        $this->db->select('projects.id, title, default_image, pr_categories.name,  description, users.username, date_created, last_edited, published');
        $this->db->join('users', 'users.id=projects.user_id');
        $this->db->join('pr_categories', 'pr_categories.id=projects.category_id');
        
        $run_q = $this->db->get_where('projects', array('id' => $id));
        
        if($run_q->num_rows() > 0){
            return $run_q->result_array();
        }
        
        else{
            return FALSE;
        }
    }
        
    public function user_data($agent_id){
        $data = array();
        $agent_id = (int)$agent_id;
        
        $func_num_args = func_num_args();
        $func_get_args = func_get_args();
        
        if($func_num_args > 1){
            unset($func_get_args[0]);
            
            $fields = '`' . implode('`, `', $func_get_args) . '`';
            $this->db->select($fields);
            $query = $this->db->get_where('users', array('id' => $agent_id));
            $data =  $query->result_array();
       //     var_dump($data);
            return $data;
        }
    }

    public function logged_in(){
        return (isset($_SESSION['agent_id'])) ? true : false;
    }
    
    public function user_exists($username){
        $username = mysql_real_escape_string($username);
        return (mysql_result(mysql_query("SELECT COUNT(`agent_id`) FROM `agents` WHERE `username` = '$username'"), 0) ==1) ? true : false;
    }

    public function user_active($username){
        $username = mysql_real_escape_string($username);
        return (mysql_result(mysql_query("SELECT COUNT(`agent_id`) FROM `agents` WHERE `username` = '$username' AND `active` = 1"), 0) ==1) ? true : false;
    }
    
    public function agent_id_from_username($username){
     //   $username = mysql_real_escape_string($username);
        $this->db->select('id');
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->result();
    
    }


}
