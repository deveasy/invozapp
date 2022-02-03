<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }

		$this->load->model('products_model');
	}

	public function index()
	{
		$data['shop_name'] = '';
		$data['shop_id'] = '';
		$data['shops'] = $this->products_model->get_shops();
		$data['products'] = $this->products_model->get_products();
		$this->load->view('view_products',$data);
	}

	public function shop_products(){
		if($this->input->post('shop') == 'all'){
			redirect('products');
		}
		else{
			if($this->uri->segment(3)){
				$shop_id = $this->uri->segment(3);
			}
			else{
				$shop_id = $this->input->post('shop');
			}
		}

		$data['shop_id'] = $shop_id;
		$data['shop_name'] = $this->products_model->get_shop_name($shop_id)->shop_name;
		$data['shops'] = $this->products_model->get_shops();
		$data['products'] = $this->products_model->get_shop_products($shop_id);

		$this->load->view('view_shop_products', $data);
	}

	public function product_categories(){
		$data['categories'] = $this->products_model->get_product_categories();
		$this->load->view('add_product_category', $data);
	}

	public function add_category(){
		$this->products_model->add_product_category();

		redirect('products/product_categories');
	}

	public function add_new_product(){
		$data['product_code'] = $this->new_product_code();
		$data['categories'] = $this->products_model->get_product_categories();
		$data['shops'] = $this->products_model->get_shops();
		$this->load->view('add_product', $data);
	}

	public function add_product(){
		$this->products_model->add_product();
		$this->session->set_flashdata('product_add','Product successfully added');
		
		//add the new product to shop inventory
		$add_option = $this->input->post('add_option');
		if($add_option == 'all'){
			$shops = $this->products_model->get_shops();
			foreach($shops as $shop){
				$this->products_model->add_product_to_shop($shop->shop_id, 2000);
			}
		}
		else{
			$this->products_model->add_product_to_shop($add_option, 2000);
		}
		
		redirect('products');
	}

	private function new_product_code(){
		$current_code = $this->products_model->get_latest_code()->product_code;
		$str1 = substr($current_code, 0, 5);
		$str2 = substr($current_code, 5);
		$sum = $str2 + 1;
		
		return $str1.$sum;
	}

	public function edit_product($id){
		$data['product'] = $this->products_model->get_product($id);
		$data['shops'] = $this->products_model->get_shops();
		$this->load->view('edit_product',$data);
	}

	function edit_shop_product($product_code, $shop_id){
		$data['shop_id'] = $shop_id;
		$data['product'] = $this->products_model->get_shop_product($product_code, $shop_id);
		$this->load->view('edit_shop_product', $data);
	}

	public function update_product($product_code){
		$update_option = $this->input->post('update_option');
		
		if(!empty($update_option)){
			if($update_option == 'all'){
				$this->products_model->update_price($product_code);
				$this->session->set_flashdata('product_update','Product has been updated successfully.');
				redirect('products');
			}
			else{
				$this->products_model->update_shop_price($product_code, $update_option);
				$this->session->set_flashdata('product_update','Product has been updated successfully.');
				redirect('products');
			}
		}
		else{
			$this->products_model->update_product($product_code);
			$this->products_model->update_price($product_code);
			$this->session->set_flashdata('product_update','Product has been updated successfully.');
			redirect('products');
		}
	}

	function update_shop_product($product_code, $shop_id){
		$this->products_model->update_shop_price($product_code, $shop_id);
		$this->session->set_flashdata('product_update','Product has been updated successfully.');
		redirect('products/shop_products/'.$shop_id);
	}

	//update the quantities for each product in shop
	//after taking of stock with csv file
	public function update_quantities(){
		if(isset($_POST['submit'])){
			$filename = $_FILES['file']['tmp_name'];

			if($_FILES['file']['size'] > 0){
				$file = fopen($filename, 'r');

				while(($getData = fgetcsv($file, 10000,',')) !== FALSE){
					$this->products_model->update_shop_product_quantity($getData[0], $getData[1], $getData[2]);
				}
				fclose($file);
			}
		}
		redirect('products');
	}

	function import_products(){
	    if(isset($_POST['submit'])){
	        $filename = $_FILES['file']['tmp_name'];

	        if($_FILES['file']['size'] > 0){
	            $file = fopen($filename, 'r');

	            while(($getData = fgetcsv($file, 10000, ',')) !== FALSE){
	                $this->products_model->import_products($getData[0], $getData[1], $getData[2], $getData[3]);
                }
                fclose($file);
            }
        }
    }

	//function to export from the database
	public function export(){
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		$output = fopen('php://output', 'w');
		fputcsv($output, array('ID', 'first name','last name'));

		$results = $this->products_model->get_data_from_database();
		foreach($results as $result){
			fputcsv($output, $result);
		}
		fclose($output);
	}

	public function update_prices(){
		$shops = $this->products_model->get_shops();
		$products = $this->products_model->get_products();

		foreach($products as $product){
			$this->products_model->update_prices($product->product_code, $product->unit_price);
			redirect('products');
		}
	}
}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */