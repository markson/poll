<?php
class Poll_model extends CI_Model 
{
	public function __construct() 
	{
		$this->load->database();
	}
	public function get_poll($param) 
	{
		if($param == FALSE)
		{ 
			$this->db->select('id, title');
			return $this->db->get('question')->result();

		}
		else
		{
			$this->db->select('question.id, question.title, question.question, answer.answer')->from('answer')->join('question', 'answer.question_id = question.id')->where('question.id',$param);
			$query = $this->db->get();
			return $query->result();
		}
	}
	public function create_poll() 
	{
		$question = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('question')
		);
		$title = $this->input->post('title');
		$answers = array(
			'answer1' => $this->input->post('answer1'),
			'answer2' => $this->input->post('answer2')
		);

		if($this->db->insert('question', $question) == 1) {
			foreach($answers as $answer){
				$sql =<<<EOD
INSERT INTO answer(`content`, `question_id`) VALUES ('$answer', (SELECT `id` FROM question WHERE `title` = '$title'))
EOD;
				$this->db->query($sql);	
			}		
		}
		return $this->input->ip_address();
	}
}
?>
