<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcement_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
				
		$this->load->model('Announcement_model', '', TRUE);
	}
	
	public function add_announcement()
	{
		$result = $this->Announcement_model->add_announcement(1, 'section test', 'title text', 'body text');
		echo $result;
	}
	
	public function edit_announcement()
	{
		$result = $this->Announcement_model->edit_announcement(4, 2, NULL, 'title text');
		echo $result;
	}
	
	public function delete_announcement()
	{
		$result = $this->Announcement_model->delete_announcement(2);
		echo $result;
	}
}