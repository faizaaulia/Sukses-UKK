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

	public function get_surat_masuk_by_id($id_surat)
	{
		return $this->db->where('id_surat', $id_surat)
						->get('surat_masuk')
						->row();
	}

	public function get_jabatan()
	{
		return $this->db->get('jabatan')
						->result();
	}

	public function get_pegawai_by_jabatan($id_jabatan)
	{
		return $this->db->where('id_jabatan', $id_jabatan)
						->get('pegawai')
						->result();	
	}

	public function get_all_disposisi($id_surat)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
						->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
						->join('jabatan', 'disposisi.id_pegawai_pengirim = jabatan.id_jabatan')
						->where('disposisi.id_surat', $id_surat)
						->get('surat_masuk')
						->result();
	}

	/*public function get_all_disposisi_penerima($id_surat)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
						->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
						->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan')
						->where('disposisi.id_surat', $id_surat)
						->get('surat_masuk')
						->result();
	}*/

	public function tambah_disposisi($id_surat)
	{
		$data = array(
			'id_surat' => $id_surat,
			'id_pegawai_pengirim' => $this->session->userdata('id_pegawai'),
			'id_pegawai_penerima' => $this->input->post('tujuan_pegawai'),
			'keterangan' => $this->input->post('keterangan')
		);
		$this->db->insert('disposisi', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_all_disposisi_masuk($id_pegawai_penerima)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
						->join('pegawai', 'pegawai.id_pegawai = disposisi.id_pegawai_pengirim')
						->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
						->where('id_pegawai_penerima', $id_pegawai_penerima)
						->get('surat_masuk')
						->result();
	}

}

/* End of file Surat_model.php */
/* Location: ./application/models/Surat_model.php */