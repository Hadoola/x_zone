<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
				
		$this->load->model('Event_model', '', TRUE);
	}
	
	public function add_event()
	{
		$result = $this->Event_model->add_event('test', 'title text', 'body text', 'place text', '2012-06-22 12:30:00', 'section test');
		echo $result;
	}

	public function edit_event()
	{
		$result = $this->Event_model->edit_event(3, 'New Title!');
		echo $result;
	}
	
	public function delete_event()
	{
		$result = $this->Event_model->delete_event(2);
		echo $result;
	}
}