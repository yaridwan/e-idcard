<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		redirect(base_url("beranda"));
	}

    public function suratmasuk()
	{
		$data['title'] = "Lap. Surat Masuk";
		$this->load->view('form_lap/suratmasuk', $data);
	}

	public function suratkeluar()
	{
		$data['title'] = "Lap. Surat Keluar";
		$this->load->view('form_lap/suratkeluar', $data);
	}

	public function disposisi()
	{
		$data['title'] = "Lap. Riwayat Disposisi";
		$this->load->view('form_lap/disposisi', $data);
	}
}
