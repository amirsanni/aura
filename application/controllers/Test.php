<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "functions.php";

/**
 * Description of Test
 *
 * @author Amir <amirsanni@gmail.com>
 * Date: May, 2015
 */

class Test extends CI_Controller {
    public $client = "";
    
    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function index(){
		$this->load->view('dropdown.html');
	}
}