<?php
class Poll extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('poll_model');
	}
	public function show($param = FALSE) {
		$data['poll'] = $this->poll_model->get_poll($param);
		if(empty($data['poll'])) {
			show_404();
		}
		$this->load->view('template/header');
		$this->load->view('poll/show', $data);
		$this->load->view('template/footer');
	}
	public function create() {
		$this->load->helper('form');
		#$this->load->library('form_validation');

		if (isset($_GET['submit']) && $_GET['submit'] == 'send') {
			echo "this is really good";
		} else {
			$this->load->view('template/header');
			$this->load->view('poll/create');
			$this->load->view('template/footer');
		}
	}
}
?>
