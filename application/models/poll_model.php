<?php
class Poll_model extends CI_Model 
{
	public function __construct() 
	{
		$this->load->database();
	}
	public function get_poll($param = NULL) 
	{
		if($param == NULL)
		{ 
			$this->db->select('id, title');
			return $this->db->get('question')->result();

		}
		else
		{
			$this->db->select('question.id, question.title, question.question, answer.id, answer.answer')->from('answer')->join('question', 'answer.question_id = question.id')->where('question.id',$param);
			$query = $this->db->get();
			return $query->result();
		}
	}
	public function get_anchor_array()
	{
		$result_array = $this->poll_model->get_poll();
		foreach ($result_array as $item) {
			$anchor = anchor("poll/show/{$item->id}", $item->title, array('class' => 'my_link'));
			$new_array = array('anchor' => $anchor, 'title' => $item->title);
			$data[] = $new_array;
		}
		return $data;
	}

	public function create_poll() 
	{
		$question = array(
			'title' => $this->input->post('title'),
			'question' => $this->input->post('question')
		);
		$title = $this->input->post('title');
		$answers = array(
			'answer1' => $this->input->post('answer1'),
			'answer2' => $this->input->post('answer2')
		);

		if($this->db->insert('question', $question) == 1) {
			foreach($answers as $answer){
				$sql =<<<EOD
INSERT INTO answer(`answer`, `question_id`) VALUES ('$answer', (SELECT `id` FROM question WHERE `title` = '$title'))
EOD;
				$this->db->query($sql);	
			}		
		}
		return $this->input->ip_address();
	}
	public function vote() 
	{
		$vote = array(
			'answer_id' => $this->input->post('answer_id'),	
			'ip' => $this->input->ip_address()
		);
		return $this->db->insert('vote', $vote);
	}
	public function get_question_id($answer_id) {
		$this->db->select('question.id')->from('answer')->join('question', "answer.question_id = question.id")->where("answer.id = $answer_id");
		$query = $this->db->get();
		$result = $query->result();
		return $result[0]->id;
	}

	public function have_vote($question_id, $ip) {
		$this->db->select('question.title');
		$this->db->from('vote');
		$this->db->join('answer', 'vote.answer_id = answer.id');
		$this->db->join('question', 'answer.question_id = question.id');
		$this->db->where('question.id', $question_id);
		$this->db->where('vote.ip', $ip);
		$query = $this->db->get();
		return $result = $query->result();
		
		#return $this->db->count_all_result();
	}
}
?>
