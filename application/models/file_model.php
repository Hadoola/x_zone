<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class File_model extends CI_Model {
	
	const file_table = 'file';
	
	function __construct() {
		parent::__construct();
	}
	
	public function add_file($file_name, $full_path, $client_name, $file_ext, $file_size, $is_image, $image_width = NULL, $image_height = NULL, $image_type = NULL) {
		$file = array(
			'file_name' 	=> $file_name,
			'full_path' 	=> $full_path,
			'client_name' 	=> $client_name,
			'file_ext' 		=> $file_ext,
			'file_size'	 	=> $file_size,
			'is_image' 		=> $is_image,
			'image_width' 	=> $image_width,
			'image_height' 	=> $image_height
		);
		
		$query = $this->db->insert(self::file_table, $file);
		return $this->db->affected_rows() ? $this->db->insert_id() : FALSE;
	}
	
	public function get_file_by_id($file_id) {
		$query = $this->db->get_where(self::file_table, array('id' => $file_id));
		if($query->num_rows() == 0) {
			return FALSE;
		}
		else {
			return $query->row();
		}
	}
	
	public function remove_file_by_id($file_id) {
		$query = $this->db->delete(self::file_table, array('id' => $file_id));
		return $this->db->affected_rows() ? TRUE : FALSE;	
	}
}
