<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Answer_model extends CI_Model {
	
	const answer_table = 'answer';
	const answer_file_table = 'answer_file';
	
	function __construct() {
		parent::__construct();
	}
	
	public function add_answer($user_id, $question_id, $body, $files){
		$this->db->trans_start();
		
		// insert new answer
		$answer_data = Array(
			'fk_user_id' => $user_id,
			'fk_question_id' => $question_id,
			'body' => $body,
			'rate' => '0',
			'creation_time' => date("d/m/y : h:i:s", time())
		);
		
		$this->db->insert(self::answer_table, $answer_data);
		$answer_id = $this->db->insert_id();
		
		if($files != NULL){
			// insert answer files
			foreach ($files as $file_id) {
				$this->db->insert(self::answer_file_table, Array('fk_answer_id' => $answer_id, 'fk_file_id' => $file_id));
			}
		}
		
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			return FALSE;
		}
		else{
			return TRUE;
		}		
	}
	
	public function adjust_rate($answer_id, $value = 0){
		$query = $this->db->get_where(self::answer_table, Array('id' => $answer_id));
		if($this->db->affected_rows()){
			$rate = $query->row()->rate;
			
			if($rate + $value >= 0){
				$this->db->set('rate', $rate + $value);
				$this->db->where('id', $answer_id);
				$this->db->update(self::answer_table);		
			}
		}
		return TRUE;	
	}
	
	public function remove_answer($answer_id){
		$this->db->trans_start();
		
		// delete files
		$this->db->delete(self::answer_file_table, array('fk_answer_id' => $answer_id));
		
		// deete answer
		$this->db->delete(self::answer_table, array('id' => $answer_id));
		
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			return FALSE;
		}
		else{
			return TRUE;
		}		
	}
}
