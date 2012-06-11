<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
				
		$this->load->model('Question_model', '', TRUE);
	}
	
	public function add_user($value) {
		$result = $this->Question_model->remove_question('1');
		var_dump($result);
	}
}
