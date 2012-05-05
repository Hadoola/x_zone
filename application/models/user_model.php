<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Who cares!
 */
class User_model extends CI_Model {
	
	const user_table = 'user';
	
	function __construct() {
		parent::__construct();
	}
	
	/*
	 * Add new user, return true if succeded else return false
	 * by default the user is inactive
	 */
	public function add_user($username, $password, $email, $name) {
		$newUser = array(
			'user_name' => $username,
			'password' => $password,
			'email' => $email,
			'name' => $name
		);
		 
		$this->db->insert(self::user_table, $newUser);
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
	
	public function is_username_exist($username) {
		$query = $this->db->get_where(self::user_table, array('user_name' => $username));
		if($query->num_rows() == 0){
			return TRUE;
		}
		else {
			return FALSE;	
		}
	}

	public function is_active($user_id) {
		$query = $this->db->get_where(self::user_table, array('id' => $user_id, 'active' => '1'));
		if($query->num_rows() == 1){
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	public function set_active($user_id, $value) {
		$this->db->set('active', $value);
		$this->db->where('id', $user_id);
		$this->db->update(self::user_table);
		return $this->db->affected_rows() ? TRUE : FALSE;
	}
}
