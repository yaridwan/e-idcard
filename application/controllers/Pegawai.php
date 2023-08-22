<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		$data['title'] = "Data Pegawai";
		$this->load->view('pegawai/data', $data);
	}
    
    public function tambah()
	{
		$data['title'] = "Tambah Pegawai";
		$this->load->view('pegawai/tambah', $data);
	}

    public function edit()
	{
		$data['title'] = "Edit Pegawai";
		$this->load->view('pegawai/edit', $data);
	}
}
