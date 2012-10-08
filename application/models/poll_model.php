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
}
?>
