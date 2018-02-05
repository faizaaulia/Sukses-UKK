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

	public function tambah_surat_masuk()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('jabatan') == "Sekretaris") {
				$this->form_validation->set_rules('no_surat', 'No.Surat', 'trim|required');
				$this->form_validation->set_rules('tgl_kirim', 'Tgl.Kirim', 'trim|required|date');
				$this->form_validation->set_rules('tgl_terima', 'Tgl.Kirim', 'trim|required|date');
				$this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|required');
				$this->form_validation->set_rules('penerima', 'Penerima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					$config['upload_path'] 		= './uploads/';
					$config['allowed_types']	= 'pdf';
					$config['max_size']			= 2000;

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('file_surat')) {
						if ($this->surat_model->tambah_surat_masuk($this->upload->data()) == TRUE) {
							$this->session->set_flashdata('notif', 'Tambah surat berhasil!');
							redirect('surat/surat_masuk');
						} else {
							$this->session->set_flashdata('notif', 'Tambah surat gagal!');
							redirect('surat/surat_masuk');	
						}
					} else {
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/surat_masuk');	
					}
				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/surat_masuk');	
				}	
			}
		} else {
			redirect("/");
		}
	}

}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */