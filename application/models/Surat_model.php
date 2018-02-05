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

	public function get_surat_masuk()
	{
		return $this->db->get('surat_masuk')
						->result();
	}

}

/* End of file Surat_model.php */
/* Location: ./application/models/Surat_model.php */