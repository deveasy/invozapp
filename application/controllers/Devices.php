<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devices extends CI_Controller {

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }
        $this->load->model('Devices_model');
	}
	public function index()
	{
		$this->load->view('view_customers');
	}

	public function waybill(){
		$data['shops'] = $this->customers_model->get_shops();
		$data['warehouses'] = $this->customers_model->get_warehouses();
		$data['products'] = $this->customers_model->get_products();
		$this->load->view('customer_waybill', $data);
	}
}

/* End of file Welcome.php */
/* Location: ./application/controllers/Welcome.php */