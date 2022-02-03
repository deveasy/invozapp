<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller {

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }
	}

	public function index()
	{
		$this->load->view('view_invoices');
	}
}

/* End of file Welcome.php */
/* Location: ./application/controllers/Welcome.php */