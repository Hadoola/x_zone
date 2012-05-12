<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class File_manager_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		
		$this->load->helper('directory');
		$this->load->helper('file');
	}
	
	public function create_directory($dir = NULL, $mode = 0777, $recursive = TRUE) {
		if($dir == NULL) {
			return FALSE;
		}
		if (file_exists($dir)) {
			return TRUE;
		}
		
		return mkdir($dir, $mode, $recursive);
	}
}
