<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcement_model extends CI_Model {
	
	const announcement_table = 'announcement';
	
	function __construct() {
		parent::__construct();
	}
	
	/*
	 * Add new announcement, return id for success, false otherwise
	 * assume data is already checked for permissions. section name is the english name!
	 */
	public function add_announcement($user_name, $section, $title, $body)
	{
		$user_id = $this->db->where('user_name', $user_name)->limit('1')->get('user')->row()->id;
		$section_id = $this->db->where('name_en', $section)->limit('1')->get('section')->row()->id;
		$new_announcement = array('fk_section_id' => $section_id, 
		                          'fk_user_id' => $user_id,
								  'title' => $title,
								  'body' => $body);
		$this->db->insert(self::announcement_table, $new_announcement);
		return $this->db->affected_rows() ? $this->db->insert_id() : FALSE;
	}
	
	/*
	 * Edit an existing announcement. Annoucement Id must be provided
	 * returns true on success, false otherwise.
	 */
	public function edit_announcement($announcement_id, $user_name, $section = NULL, $title = NULL, $body = NULL)
	{
		$new_data = array();
		if($section != NULL)
			$new_data['fk_section_id'] = $this->db->where('name_en', $section)->limit('1')->get('section')->row()->id;
		if($title != NULL)
			$new_data['title'] = $title;
		if($body != NULL)
			$new_data['body'] = $body;
		if(!count($new_data))
			return false;
		$new_data['fk_last_edit_user_id'] = $this->db->where('user_name', $user_name)->limit('1')->get('user')->row()->id;
		$this->db->where('id', $announcement_id)->update(self::announcement_table, $new_data);
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
	
	/*
	 * Delete announcement, Id provided
	 * returns true on success, false otherwise.
	 */
	public function delete_announcement($announcement_id)
	{
		$this->db->where('id', $announcement_id)->delete(self::announcement_table);
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
}