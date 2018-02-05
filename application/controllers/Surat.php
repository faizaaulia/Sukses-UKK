<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('jabatan') == 'Sekretaris') {
				$data['main_view'] = 'admin/dashboard_view';
				$data['dashboard'] = $this->surat_model->get_data_dashboard();
				$data['title'] = "Dashboard Admin | SISurat";
				$this->load->view('template_view', $data);
			} else {
				$data['main_view'] = 'pegawai/dashboard_view';
				$data['title'] = "Dashboard Pegawai | SISurat";
				$this->load->view('template_view', $data);
			}
		} else {
			redirect('/');
		}
	}

	public function surat_masuk()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('jabatan') == "Sekretaris") {
				$data['main_view'] = "admin/data_surat_masuk_view";
				$data['surat_masuk'] = $this->surat_model->get_surat_masuk();
				$data['title'] = "Surat Masuk | SISurat";
				$this->load->view('template_view', $data);
			}
		} else {
			redirect('/');
		}
	}

}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */