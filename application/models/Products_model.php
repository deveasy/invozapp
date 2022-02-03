<?php

class Products_model extends CI_Model{
	
	public function get_products(){
		$query = $this->db->get('products');
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return false;
		}
	}

	function get_location_products($location_id){
		$this->db->select('location_inventory.product_code, product_name, product_category, location_inventory.unit_price');
		$this->db->from('location_inventory');
		$this->db->join('products','location_inventory.product_code = products.product_code');
		$this->db->where('location_id', $location_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function get_product_categories(){
		$query = $this->db->get('product_categories');
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function add_product_category(){
		$data = array(
			'category_name' => strtoupper($this->input->post('category_name')),
			'category_description' => $this->input->post('category_description')
		);
		$this->db->insert('product_categories', $data);
	}

	public function get_latest_code(){
		$this->db->select('product_code');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get('products');
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return false;
		}

	}

	public function add_product(){
		$product_name = strtoupper($this->input->post('product_name'));
		$data = array(
			'product_code' => $this->input->post('product_code'),
			'product_name' => $product_name,
			'product_category' => strtoupper($this->input->post('product_category')),
			'unit_price' => $this->input->post('unit_price'),
			'reorder_level' => $this->input->post('reorder_level')
		);
		$this->db->insert('products',$data);
	}

	public function add_product_to_shop($location_id, $quantity){
		$data = array(
			'location_id' => $location_id,
			'product_code' => $this->input->post('product_code'),
			'unit_price' => $this->input->post('unit_price'),
			'quantity_in_stock' => $quantity
		);
		$this->db->insert('location_inventory', $data);
	}

	public function get_product($id){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('product_code',$id);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return false;
		}
	}

	function get_shop_product($product_code, $location_id){
		$this->db->select('location_inventory.product_code, product_category, product_name, location_inventory.unit_price, reorder_level');
		$this->db->from('location_inventory');
		$this->db->join('products','products.product_code = location_inventory.product_code');
		$this->db->where('location_id', $location_id);
		$this->db->where('location_inventory.product_code', $product_code);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return false;
		}
	}

	public function update_shop_product_quantity($location_id, $code, $qty){
		$data = array(
			'quantity_in_stock' => $qty
		);
		$this->db->where('location_id', $location_id);
		$this->db->where('product_code', $code);
		$this->db->update('location_inventory', $data);
	}

	public function update_product($id){
		$data = array(
			'product_code' => $this->input->post('product_code'),
			'product_name' => $this->input->post('product_name'),
			'product_category' => $this->input->post('product_category'),
			'unit_price' => $this->input->post('unit_price'),
			'reorder_level' => $this->input->post('reorder_level')
		);
		$this->db->where('product_code',$id);
		$this->db->update('products',$data);
	}

	public function update_price($product_code){
		$data = array(
			'unit_price' => $this->input->post('unit_price')
		);
		$this->db->where('product_code',$product_code);
		$this->db->update('location_inventory',$data);
	}

	public function update_prices($product_code, $unit_price){
		$data = array(
			'unit_price' => $unit_price
		);
		$this->db->where('product_code',$product_code);
		$this->db->update('location_inventory',$data);
	}

	public function update_shop_price($product_code, $location_id){
		$data = array(
			'unit_price' => $this->input->post('unit_price')
		);
		$this->db->where('product_code',$product_code);
		$this->db->where('location_id', $location_id);
		$this->db->update('location_inventory',$data);
	}

	public function get_shops(){
		$query = $this->db->get('shop');
		if($query->num_rows() > 1){
			return $query->result();
		}
		else{
			return false;
		}
	}

	function get_shop_name($location_id){
		$this->db->select('shop_name');
		$this->db->where('location_id', $location_id);

		$query = $this->db->get('shop');
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return false;
		}
	}

	function add_unit_of_measure(){
		$data = array(
			'short_description' => $this->input->post('short_description'),
			'description' => $this->input->post('description')
		);

		$this->db->insert('units_of_measure');
	}
}