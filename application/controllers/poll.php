<?php
class Poll extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('poll_model');
		$this->load->helper('html');
		$this->load->helper('url');
	}
	public function show($param = FALSE) {
		if ($param == FALSE) {
			$data['title'] = "These are all polls";
			$result_array = $this->poll_model->get_poll($param);
			if(empty($result_array)) {
				show_404();
			}
			foreach ($result_array as $item) {
				$anchor = anchor("poll/show/{$item->id}", $item->title, array('class' => 'my_link'));
				$new_array = array('anchor' => $anchor, 'title' => $item->title);
				$data['list'][] = $new_array;
			}
			$this->load->view('template/header', $data);
			$this->load->view('poll/list', $data);
			$this->load->view('template/footer');
		} else {
			$data['title'] = "This is the content of $param poll";

			$data['poll'] = $this->poll_model->get_poll($param);
				if(empty($data['poll'])) {
					show_404();
				}
			$this->load->view('template/header', $data);
			$this->load->view('poll/show', $data);
			$this->load->view('template/footer');
		}
	}
	public function create() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['title'] = 'Create a poll items';
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('poll/create');
			$this->load->view('template/footer');
		} else {
			$data['return_value'] = $this->poll_model->create_poll();
			
			$this->load->view('poll/success', $data);
		}
	}
}
?>
