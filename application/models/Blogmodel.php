<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Blogmodel
 *
 * @author Abdul-Basit
 */
class Blogmodel extends CI_Model{
    
    public function get_news($id = FALSE, $title = FALSE)
     {
        if ($id === FALSE)
        {
                $query = $this->db->get('blogs');
                return $query->result_array();
        }

        $query = $this->db->get_where('blogs', array('id' => $id, 'title' => urldecode($title))); 
        return $query->row_array();
    }

}
