<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		redirect(base_url("dashboard"));
	}
    
    public function ttd()
	{
		$data['title'] = "Master TTD";
		$this->load->view('master/ttd', $data);
	}

    public function jenisstatus()
	{
		$data['title'] = "Master Jenis Status";
		$this->load->view('master/jenisstatus', $data);
	}

	public function sifat()
	{
		$data['title'] = "Master Sifat Surat";
		$this->load->view('master/sifat', $data);
	}
}
