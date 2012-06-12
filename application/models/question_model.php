<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Question_model extends CI_Model {
	
	const question_table = 'question';
	const question_file_table = 'question_file';
	const question_tag_table = 'question_tag';
	
	function __construct() {
		parent::__construct();		
	}
	
	public function add_question($section_id, $user_id, $title, $body, $tags, $files) {
		$this->db->trans_start();
		
		// insert new question
		$question_data = array(
			'fk_section_id' => $section_id,
			'fk_user_id' => $user_id,
			'fk_answer_id' => NULL,
			'title' => $title,
			'body' => $body,
			'creation_time' => date("d/m/y : h:i:s", time())
		);
		
		$this->db->insert(self::question_table, $question_data);
		$question_id = $this->db->insert_id();
		
		if($tags != NULL){
			// insert question tags
			foreach ($tags as $tag_id) {
				$this->db->insert(self::question_tag_table, Array('fk_question_id' => $question_id, 'fk_tag_id' => $tag_id));
			}
		}
		
		if($files != NULL){
			// insert question files
			foreach ($files as $file_id) {
				$this->db->insert(self::question_file_table, Array('fk_question_id' => $question_id, 'fk_file_id' => $file_id));
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
	
	public function select_answer($question_id, $answer_id){
		$this->db->set('fk_answer_id', $answer_id);
		$this->db->where('id', $question_id);
		$this->db->update(self::question_table);
		
		return $this->db->affected_rows() ? TRUE : FALSE;	
	}

	public function remove_question($question_id){
		$this->db->trans_start();
		
		// delete tags
		$this->db->delete(self::question_tag_table, array('fk_question_id' => $question_id));
		
		// delete files
		$this->db->delete(self::question_file_table, array('fk_question_id' => $question_id));
		
		// deete question
		$this->db->delete(self::question_table, array('id' => $question_id));
		
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
}