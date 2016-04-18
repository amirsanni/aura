<?php
defined('BASEPATH') OR exit("");


/**
 * Description
 * @author: Amir Sanni <amirsanni@gmail.com>
 * @date: 18th April, 2016
 */


class Download extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	
	/**
	 *
	 * @param string $img_name
	 */
	public function blog($img_name){
		$img_full_link = "../aura_images/blog_images/$img_name";//set image full link
	
		$ext = "." . explode('.', $img_name)[1];//get the image's extension
	
		if(file_exists($img_full_link)){
			$this->output->set_content_type($ext)->set_output(file_get_contents($img_full_link));
		}
	}
}