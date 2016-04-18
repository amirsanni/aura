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
        $this->load->model('Blogmodel');
        $this->load->helper('url_helper');
        $this->load->helper('text');
    }

    
    
    /**
     * 
     */
    public function index() {

        $json['curPage'] = "blog";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Blog";

        $data['news'] = $this->Blogmodel->get_news();

        $json['pageContent'] = $this->load->view('blog', $data, TRUE);

        $this->load->view('main', $json);
    }

    
    
    /**
     * 
     * @param unknown $id
     * @param unknown $title
     */
    public function view($id, $title) {

        $json['curPage'] = "blog";
        $json['pageTitle'] = "Design Aura: Connecting the dots:Blog";

        $data['news_item'] = $this->Blogmodel->get_news($id, $title);

        
        if (empty($data['news_item'])) {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $json['pageContent'] = $this->load->view('blog_post', $data, TRUE);

        $this->load->view('main', $json);
    }

}
