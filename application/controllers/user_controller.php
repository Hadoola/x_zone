<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
				
		$this->load->model('File_manager_model', '', TRUE);
	}
	
	public function add_user($value)
	{
		$this->File_manager_model->create_directory('./uploads/Test/test2');
		//$result = $this->User_model->authinticate_user('koko', md5('koko'));
		//var_dump($result);
	}
}
