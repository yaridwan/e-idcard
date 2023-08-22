<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}


	public function index()
	{
        $data['title'] = "Data Anggota";
		$this->load->view('anggota/data', $data);
	}
	
	function tambah($kondisi = "")
	{
        $data['title'] = "Tambah Data Anggota";
		$this->load->view('anggota/tambah', $data);
	}

    function edit($kondisi = "")
	{
        $data['title'] = "Edit Data Anggota";
		$this->load->view('anggota/edit', $data);
	}

	function detail($kondisi = "")
	{
        $data['title'] = "Detail Data Anggota";
		$this->load->view('anggota/detail', $data);
	}

	function addproses($kondisi = "")
	{
		$post = $this->input->post();
		if(isset($post['tambahin'])){
			$file_name = str_replace('.','',$post['nosmasuk']);
			$config['upload_path']          = './berkas/smasuk/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $file_name;
			$config['overwrite']            = true;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('berkas')){
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Berkas gagal diupload</div>');
				redirect(base_url("anggota/tambah"));
			}else{
				$uploaded_data = $this->upload->data();
				$post_data = array(
					"nosmasuk" => $post['nosmasuk'],
					"nm_anggota" => $post['nm_anggota'],
					"nip" => $post['nip'],
					"tanggal" => $post['tanggal'],
					"jabatan" => $post['jabatan'],
					"alamat" => $post['alamat'],
					"gol_darah" => $post['gol_darah'],
					"id_jk" => $post['id_jk'],
					"id_jenissurat" => $post['id_jenissurat'],
					"berkas" => $uploaded_data['file_name'],
					"useradd" => sesuser("id_user")
				);
				$proses = $this->db->insert("suratmasuk", $post_data);
				if($proses){
					$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menambah data</div>');
				}else{
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah data</div>');
				}
				redirect(base_url("anggota"));
			}
		}else if(isset($post['editin'])){
			if(empty($_FILES['berkas']['name'])){
				$post_data = array(
					"nosmasuk" => $post['nosmasuk'],
					"nm_anggota" => $post['nm_anggota'],
					"nip" => $post['nip'],
					"tanggal" => $post['tanggal'],
					"jabatan" => $post['jabatan'],
					"alamat" => $post['alamat'],
					"gol_darah" => $post['gol_darah'],
					"id_jk" => $post['id_jk'],
					"id_jenissurat" => $post['id_jenissurat'],
					"berkas" => $uploaded_data['file_name'],
					"useradd" => sesuser("id_user")
				);
				$proses = $this->db->update("suratmasuk", $post_data, array("nosmasuk" => $post['nosmasuk']));
				if($proses){
					$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil mengedit data</div>');
				}else{
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengedit data</div>');
				}
				redirect(base_url("anggota"));
			}else{
				$file_name = str_replace('.','',$post['nosmasuk']);
				$config['upload_path']          = './berkas/smasuk/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['file_name']            = $file_name;
				$config['overwrite']            = true;
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('berkas')){
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Berkas gagal diupload</div>');
					redirect(base_url("anggota/tambah"));
				}else{
					$uploaded_data = $this->upload->data();
					$post_data = array(
						"nosmasuk" => $post['nosmasuk'],
					"nm_anggota" => $post['nm_anggota'],
					"nip" => $post['nip'],
					"tanggal" => $post['tanggal'],
					"jabatan" => $post['jabatan'],
					"alamat" => $post['alamat'],
					"gol_darah" => $post['gol_darah'],
					"id_jk" => $post['id_jk'],
					"id_jenissurat" => $post['id_jenissurat'],
					"berkas" => $uploaded_data['file_name'],
					"useradd" => sesuser("id_user")
					);
					$proses = $this->db->update("suratmasuk", $post_data, array("nosmasuk" => $post['nosmasuk']));
					if($proses){
						$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil mengedit data</div>');
					}else{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengedit data</div>');
					}
					redirect(base_url("anggota"));
				}
			}
			
		}
		
	}

}
