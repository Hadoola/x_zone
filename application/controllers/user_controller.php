<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
				
		$this->load->model('Answer_model', '', TRUE);
	}
	
	public function add_user($value) {
		$result = $this->Answer_model->remove_answer('1');
		var_dump($result);
	}
}
