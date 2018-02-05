<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('surat');
		} else {
			$data['title'] = "Login | SISurat";
			$this->load->view('login_view', $data);
		}
	}

	public function do_login()
	{
		if($this->session->userdata('logged_in') == TRUE){

			redirect('surat');

		} else {
			$this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->user_model->cek_user() == TRUE){
					$this->session->set_flashdata('notif', 'Login berhasil');
					redirect('surat');
				} else {
					$this->session->set_flashdata('notif', 'NIK atau password salah!');
					redirect('/');
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
				redirect('login');
			}	
		}
	}

	public function logout()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->session->sess_destroy();
			redirect('/');
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */