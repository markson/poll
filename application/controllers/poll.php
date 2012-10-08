<?php
class Poll extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('poll_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	public function vote($param = NULL) 
	{
		$this->form_validation->set_rules('answer_id', 'option', 'required');
		if($this->form_validation->run() === FALSE)
		{	
			$data['title'] = "this is the vote page";
			$data['poll'] = $this->poll_model->get_poll($param);
				if(empty($data['poll'])) {
					show_404();
				}
			$this->load->view('template/header', $data);
			$this->load->view('poll/vote', $data);
			$this->load->view('template/footer');
		}
		else
		{
			if($this->poll_model->vote())
			{
				$this->load->view('poll/success');
			}	
		}
	}

	public function show($param = NULL){
		if(!empty($param))
		{	
			show_404();
		}
		else
		{
			$data['title'] = "These are all polls";
			$result_array = $this->poll_model->get_poll(FALSE);
			if(empty($result_array)) {
				show_404();
			}
			
			$data['list'] = $this->poll_model->get_anchor_array();
			$this->load->view('template/header', $data);
			$this->load->view('poll/list', $data);
			$this->load->view('template/footer');
		}
	}

	public function create() {
		$data['title'] = 'Create a poll items';
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('poll/create');
			$this->load->view('template/footer');
		} else {
			if($this->poll_model->create_poll())
			{
				$this->load->view('poll/success', $data);
			}
		}
	}
}
?>
