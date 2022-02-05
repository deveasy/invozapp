<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_orders extends CI_Controller {

	
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }

		$this->load->model('sales_orders_model');

		$this->session_data = $this->session->userdata['logged_in'];
	}

	private $session_data;
	
	public function index()
	{
		$today = date('Y-m-d');
		$data['today'] = $today;
		$data['orders'] = $this->sales_orders_model->get_sales_by_date($today);
		$this->load->view('sales_orders/all',$data);
	}

	function view_order($order_id){
		$data['order'] = $this->sales_orders_model->get_sales_order($order_id);
		$data['order_details'] = $this->sales_orders_model->get_sales_order_details($order_id);
		$this->load->view('sales_orders/view', $data);
	}

	function new(){
		$data['order_id'] = $this->new_order_id();
		$this->load->view('sales_orders/new', $data);
	}

	public function productSearchList(){
		$postData = $this->input->post();

		$data = $this->sales_orders_model->productSearchList($postData);

		echo json_encode($data);
	}

	function new_order_id(){
	}

	function submit_order(){
		$this->print_order();
	}

	function filter_by_date(){
		$order_date = $this->input->post('filter-date');
		$data['today'] = $order_date;
		$data['orders'] = $this->sales_orders_model->get_sales_by_date($order_date);
		$this->load->view('sales_orders/view_sales_orders', $data);
	}

	public function print_order($order_id){
		
	}
}

/* End of file Sales_orders.php */
/* Location: ./application/controllers/Sales_orders.php */