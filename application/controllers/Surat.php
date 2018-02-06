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
				$data['data_disposisi'] = $this->surat_model->get_all_disposisi_masuk($this->session->userdata('id_pegawai'));
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

	public function disposisi($id_surat)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('jabatan') == "Sekretaris") {
				$data['main_view'] = 'admin/disposisi_sekretaris_view';
				$data['title'] = "Tambah Disposisi Surat";
				$data['data_surat'] = $this->surat_model->get_surat_masuk_by_id($this->uri->segment(3));
				$data['jabatan'] = $this->surat_model->get_jabatan();
				$data['data_disposisi'] = $this->surat_model->get_all_disposisi($id_surat);

				$this->load->view('template_view', $data);	
			}
		} else {
			redirect("/");
		}
	}

	public function get_pegawai_by_jabatan($id_jabatan)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data_pegawai = $this->surat_model->get_pegawai_by_jabatan($id_jabatan);
			echo json_encode($data_pegawai);
		} else {
			redirect('/');
		}
	}

	public function tambah_disposisi()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$this->form_validation->set_rules('tujuan_pegawai', 'Tujuan Pegawai', 'trim|required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->surat_model->tambah_disposisi($this->uri->segment(3)) == TRUE ){
					$this->session->set_flashdata('notif', 'Tambah disposisi berhasil!');
					if($this->session->userdata('jabatan') == 'Sekretaris'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
					}			
				} else {
					$this->session->set_flashdata('notif', 'Tambah disposisi gagal!');
					if($this->session->userdata('jabatan') == 'Sekretaris'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
					}		
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
				if($this->session->userdata('jabatan') == 'Sekretaris'){
					redirect('surat/disposisi/'.$this->uri->segment(3));
				} else {
					redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
				}			
			}
		} else {
			redirect('login');
		}
	}

	public function disposisi_keluar($id_surat)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['main_view'] = 'pegawai/disposisi_keluar_view';
			$data['title'] = 'Disposisi Keluar';
			$data['data_surat'] = $this->surat_model->get_surat_masuk_by_id($this->uri->segment(3));
			$data['jabatan'] = $this->surat_model->get_jabatan();
			$data['data_disposisi'] = $this->surat_model->get_all_disposisi($id_surat);

			$this->load->view('template_view', $data);
		} else {
			redirect('/');
		}
	}

}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */