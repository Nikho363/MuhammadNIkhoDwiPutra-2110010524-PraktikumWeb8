<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Pembelian_model");
		$this->load->library('form_validation');
	}

	public function laporan()
	{
		$data = array(
			'title' => 'Tambah Laporan Data Pembelian',
			'content' => 'pembelian/laporan'
		);
		$this->load->view('template/main', $data);
	}

}
