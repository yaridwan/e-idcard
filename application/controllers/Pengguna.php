<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		$data['title'] = "Data Pengguna";
		$this->load->view('pengguna/data', $data);
	}
    
    public function tambah()
	{
		$data['title'] = "Tambah Pengguna";
		$this->load->view('pengguna/tambah', $data);
	}

    public function edit()
	{
		$data['title'] = "Edit Pengguna";
		$this->load->view('pengguna/edit', $data);
	}
}
