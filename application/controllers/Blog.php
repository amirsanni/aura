<?php

defined('BASEPATH') OR exit('');

/**
 * Description of Blog
 *
 * @author Ameer <amirsanni@gmail.com>
 * @date 30th RabAwwal, 1437AH
 * @date 11th Jan., 2016
 */
class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('blogmodel');
    }

    
    
    /**
     * 
     */
    public function index() {

        $json['curPage'] = "Blog";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Blog";

        $data['all_posts'] = $this->blogmodel->getAllPosts();

        $json['pageContent'] = $this->load->view('blogs/blog', $data, TRUE);

        $this->load->view('main', $json);
    }

    
    
    /**
     * 
     * @param int $id
     * @param string $title
     */
    public function view($id, $title) {
        $post_id = filter_var($id, FILTER_VALIDATE_INT);
        $post_title = str_replace("-", " ", filter_var($title));
        
        $json['curPage'] = "Blog";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Blog";

        $data['post_content'] = $this->blogmodel->getBlogPost($post_id, $post_title);

        if($data['post_content']){
            $data['title'] = $data['post_content']['title'];

            $json['pageContent'] = $this->load->view('blogs/blog_post', $data, TRUE);

            $this->load->view('main', $json);
        }
        
        else{
            //show custom 404 page
            //$this->load->view('error_page');
        }
    }

    
    
    /**
     * gpc = "Get post comments" 
     * @param type $post_id
     */
    public function gpc(){
        $this->genlib->ajaxOnly();
        
        $post_id = $this->input->get('pid', TRUE);
        
        $post_comments = $this->blogmodel->getPostComments($post_id);
        
        if($post_comments){
            $data['comments'] = $post_comments;
            
            $json['c'] = $this->load->view('blogs/blog_comments', $data, TRUE);
            $json['status'] = 1;
        }
        
        else{
            $json['status'] = 0;
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
