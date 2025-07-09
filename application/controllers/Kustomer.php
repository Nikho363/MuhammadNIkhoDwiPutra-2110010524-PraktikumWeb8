<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kustomer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Kustomer_model");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = array(
			'title' => 'View Data Kustomer',
            'userlog' => infoLogin(),
			'kustomer' => $this->Kustomer_model->getAll(),
			'content' => 'kustomer/index'
		);
		$this->load->view('template/main', $data);
	}

	public function laporan()
	{
		$data = array(
			'title' => 'Tambah Laporan Data Kustomer',
			'content' => 'kustomer/laporan'
		);
		$this->load->view('template/main', $data);
	}

}
