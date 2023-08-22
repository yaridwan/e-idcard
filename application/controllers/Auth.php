<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin');
    }
    public function index()
    {
        if ($this->session->userdata('authenticated'))
            redirect('dashboard');
        $data['title'] = "Login";
        $this->load->view('login', $data);
    }
    
    public function login()
    {
        $username 	= $this->input->post('username');
        $password 	= md5($this->input->post('password'));
        $user 		= $this->Mlogin->get($username);
        if (empty($user)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Username tidak ditemukan</div>');
            redirect('auth');
        } else {
            if ($password == $user->password) {
					$session = array(
						'authenticated' 	=> true,
						'id_pengguna' 			=> $user->id_pengguna
					);
					$this->session->set_userdata($session);
					redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><b>Username</b> dan <b>Password</b> tidak cocok</div>');
                redirect('auth');
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
   
}
