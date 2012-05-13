<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
				
		$this->load->model('Tag_model', '', TRUE);
	}
	
	public function add_user($value) {
		echo utf8_decode($value);
		
		//$result = $this->Tag_model->add_tag($value);
		//var_dump($result);
	}
}
