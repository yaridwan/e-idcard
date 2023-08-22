<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suratkeluar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
        $data['title'] = "Surat Keluar";
		$this->load->view('suratkeluar/data', $data);
	}
	
	function tambah($kondisi = "")
	{
        $data['title'] = "Tambah Surat Keluar";
		$this->load->view('suratkeluar/tambah', $data);
	}

    function edit($kondisi = "")
	{
        $data['title'] = "Edit Surat Keluar";
		$this->load->view('suratkeluar/edit', $data);
	}

	function detail($kondisi = "")
	{
        $data['title'] = "Detail Surat Keluar";
		$this->load->view('suratkeluar/detail', $data);
	}


	function addproses($kondisi = "")
	{
		$post = $this->input->post();
		if(isset($post['tambahin'])){
			$file_name = str_replace('.','',$post['noskeluar']);
			$config['upload_path']          = './berkas/skeluar/';
			$config['allowed_types']        = 'pdf';
			$config['file_name']            = $file_name;
			$config['overwrite']            = true;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('berkas')){
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Berkas gagal diupload</div>');
				redirect(base_url("suratkeluar/tambah"));
			}else{
				$uploaded_data = $this->upload->data();
					$post_data = array(
						"noskeluar" => $post['noskeluar'],
						"no_surat" => $post['no_surat'],
						"tanggal" => $post['tanggal'],
						"kepada" => $post['kepada'],
						"hal" => $post['hal'],
						"id_jenissurat" => $post['id_jenissurat'],
						"berkas" => $uploaded_data['file_name'],
						"useradd" => sesuser("id_user")
					);
					$proses = $this->db->insert("suratkeluar", $post_data);
					if($proses){
						$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menambah data</div>');
					}else{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah data</div>');
					}
				redirect(base_url("suratkeluar"));
			}
		}else if(isset($post['editin'])){
			if(empty($_FILES['berkas']['name'])){
				$post_data = array(
					"no_surat" => $post['no_surat'],
					"tanggal" => $post['tanggal'],
					"kepada" => $post['kepada'],
					"hal" => $post['hal'],
					"id_jenissurat" => $post['id_jenissurat']
				);
				$proses = $this->db->update("suratkeluar", $post_data, array("noskeluar" => $post['noskeluar']));
				if($proses){
					$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil mengedit data</div>');
				}else{
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengedit data</div>');
				}
				redirect(base_url("suratkeluar"));
			}else{
				$file_name = str_replace('.','',$post['noskeluar']);
				$config['upload_path']          = './berkas/skeluar/';
				$config['allowed_types']        = 'pdf';
				$config['file_name']            = $file_name;
				$config['overwrite']            = true;
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('berkas')){
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Berkas gagal diupload</div>');
					redirect(base_url("suratkeluar/tambah"));
				}else{
					$uploaded_data = $this->upload->data();
					$post_data = array(
						"no_surat" => $post['no_surat'],
						"tanggal" => $post['tanggal'],
						"kepada" => $post['kepada'],
						"hal" => $post['hal'],
						"id_jenissurat" => $post['id_jenissurat'],
						"berkas" => $uploaded_data['file_name']
					);
					$proses = $this->db->update("suratkeluar", $post_data, array("noskeluar" => $post['noskeluar']));
					if($proses){
						$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil mengedit data</div>');
					}else{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengedit data</div>');
					}
					redirect(base_url("suratkeluar"));
				}
			}
			
		}
		
	}
}
