<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		$data['title'] = "Profil Saya";
		$this->load->view('profil', $data);
	}

    function addgambarproses(){
		$post = $this->input->post();
		if(isset($post['editingambar'])){
			$file_name = str_replace('.','',random());
			$config['upload_path']          = './berkas/user/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $file_name;
			$config['overwrite']            = true;
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('berkas')){
				$this->session->set_flashdata('pesen', '<div class="alert alert-danger">Berkas gagal diupload</div>');
				redirect(base_url("profil"));
			}else{
				$uploaded_data = $this->upload->data();
				$post_data = array(
					"gambar" => $uploaded_data['file_name']
				);
				$proses = $this->db->update("pengguna", $post_data, array("id_pengguna" => sesuser("id_pengguna")));
				if($proses){
					$this->session->set_flashdata('pesen', '<div class="alert alert-success">Berhasil menyimpan data</div>');
				}else{
					$this->session->set_flashdata('pesen', '<div class="alert alert-danger">Gagal menyimpan data</div>');
				}
				redirect(base_url("profil"));
			}
		}
	}
}
