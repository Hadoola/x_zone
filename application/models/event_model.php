<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_model extends CI_Model {
	
	const event_table = 'event';
	
	function __construct() {
		parent::__construct();
	}
	
	/*
	 * Add new event, section name must be the english name
	 * section and map url are optional parameters
	 * returns the event id on success, false otherwise.
	 */
	public function add_event($user_id, $title, $body, $place, $time, $section_id = NULL, $map_url = NULL)
	{
		$new_event = array('fk_section_id' => $section_id, 
		                          'fk_user_id' => $user_id,
								  'title' => $title,
								  'body' => $body,
								  'event_place' => $place,
								  'map_url' => $map_url,
								  'event_time' => $time);
		$this->db->insert(self::event_table, $new_event);
		return $this->db->affected_rows() ? $this->db->insert_id() : FALSE;
	}
	
	/*
	 * Edit an existing event. Event Id must be provided
	 * returns true on success, false otherwise.
	 */
	public function edit_event($event_id, $user_id, $title = NULL, $body = NULL, $place = NULL, $time = NULL, $section_id = NULL, $map_url = NULL)
	{
		$new_data = array();
		if($section_id != NULL)
			$new_data['fk_section_id'] = $section_id;
		if($title != NULL)
			$new_data['title'] = $title;
		if($body != NULL)
			$new_data['body'] = $body;
		if($place != NULL)
			$new_data['event_place'] = $place;
		if($map_url != NULL)
			$new_data['map_url'] = $map_url;
		if($time != NULL)
			$new_data['event_time'] = $time;
		if(!count($new_data))
			return false;
		$new_data['fk_last_edit_user_id'] = $user_id;
		$new_data['edit_time'] = date("d/m/y : H:i:s", time());
		$this->db->where('id', $event_id)->update(self::event_table, $new_data);
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
	
	/*
	 * Delete event, Id provided
	 * returns true on success, false otherwise.
	 */
	public function delete_event($event_id)
	{
		$this->db->where('id', $event_id)->delete(self::event_table);
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
}