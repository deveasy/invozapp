<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }

        $this->session_data = $this->session->userdata('logged_in');
		$this->staff_id = $this->session->userdata['logged_in']['staff_id'];
		$this->staff_name = $this->session->userdata['logged_in']['firstname'];

		$this->load->model('inventory_model');
		$this->load->model('location_inventory_model');
		$this->load->model('suppliers_model');
	}

	private $session_data;
	private $staff_id;
	private $staff_name;

	public function index(){
//		$data['inventory'] = $this->inventory_model->get_warehouse_inventory();
//		$this->load->view('warehouse_inventory', $data);
        $this->view_warehouses();
	}

	function view_warehouses(){
		$data['warehouses'] = $this->inventory_model->get_warehouses();
		$this->load->view('view_warehouses', $data);
	}

	function view_locations(){
		$data['locations'] = $this->inventory_model->get_locations();
		$this->load->view('view_locations', $data);
	}

	function warehouse_inventory($warehouse_id, $warehouse_name){
		$data['warehouse_name'] = $warehouse_name;
		$data['warehouse_id'] = $warehouse_id;
		$data['inventory'] = $this->inventory_model->get_warehouse_products($warehouse_id);
		$this->load->view('warehouse_inventory', $data);
	}

	public function location_inventory($location_id, $location_name){
		$data['location_name'] = $location_name;
		$data['location_id'] = $location_id;
		$data['products'] = $this->inventory_model->get_location_inventory($location_id);
		$this->load->view('view_location_inventory', $data);
	}

	function import_products_warehouse($warehouse_id, $warehouse_name){
	    $products = $this->inventory_model->get_products();
	    $n = 0;

	    foreach($products as $product){
	        if($this->inventory_model->check_product($product->product_code, $warehouse_id)){
	            continue;
            }
            else{
                $this->inventory_model->add_product_to_warehouse($warehouse_id, $product->product_code);
                $n++;
            }
        }
        $this->session->set_flashdata('product_import', $n . ' products successfully imported to warehouse');
        redirect('inventory/warehouse_inventory/'.$warehouse_id.'/'.$warehouse_name);
    }

    //import products into the location inventory
    function import_products_location($location_id, $location_name){
	    $products = $this->inventory_model->get_products();
	    $n = 0;

	    foreach($products as $product){
	        if($this->inventory_model->check_location_product($product->product_code, $location_id)){
	            continue;
            }
            else{
	            $this->inventory_model->add_product_to_location($location_id, $product->product_code, $product->unit_price);
	            $n++;
            }
        }
        $this->session->set_flashdata('product_import', $n . ' products successfully imported to '. $location_name);
        redirect('inventory/location_inventory/'.$location_id.'/'.$location_name);
    }

	//view for warehouse new sales order with release waybill
	public function new_warehouse_sales_order($warehouse_id, $warehouse_name){
		$data['source_name'] = $warehouse_name;
		$data['source'] = $warehouse_id;
		$data['products'] = $this->inventory_model->get_warehouse_products($warehouse_id);
		$this->load->view('new_warehouse_sales_order', $data);
	}

	//for warehouse sales order with release waybill
	//function new_sales_order()
	function new_warehouse_order($warehouse_id, $warehouse_name){
		$order_id = $this->new_warehouse_order_id();

		$this->inventory_model->add_warehouse_order($order_id, $this->staff_id);
		$this->inventory_model->add_warehouse_order_details($order_id);
		$this->inventory_model->reduce_warehouse_product_levels($order_id, $warehouse_id);

		redirect('inventory/view_warehouse_order/'.$order_id.'/' . $warehouse_id.'/'.$warehouse_name);
	}

	//show all orders placed from the warehouse
	function warehouse_orders($warehouse_id, $warehouse_name){
		$data['warehouse_details'] = array($warehouse_id, $warehouse_name);
		$data['orders'] = $this->inventory_model->get_all_warehouse_orders($warehouse_id);
		$this->load->view('view_warehouse_orders', $data);
	}

	//view a single warehouse order using the order id
	function view_warehouse_order($order_id, $warehouse_id, $warehouse_name){
	    $data['warehouse_details'] = array('id'=>$warehouse_id, 'name'=>$warehouse_name);
	    $data['order'] = $this->inventory_model->get_warehouse_order($order_id);
	    $data['order_details'] = $this->inventory_model->get_warehouse_order_details($order_id, $warehouse_id);
	    $this->load->view('view_warehouse_order', $data);
    }

    function view_add_item_to_warehouse_order($order_id, $warehouse_id, $warehouse_name){
	    $data['order_id'] = $order_id;
	    $data['warehouse_id'] = $warehouse_id;
	    $data['warehouse_name'] = $warehouse_name;
        $data['products'] = $this->inventory_model->get_warehouse_products($warehouse_id);
	    $this->load->view('add_item_to_warehouse_order',$data);
    }

    function add_items_to_warehouse_order($order_id, $warehouse_id, $warehouse_name){
        $this->inventory_model->add_warehouse_order_details($order_id);
        redirect('inventory/view_warehouse_order/'.$order_id.'/'.$warehouse_id.'/'.$warehouse_name);
    }

    function delete_warehouse_order($order_id, $warehouse){
	    //increase product quantities before delete
        $this->inventory_model->increase_product_quantities_before_order_delete($order_id, $warehouse);
        $this->inventory_model->delete_warehouse_order($order_id);
    }

    function delete_warehouse_order_detail($id, $warehouse){
        //increase product quantity before delete
        $this->inventory_model->increase_product_quantity_before_order_item_delete($id, $warehouse);
        $this->inventory_model->delete_warehouse_order_detail($id);
    }

    //show the page to update warehouse stock
	function update_warehouse_stock($warehouse_id, $warehouse_name){
		$data['warehouse_details'] = array('id'=>$warehouse_id, 'name'=>$warehouse_name);
		$data['inventory'] = $this->inventory_model->get_warehouse_inventory($warehouse_id);
		$this->load->view('update_warehouse_stock', $data);
	}

	//to update a product in the warehouse for 
	//function update_warehouse_stock()
	function update_product_level($warehouse_id, $product_code, $warehouse_name){
		$this->inventory_model->update_product_level($warehouse_id, $product_code);

		$this->session->set_flashdata('update_stock','Product level successfully updated.');
		redirect('inventory/update_warehouse_stock/'.$warehouse_id.'/'.$warehouse_name);
	}

	//new order id for warehouse orders
	function new_warehouse_order_id(){
		$part1 = date("y").date("m");
		$transfer_id = $part1.'0000';

		$last_id = $this->inventory_model->last_warehouse_order_id()->order_id;
		$month = substr($last_id, 2, 2);

		if($this->inventory_model->no_warehouse_order()){
			return $transfer_id;
		}
		//check if it's a new month or if month is january
		//to start with a new month id
		elseif(date("m") > $month){
			return $transfer_id;
		}
		else{
			$transfer_id = $last_id + 1;
			
			return $transfer_id;
		}
	}

	public function reset_location_inventory($location_id, $location_name){
		$this->inventory_model->reset_location_inventory($location_id);
		redirect('inventory/location_inventory/' . $location_id . '/' . $location_name);
	}

	function reset_warehouse_inventory($warehouse_id, $warehouse_name){
	    $this->inventory_model->reset_warehouse_inventory($warehouse_id);
	    redirect('inventory/warehouse_inventory/' . $warehouse_id . '/' . $warehouse_name);
    }

    function reset_warehouse_product_level($product_code, $warehouse_id){
	    $this->inventory_model->reset_warehouse_product_level($product_code, $warehouse_id);
    }

    public function transfers(){
    	$data['transfers'] = $this->inventory_model->all_transfers();

    	$this->load->view('view_product_transfers_new', $data);
    }

	public function product_transfers($source_id, $source_name){
		$data['source'] = $source_id;
		$data['source_name'] = $source_name;
		$data['transfers'] = $this->inventory_model->get_all_transfers($source_id);

		$this->load->view('view_product_transfers', $data);
	}

	public function transfer_products_old(){
		$data['products'] = $this->inventory_model->get_products();
		$data['locations'] = $this->inventory_model->get_locations();
		$data['warehouses'] = $this->inventory_model->get_warehouses();
		$this->load->view('transfer_products',$data);
		
		/* Json output trial here 
		*
		*header('Content-type: application/json');
		*/
		// $products = $this->inventory_model->gets_products();
		// echo json_encode($products);
	}

	public function transfer_products($source, $source_name){
		$data['source'] = $source;
		$data['source_name'] = $source_name;
		$data['products'] = $this->inventory_model->get_warehouse_products($source);
		$data['locations'] = $this->inventory_model->get_locations();
		$data['warehouses'] = $this->inventory_model->get_warehouses();
		$this->load->view('new_product_transfer',$data);
	}

	//destination parameter is used to provide the destination price
	public function view_product_transfer($transfer_id, $destination, $source_name, $source){
		$data['transfer_id'] = $transfer_id;
		$data['destination'] = $destination;
		$data['source_name'] = $source_name;
		$data['source'] = $source;

		$data['transfer_details'] = $this->inventory_model->get_transfer_details($transfer_id, $destination);
		$data['transfer'] = $this->inventory_model->get_transfer($transfer_id);

		$this->load->view('view_product_transfer', $data);
	}

	public function transfer($source, $source_name){
		$id = $this->new_transfer_id();

		$this->inventory_model->add_product_transfer($id, $this->staff_id);
		$this->inventory_model->add_transfer_details($id);
        $this->inventory_model->reduce_warehouse_product_quantities($id, $source);

		$this->session->set_flashdata('transfer','Products successfully transfered.');

		if(substr($source, 0, 1) == 'W'){
            redirect('inventory/warehouse_inventory/'.$source.'/'.$source_name);
        }
		else{
		    redirect('inventory/location_inventory/'.$source.'/'.$source_name);
        }
	}

	//add new items to transfer when view the transfer details
	function add_items_to_transfer($transfer_id, $source, $source_name, $destination, $destination_name){
	    $data['transfer_id'] = $transfer_id;
	    $data['source'] = $source;
	    $data['source_name'] = $source_name;
	    $data['destination'] = $destination;
	    $data['destination_name'] = $destination_name;
        $data['products'] = $this->inventory_model->get_warehouse_products($source);

	    $this->load->view('add_item_to_transfer', $data);
    }

    function add_items($transfer_id, $destination, $source_name, $source){
	    $this->inventory_model->add_transfer_details($transfer_id);
        $this->inventory_model->reduce_warehouse_product_quantities($transfer_id, $source);
	    redirect('inventory/view_product_transfer/'.$transfer_id.'/'.$destination.'/'.$source_name.'/'.$source);
    }

	public function new_transfer_id(){
		$part1 = date("y").date("m");
		$transfer_id = $part1.'0000';

		$last_id = $this->inventory_model->last_transfer_id()->transfer_id;
		$month = substr($last_id, 2, 2);

		if($this->inventory_model->no_transfer()){
			return $transfer_id;
		}
		//check if it's a new month or if month is january
		//to start with a new month id
		elseif(date("m") > $month){
			return $transfer_id;
		}
		else{
			$transfer_id = $last_id + 1;
			
			return $transfer_id;
		}
	}

    //delete entire transfer
    function delete_transfer($transfer_id){
        //increase quantities before deleting
        $this->inventory_model->increase_warehouse_product_quantities_before_delete($transfer_id);
        $this->inventory_model->delete_transfer($transfer_id);
    }

    //delete transfer detail used in jquery function
    //to delete items from invoice
    function delete_transfer_detail($id){
        //increase quantity before deleting
        $this->inventory_model->increase_warehouse_product_quantity_before_delete($id);
        $this->inventory_model->delete_transfer_detail($id);
    }

	public function location_restock($warehouse_id, $warehouse_name){
		$data['warehouse_id'] = $warehouse_id;
		$data['warehouse_name'] = $warehouse_name;
		$data['restock'] = $this->inventory_model->get_all_restock();
		$data['back'] = uri_string();

		$this->load->view('location_restock', $data);
	}

	public function view_location_restock($restock_id, $warehouse_id, $warehouse_name){
	    $data['warehouse_name'] = $warehouse_name;
	    $data['warehouse_id'] = $warehouse_id;
		$data['restock_details'] = $this->inventory_model->get_restock_details($restock_id);
		$data['stock'] = $this->inventory_model->get_restock($restock_id);

		$this->load->view('view_location_restock', $data);
	}

	public function receive_products(){
		$data['location_id'] = $location_id;
		$data['location_name'] = $location_name;
		$data['products'] = $this->inventory_model->get_location_products($location_id);
		$data['locations'] = $this->inventory_model->get_locations();
		$data['suppliers'] = $this->suppliers_model->get_suppliers();

		$this->load->view('receive_products', $data);
	}

	public function restock($warehouse_id, $warehouse_name){
		$id = $this->new_restock_id();

		$this->inventory_model->add_restock($id, $this->staff_id);
		$this->inventory_model->add_restock_details($id);
		$this->inventory_model->increase_product_quantity($id);

		redirect('inventory/view_warehouse_restock/' . $id . '/' . $warehouse_id . '/' . $warehouse_name);
	}

	function delete_restock($restock_id){
	    $this->inventory_model->delete_restock($restock_id);
    }

    function delete_restock_detail($id){
	    $this->inventory_model->delete_restock_detail($id);
	    //$this->inventory_model->decrease_product_quantity();
    }

	private function new_restock_id(){
		$part1 = date("y").date("m");
		$transfer_id = $part1.'0000';

		$last_id = $this->inventory_model->last_restock_id()->restock_id;
		$month = substr($last_id, 2, 2);

		if($this->inventory_model->no_restock()){
			return $transfer_id;
		}
		//check if it's a new month or if month is january
		//to start with a new month id
		elseif(date("m") > $month){
			return $transfer_id;
		}
		else{
			$transfer_id = $last_id + 1;
			
			return $transfer_id;
		}
	}

	function update_location_stock_levels($transfer_id, $destination){
		$this->inventory_model->update_location_stock_levels($transfer_id, $destination);
	}

	function print_stock_sheets($location_id, $location_name){
		$products = $this->inventory_model->get_location_inventory($location_id);

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($location_name.' Stock Sheet');
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(36);
		$pdf->SetFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('AgeDave Enterprise ');
		$pdf->SetDisplayMode('real','default');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->AddPage();

		// $pdf->Write(50, 'Some sample text');

		//set JPEG quality
		$pdf->setJPEGQuality(75);

		$pdf->Image('assets/img/company-logo-large.jpg', 55, 10, 100, 24, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);

		$html = '

		<h1 align="center">AGE DAVE ENTERPRISE</h1>
		<p align="center" style="margin: 0;">
			Dealers in all kinds of Provisions: Rice, Sugar, Oil, Flour<br>
			Post Office Box NK 19, North Kaneshie<br>
			Tel: 0302-388-247&nbsp;&nbsp;&nbsp;&nbsp;Mobile: 0243-213-140
		</p>
		<h2><strong>'.str_replace('%20', ' ', $location_name).' Stock</strong></h2>
                            <h3><strong>Date:'.date('Y-m-d').' </strong></h3>
                            <br>
                            <table width="100%" border="1" cellpadding="7">
                                <thead>
                                    <tr>
                                    	<th width="7%"> # </th>
                                        <th><h3>Product Name</h3></th>
                                        <th><h3>Unit Price</h3></th>
                                        <th><h3>Available Quantity</h3></th>
                                        <th><h3>Remarks</h3></th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    if(!empty($products)){
                                        $quantity = 0;
                                        $num = 1;
                                        foreach($products as $product){
                                            $html .= '<tr>';
                                            $html .= '<td width="7%">' . $num++ .'</td>';
                                            $html .= '<td>'.$product->product_name.'</td>';
                                            $html .= '<td>'.$product->unit_price.'</td>';
                                            $html .= '<td>'.$product->quantity_in_stock.'</td>';
                                            $html .= '<td></td>';
                                            $html .= '</tr>';
                                            $quantity += $product->quantity_in_stock;
                                        }
                                    }
                                    $html .= '<tr>
                                        <td colspan="3" align="right"><h3 class="amount" style="margin-right: 20px;">TOTAL QUANTITY</h3></td>';
                                        $html .= '<td><h3 class="amount">'. $quantity .'</h3></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>&nbsp;</p>
                            <table>
                            	<tr>
                            		<td><em>'.$this->session_data['firstname'].'</em><br>________________<br>Prepared By</td>
                            		<td></td>
                            		<td></td>
                            		<td><br>..............................<br>Received By</td>
                            	</tr>
                            </table>';
        $pdf->writeHTML($html, true, 0, true, true);

        $pdf->lastPage();

		$pdf->Output('stock_sheet.pdf', 'I');
	}

	//invoice printout for transferred products
	public function print_invoice($transfer_id, $source, $source_name){
		$transfer_details = $this->inventory_model->get_transfer_details($transfer_id, $source);
		$transfer = $this->inventory_model->get_transfer($transfer_id);

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Invoice'.$transfer_id);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(36);
		$pdf->SetFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('AgeDave Enterprise ');
		$pdf->SetDisplayMode('real','default');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->AddPage();

		// $pdf->Write(50, 'Some sample text');

		//set JPEG quality
		$pdf->setJPEGQuality(75);

		$pdf->Image('assets/img/company-logo-large.jpg', 55, 10, 100, 24, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);

		$html = '

		<h1 align="center">AGE DAVE ENTERPRISE</h1>
		<p align="center" style="margin: 0;">
			Dealers in all kinds of Provisions: Rice, Sugar, Oil, Flour<br>
			Post Office Box NK 19, North Kaneshie<br>
			Tel: 0302-388-247&nbsp;&nbsp;&nbsp;&nbsp;Mobile: 0243-213-140
		</p>
		<h2><strong>Invoice #:'. $transfer_id . '</strong></h2>
		<h3><strong>Transferred From:'.$source_name.' </strong></h3>
                            <h3><strong>Transferred To:'.$transfer->s-hop_name.' </strong></h3>
                            <br>
                            <table width="100%" border="1" cellpadding="7">
                                <thead>
                                    <tr>
                                        <th><h3>Quantity</h3></th>
                                        <th><h3>Product Name</h3></th>
                                        <th><h3>Unit Price</h3></th>
                                        <th><h3>Amount</h3></th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    if(!empty($transfer_details)){
                                        $amount = 0.00;
                                        foreach($transfer_details as $detail){
                                            $html .= '<tr>';
                                            $html .= '<td>'.$detail->quantity.'</td>';
                                            $html .= '<td>'.$detail->product_name.'</td>';
                                            $html .= '<td>'.$detail->unit_price.'</td>';
                                            $html .= '<td>'.number_format(($detail->quantity * $detail->unit_price), 2).'</td>';
                                            $html .= '</tr>';
                                            $amount += ($detail->quantity * $detail->unit_price);
                                        }
                                    }
                                    $html .= '<tr>
                                        <td colspan="3" align="right"><h3 class="amount" style="margin-right: 20px;">TOTAL AMOUNT (GHS)</h3></td>';
                                        $html .= '<td><h3 class="amount">'. number_format($amount, 2) .'</h3></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>&nbsp;</p>
                            <table>
                            	<tr>
                            		<td><em>'.$this->session_data['firstname'].'</em><br>________________<br>Prepared By</td>
                            		<td></td>
                            		<td></td>
                            		<td><br>..............................<br>Received By</td>
                            	</tr>
                            </table>';
        $pdf->writeHTML($html, true, 0, true, true);

        $pdf->lastPage();

		$pdf->Output('easy.pdf', 'I');
	}

	//waybill printout for transferred products
	public function print_waybill($transfer_id, $source, $source_name){
		$transfer_details = $this->inventory_model->get_transfer_details($transfer_id, $source);
		$transfer = $this->inventory_model->get_transfer($transfer_id);

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Invoice'.$transfer_id);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(36);
		$pdf->SetFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('AgeDave Enterprise ');
		$pdf->SetDisplayMode('real','default');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->AddPage();

		// $pdf->Write(50, 'Some sample text');

		//set JPEG quality
		$pdf->setJPEGQuality(75);

		$pdf->Image('assets/img/company-logo-large.jpg', 55, 10, 100, 24, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);

		$html = '

		<h1 align="center">AGE DAVE ENTERPRISE</h1>
		<p align="center" style="margin: 0;">
			Dealers in all kinds of Provisions: Rice, Sugar, Oil, Flour<br>
			Post Office Box NK 19, North Kaneshie<br>
			Tel: 0302-388-247&nbsp;&nbsp;&nbsp;&nbsp;Mobile: 0243-213-140
		</p>
		<table>
		    <tr>
                <td>
                    <h4>Invoice #:'. $transfer_id . '</h4>
		            <h4>Transferred From:'.str_replace('%20',' ',$source_name).' </h4>
                    <h4>Transferred To:'.$transfer->location_name.' </h4>
                </td>
                <td>
                    <h4>Date: '. $transfer->transfer_date .'</h4>
                    <h4>Dispatcher: '. $transfer->dispatcher .'</h4>
                    <h4>Vehicle No.: '. $transfer->vehicle_number .'</h4>
                </td>
            </tr>
        </table>
                            <br><br>
                            <table width="100%" border="1" cellpadding="7">
                                <thead>
                                    <tr bgcolor="#f5f5f5">
                                        <th><h3>Product Name</h3></th>
                                        <th><h3>Quantity</h3></th>
                                        <th><h3>Unit Price</h3></th>
                                        <th><h3>Amount</h3></th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    if(!empty($transfer_details)){
                                        $amount = 0.00;
                                        foreach($transfer_details as $detail){
                                            $html .= '<tr>
                                            <td>'.$detail->product_name.'</td>
                                            <td align="center">'.$detail->quantity.'</td>
                                            <td></td>
                                            <td bgcolor="#f5f5f5"></td>
                                            </tr>';
                                        }
                                    }

                                    $total_items = count($transfer_details);
                                    $row_height = 0;
                                    $total_pages = 0.00;
                                    if($total_items < 15){
                                        $row_height = (15 - $total_items) * 30;
                                    }
                                    elseif ($total_items > 15) {
                                        $total_pages = $total_items / 15;
                                        foreach($transfer_details as $key => $detail){
                                            echo $key . ' ' . $detail;
                                            if($key == 15){
                                                break;
                                            }
                                        }
                                    }

                                    $html .= '
                                        <tr>
                                            <td height="'.$row_height.'"></td>
                                            <td></td>
                                            <td></td>
                                            <td bgcolor="#f5f5f5"></td>
                                        </tr>
                                        <tr>
                                        <td colspan="3" align="right"></td>
                                        <td bgcolor="#f5f5f5"><h3 class="amount"></h3></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>&nbsp;</p>
                            <table>
                            	<tr>
                            		<td><em>'.$this->session_data['firstname'].'</em><br>________________<br>Authorized By</td>
                            		<td></td>
                            		<td></td>
                            		<td><br>..............................<br>Received By</td>
                            	</tr>
                            </table>';
        $pdf->writeHTML($html, true, 0, true, true);

        $pdf->lastPage();

		$pdf->Output('easy.pdf', 'I');
	}

	public function print_restock_waybill($restock_id, $source, $source_name){
		$restock_details = $this->inventory_model->get_restock_details($restock_id, $source);
		$restock = $this->inventory_model->get_restock($restock_id);
		$date = date('Y-m-d');

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Invoice'.$restock_id);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(15);
		$pdf->SetFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('AgeDave Enterprise ');
		$pdf->SetDisplayMode('real','default');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->AddPage();

		// $pdf->Write(50, 'Some sample text');

		//set JPEG quality
		$pdf->setJPEGQuality(75);

		$pdf->Image('assets/img/company-logo-large.jpg', 10, 10, 100, 24, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);

		$html = '

		<table width="100%">
			<tr>
				<td width="50%"></td>
				<td width="50%">
					<p style="margin: 0;">
						Dealers in all kinds of Provisions: Rice, Sugar, Oil, Flour<br>
						Post Office Box NK 19, North Kaneshie<br>
						Tel: 0302-388-247&nbsp;&nbsp;&nbsp;&nbsp;Mobile: 0243-213-140
					</p>
				</td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<table>
			<tr>
				<td>
					<p>Invoice #: <strong>'. $restock_id . '</strong></p>
					<p>Supplier: <strong>'.$restock->supplier_name.' </strong></p>
			        <p>Warehouse: <strong>'.$restock->warehouse_name.' </strong></p>
				</td>
				<td>
					<p>Date: <strong>'. $restock->date_received . '</strong></p>
					<p>Received by: <strong>'.$restock->firstname.' </strong></p>
			        <p>Supplier Waybill #: <strong>'.$restock->waybill_code.' </strong></p>
				</td>
			</tr>
		</table>
        <br>
        <br>
        <table width="100%" border="1" cellpadding="7">
            <thead>
                <tr>
                    <th width="60%"><strong>Product Name</strong></th>
                    <th width="10%" align="center"><strong>QTY</strong></th>
                    <th width="15%"><strong>Unit Price</strong></th>
                    <th width="15%"><strong>Amount</strong></th>
                </tr>
            </thead>
            <tbody>';
                    $total_qty = 0;
                if(!empty($restock_details)){
                    foreach($restock_details as $key => $detail){
                        $html .= '<tr>
                        <td width="60%">'.$detail->product_name.'</td>
                        <td width="10%" align="center">'.$detail->quantity_received.'</td>
                        <td width="15%"></td>
                        <td width="15%"></td>
                        </tr>';
                        $total_qty += $detail->quantity_received;
                    }
                }

                $total_items = count($restock_details);
                $row_height = 0;
                $total_pages = 0.00;
                if($total_items < 16){
                	$row_height = (16 - $total_items) * 32;
                }
                elseif ($total_items > 16) {
                	$total_pages = $total_items / 16;
                	foreach($restock_details as $key => $detail){
                		echo $key . ' ' . $detail;
                		if($key == 16){
                			break;
                		}
                	}
                }
                
                $html .= '
                <tr>
                	<td height="' . $row_height .'"></td>
                	<td></td>
                	<td></td>
                	<td></td>
                </tr>
                <tr>
                    <td align="right">Total</td>
                    <td align="center"><strong>' . $total_qty . '</strong></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <p>&nbsp;</p>
        <table>
        	<tr>
        		<td><em>'.$this->staff_name.'</em>________________<br>Prepared By</td>
        		<td></td>
        		<td></td>
        		<td><br>..............................<br>Received By</td>
        	</tr>
        </table>';
        $pdf->writeHTML($html, true, 0, true, true);

        $pdf->lastPage();

		$pdf->Output('Waybill.pdf', 'I');
	}

	function print_warehouse_order_waybill($order_id){
        $order_details = $this->inventory_model->get_warehouse_order_details($order_id);
        $order = $this->inventory_model->get_warehouse_order($order_id);

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Invoice'.$order_id);
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(15);
        $pdf->SetFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('AgeDave Enterprise ');
        $pdf->SetDisplayMode('real','default');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage();

        // $pdf->Write(50, 'Some sample text');

        //set JPEG quality
        $pdf->setJPEGQuality(75);

        $pdf->Image('assets/img/company-logo-large.jpg', 10, 10, 100, 24, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);

        $html = '

		<table width="100%">
			<tr>
				<td width="50%"></td>
				<td width="50%">
					<p style="margin: 0;">
						Dealers in all kinds of Provisions: Rice, Sugar, Oil, Flour<br>
						Post Office Box NK 19, North Kaneshie<br>
						Tel: 0302-388-247&nbsp;&nbsp;&nbsp;&nbsp;Mobile: 0243-213-140
					</p>
				</td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<table>
			<tr>
				<td>
					<p>Invoice #: <strong>'. $order_id . '</strong></p>
					<p>Customer: <strong>'.$order->customer_name.' </strong></p>
			        <p>Destination: <strong>'.$order->destination.' </strong></p>
				</td>
				<td>
					<p>Date: <strong>'. $order->order_date . '</strong></p>
					<p>Dispatched through: <strong>'.$order->dispatcher.' </strong></p>
			        <p>Vehicle No.: <strong>'.$order->vehicle_number.' </strong></p>
				</td>
			</tr>
		</table>
        <br>
        <br>
        <table width="100%" border="1" cellpadding="7">
            <thead>
                <tr>
                    <th width="60%"><strong>Product Name</strong></th>
                    <th width="10%" align="center"><strong>QTY</strong></th>
                    <th width="15%"><strong>Unit Price</strong></th>
                    <th width="15%"><strong>Amount</strong></th>
                </tr>
            </thead>
            <tbody>';
        $total_qty = 0;
        if(!empty($order_details)){
            foreach($order_details as $key => $detail){
                $html .= '<tr>
                        <td width="60%">'.$detail->product_name.'</td>
                        <td width="10%" align="center">'.$detail->quantity.'</td>
                        <td width="15%"></td>
                        <td width="15%"></td>
                        </tr>';
                $total_qty += $detail->quantity;
            }
        }

        $total_items = count($order_details);
        $row_height = 0;
        $total_pages = 0.00;
        if($total_items < 16){
            $row_height = (16 - $total_items) * 32;
        }
        elseif ($total_items > 16) {
            $total_pages = $total_items / 16;
            foreach($order_details as $key => $detail){
                echo $key . ' ' . $detail;
                if($key == 16){
                    break;
                }
            }
        }

        $html .= '
                <tr>
                	<td height="' . $row_height .'"></td>
                	<td></td>
                	<td></td>
                	<td></td>
                </tr>
                <tr>
                    <td align="right">Total</td>
                    <td align="center"><strong>' . $total_qty . '</strong></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <p>&nbsp;</p>
        <table>
        	<tr>
        		<td><em>'.$this->staff_name.'</em>________________<br>Prepared By</td>
        		<td></td>
        		<td></td>
        		<td><br>..............................<br>Received By</td>
        	</tr>
        </table>';
        $pdf->writeHTML($html, true, 0, true, true);

        $pdf->lastPage();

        $pdf->Output('Waybill.pdf', 'I');
    }
}

/* End of file Welcome.php */
/* Location: ./application/controllers/Welcome.php */