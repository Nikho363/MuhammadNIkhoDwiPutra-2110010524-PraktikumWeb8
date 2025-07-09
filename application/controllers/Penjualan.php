<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Penjualan_model");
		$this->load->library('form_validation');
	}

	public function laporan()
	{
		$data = array(
			'title' => 'Tambah Laporan Data Penjualan',
			'content' => 'penjualan/laporan'
		);
		$this->load->view('template/main', $data);
	}

}
