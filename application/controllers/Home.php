<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['main_view'] = 'home_view';
		$this->load->view('template_view', $data);		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */