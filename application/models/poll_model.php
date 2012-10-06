<?php
class Poll_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function get_poll($parameter = FALSE) {
		if($parameter == FALSE) {		
			$query = $this->db->get('question');
			return $query->result_array();
		} else {
			$this->db->select('id, title, description')->from('question')->where('id',$parameter);
			$query = $this->db->get();
			return $query->result_array();
		}
	}
	public function new_poll() {
		
	}
}
?>
