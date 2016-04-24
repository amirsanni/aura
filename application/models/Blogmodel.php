<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Blogmodel
 *
 * @author Abdul-Basit
 */
class Blogmodel extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }    
    
    
    /**
     * 
     * @return type
     */
    public function getAllPosts(){
        $run_q = $this->db->query("SELECT blogs.*, count(bl_comments.id) as 'tot_comments', count(bl_replies.id) as 'tot_replies' 
                FROM blogs LEFT JOIN bl_comments ON blogs.id = bl_comments.blog_id
                LEFT JOIN bl_replies ON bl_comments.id = bl_replies.comment_id
                GROUP BY blogs.id
                ORDER BY blogs.id DESC");
        
        if($run_q->num_rows()){
            return $run_q->result_array();
        }
    }
    
    
    
    /**
     * 
     * @param type $post_id
     * @param type $post_title
     * @return boolean
     */
    public function getBlogPost($post_id, $post_title){
        $q = "SELECT blogs.*, count(bl_comments.id) as 'tot_comments', count(bl_replies.id) as 'tot_replies'
            FROM blogs
            LEFT JOIN bl_comments ON blogs.id = bl_comments.blog_id
            LEFT JOIN bl_replies ON bl_comments.id = bl_replies.comment_id
            WHERE blogs.id = ? AND blogs.title LIKE '%$post_title%' AND blogs.published = 1";
        
        $run_q = $this->db->query($q, [$post_id]);
        
        if($run_q->num_rows()){
            return $run_q->row_array();
        }
        
        else{
            return FALSE;
        }
    }

    
    
    /**
     * 
     * @param type $post_id
     * @return boolean
     */
    public function getPostComments($post_id){
        $q = "SELECT id, comment_body, username, date_added, edited FROM bl_comments WHERE blog_id = ? ORDER BY id DESC";
            
        $run_q = $this->db->query($q, [$post_id]);
            
        if($run_q->num_rows()){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    /**
     * 
     * @param type $comment_id
     * @return boolean
     */
    public function getCommentReplies($comment_id){
        $q = "SELECT id, reply_body, username, date_added, edited FROM bl_replies WHERE comment_id = ?";
            
        $run_q = $this->db->query($q, [$comment_id]);
            
        if($run_q->num_rows()){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
}
