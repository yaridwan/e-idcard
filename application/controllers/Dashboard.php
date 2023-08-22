<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		$data['title'] = "Dashboard";
		$this->load->view('dashboard', $data);
	}
    
	function ajax($kondisi = "")
	{
		if($kondisi == "provinsi"){
			$post 			= $this->input->post();
			$id_provinsi	= antixss($post['id_provinsi']);
			$sdata			= $this->db->get_where('kabupaten', array('id_provinsi' => $id_provinsi));
			$html			= "<option></option>";
			foreach($sdata->result_array() as $ddata){
				$html		.= "<option value='".$ddata['id_kabupaten']."'>".$ddata['nm_kabupaten']."</option>";
			}
			$callback 		= array('data_kabupaten' => $html);
			echo json_encode($callback);
		}else if($kondisi == "kabupaten"){
			$post 			= $this->input->post();
			$id_kabupaten	= antixss($post['id_kabupaten']);
			$sdata			= $this->db->get_where('kecamatan', array('id_kabupaten' => $id_kabupaten));
			$html			= "<option></option>";
			foreach($sdata->result_array() as $ddata){
				$html		.= "<option value='".$ddata['id_kecamatan']."'>".$ddata['nm_kecamatan']."</option>";
			}
			$callback 		= array('data_kecamatan' => $html);
			echo json_encode($callback);
		}else if($kondisi == "kecamatan"){
			$post 			= $this->input->post();
			$id_kecamatan	= antixss($post['id_kecamatan']);
			$sdata			= $this->db->get_where('kelurahan', array('id_kecamatan' => $id_kecamatan));
			$html			= "<option></option>";
			foreach($sdata->result_array() as $ddata){
				$html		.= "<option value='".$ddata['id_kelurahan']."'>".$ddata['nm_kelurahan']."</option>";
			}
			$callback 		= array('data_kelurahan' => $html);
			echo json_encode($callback);
		}
	}

}
