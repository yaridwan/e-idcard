<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Musers extends CI_Model
{
	//VARIABEL NAMA TABEL
	private $_users					= "pengguna";

    
    public function useraksi($data = "", $id = "")
    {
		if($data == "byid"){
			$post = $this->input->post();
			return $this->db->get_where($this->_users, array('id_pengguna' => $post["id_pengguna"]))->result();
		}
    }
}
