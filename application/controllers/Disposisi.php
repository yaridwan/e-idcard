<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Disposisi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		$data['title'] = "Riwayat Disposisi Surat";
		$this->load->view('disposisi/data', $data);
	}

}
