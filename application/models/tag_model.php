<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Tag_model extends CI_Model {
	
	const tag_table = 'tag';
	
	function __construct() {
		parent::__construct();
	}
	
	public function add_tag($name) {
		$tag = array('name' => $name);
		$query = $this->db->insert(self::tag_table, $tag);
		return $this->db->affected_rows() ? $this->db->insert_id() : FALSE;
	}

	public function get_tag_by_id($tag_id)	{
		$query = $this->db->get_where(self::tag_table, array('id' => $tag_id));
		if($query->num_rows() == 0) {
			return FALSE;
		}
		else {
			return $query->row();
		}
	}
		
	public function get_tag_by_name($name)	{
		$query = $this->db->get_where(self::tag_table, array('name' => $name));
		if($query->num_rows() == 0) {
			return FALSE;
		}
		else {
			return $query->row();
		}
	}
	
	public function remove_tag_by_id($tag_id) {
		$query = $this->db->delete(self::tag_table, array('id' => $tag_id));
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
	
	public function remove_tag_by_name($name) {
		$query = $this->db->delete(self::tag_table, array('name' => $name));
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
	
}
