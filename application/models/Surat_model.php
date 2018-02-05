<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}

	public function get_data_dashboard()
	{
		$masuk = $this->db->count_all('surat_masuk');
		return $masuk;
	}

	public function tambah_surat_masuk($file_surat)
	{
		$data = array(
			'nomor_surat' => $this->input->post('no_surat'),
			'tgl_kirim' => $this->input->post('tgl_kirim'),
			'tgl_terima' => $this->input->post('tgl_terima'),
			'pengirim' => $this->input->post('pengirim'),
			'penerima' => $this->input->post('penerima'),
			'perihal' => $this->input->post('perihal'),
			'file_surat' => $file_surat['file_name']
		);
		$this->db->insert('surat_masuk', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_surat_masuk()
	{
		return $this->db->get('surat_masuk')
						->result();
	}

}

/* End of file Surat_model.php */
/* Location: ./application/models/Surat_model.php */