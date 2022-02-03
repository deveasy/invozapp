<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_model');
	}

	public function user_get(){
		$r = $this->inventory_model->get_products();
		$this->response($r);
	}

	public function user_put(){
		$id = $this->uri->segment(3);

		$data = array(
			'name' => $this->input->get('name'),
			'pass' => $this->input->get('pass'),
			'type' => $this->input->get('type')
		);

		$r = $this->inventory_model->update_product($id, $data);
		$this->response($r);
	}

	public function user_post(){
		$data = array(
			'name' => $this->input->post('name'),
			'pass' => $this->input->post('pass'),
			'type' => $this->input->post('type')
		);
		$r = $this->inventory_model->insert_product($data);
		$this->response($r);
	}

	public function user_delete(){
		$id = $this->uri->segment(3);
		$r = $this->inventory_model->delete_product($id);
		$this->response($r);
	}
}