<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Satuan_model");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = array(
			'title' => 'View Data Satuan',
            'userlog' => infoLogin(),
			'satuan' => $this->Satuan_model->getAll(),
			'content' => 'satuan/index'
		);
		$this->load->view('template/main', $data);
	}


}
