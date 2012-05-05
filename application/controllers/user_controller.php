<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
				
		$this->load->model('User_model', '', TRUE);
	}
	
	public function add_user($value)
	{
		$result = $this->User_model->set_active('1', 1);
		echo $result;
	}
}
