<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_out extends CI_Controller {

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }
	}
	
	public function index()
	{
		$this->load->view('view_locations', $data);
	}

	//function to print out receipt
	public function print_receipt()
	{
		//action goes here
	}

	//function to print out invoice A5 size
	public function print_invoice_a5()
	{
		//action goes here
	}

	//function to print out invoice A4 size
	public function print_invoice_a4()
	{
		//action goes here
	}
}

/* End of file Print_out.php */