<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->library('form_validation');
		$this->load->library('image_lib');
		$this->load->helper('form');
		$this->load->helper('img_helper');
		$this->load->helper('url_helper');
		$this->load->helper('db_helper');
		$this->load->model('db_panel');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('calendar');
		$this->load->library('upload');
		$this->load->library('email');		
		$this->load->helper('captcha');
		$this->load->helper('string');		
		$this->load->helper('ckeditor');
		$this->load->helper('text');
		$this->load->library('table');
		$this->load->helper('directory');
		$session = $this->session->all_userdata();
	}

	function index(){
		if (empty($this->session->userdata['userdata'])) {
			$this->load->view('admin/login');
		}else{
			
		}
	}
	
	function stocks(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['records']= $this->db_panel->fetch_rows('product_models');
			if(!empty($data['records'])){
				foreach($data['records'] as $row){
					// $model = $this->db_panel->fetch_row('product_models', array('id'=>$row->productmodelid));
					$type = $this->db_panel->fetch_row('product_types', array('id'=>$row->producttype));
					$row->type = !empty($type)?$type->producttypename:"Not Found";
					$stocks = $this->db_panel->fetch_rows('product_stocks', array('productmodelid'=>$row->id));
					$sum = 0;
					foreach($stocks as $r){
						$sum = $sum + $r->quantity;
					}
					$sales = $this->db_panel->fetch_rows('sale_products', array('productmodelid'=>$row->id));
					foreach($sales as $r){
						$sum = $sum - 1;
					}
					$row->stocks = $sum;
				}
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	
	
	function purchases(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['records']= $this->db_panel->fetch_rows('stock_entry');
			// if(!empty($data['records'])){
			// 	foreach($data['records'] as $row){
			// 		$product = $this->db_panel->fetch_row('products', array('id'=>$row->product));
			// 		$row->productname = !empty($product)?$product->productname:"Not Found";
			// 	}
			// }
			$this->load->view('admin/admin_base', $data);
		}
	}
	function purchase($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			// if($this->input->post('continue')) echo 'continue'; elseif($this->input->post('exit')) echo 'exit'; die;
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
				// echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die;
		        $stock_entry = array(
					'purchaseorder' => $this->input->post('purchaseorder'),
					'purchasedate' => $this->input->post('purchasedate'),
					'authorizedby' => $this->input->post('authorizedby'),
					'preparedby' => $this->input->post('preparedby'),
					'created_at' => date('Y-m-d H:i:s'),
				);
		        if(trim($this->input->post('stockid')) != NULL){
		        	$stock_id = $this->input->post('stockid');
		        }elseif($this->db->insert('stock_entry', $stock_entry)) {
					$stock_id = $this->db->insert_id();
				}
				if(!empty($stock_id)){
					$product_stocks = array();
					$count = 0;
					foreach($this->input->post('productquantity') as $key=>$row){
						if(!empty($row)){
							$count++;
							$product_stocks[$key] = array();
							array_push($product_stocks[$key], $row);
						}else break;
					}
					// var_dump( $this->input->post('model')); die;
					$model = $this->input->post('model');
					$productMRP = $this->input->post('productMRP');
					for($i=0; $i<$count; $i++){
						array_push($product_stocks[$i], $model[$i]);
						array_push($product_stocks[$i], $productMRP[$i]);
					}
					foreach($product_stocks as $row){
						$purchase_row = array(
							'stockentryid' => $stock_id,
							'oldstockentryid' => '',
							'productmodelid' =>$row[1],
							'quantity' => $row[0],
							'MRP' => $row[2],
							'status' => '1'
						);
						$this->db->insert('product_stocks',$purchase_row);
					}
					if($this->input->post('exit') == 'exit') redirect('/');
					else {
						$stock_entry['stockid'] = $stock_id;
						$data['stock'] = $stock_entry;
					}
				}
			}
			// if (!empty($id) || $this->input->post('id')) {
   //      		if($this->input->post()){
   //      			if($id == '') $id = $this->input->post('id');
   //      			$p_data['updated_at'] = date('Y-m-d H:i:s');
	  //       		$this->db->where('id',$id);
			//         $this->db->update('complains',$p_data);
	  //       		$this->db->where('id', $id);
	  //       	}
	  //       	$complains = $this->db->where('id', $id)->get('complains')->result_object();
   //      		$data['record'] = $complains;
			// }
			// else{
			// 	if($this->input->post()){
			// 		$p_data['created_at'] =  date('Y-m-d H:i:s');
			// 		// print($p_data); echo 'pdata';
			// 		if ($this->db->insert('complains', $p_data)) {
		 //            	$last_id = $this->db->insert_id();
		 //            	$callid = get_code($this->input->post('product'), $last_id);
		            	
			//             $up_data = array('callid'=>$callid);
			//             $this->db->where('id',$last_id);
			//             $this->db->update('complains',$up_data);
			//             $complains = $this->db->where('id', $last_id)->get('complains')->result_object();
			//             $data['record'] = $complains;
		            	
		 //            	$this->data['record'] = $p_data;
			//             $this->data['message'] = 'Saved Successfully!!!';
			//             $this->session->set_flashdata('message','Updated successfully!!!');
			// 		}
			// 	}
			// }
			$this->load->view('admin/admin_base', $data);
		}
	}
	function oldStocks(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['records']= $this->db_panel->fetch_rows('old_stock_entry');
			if(!empty($data['records'])){
				$user_session = $this->session->userdata('userdata');
				foreach($data['records'] as $row){
					$user = $this->db_panel->fetch_row('users', array('id'=>$user_session['id']));
					$row->enteredby = !empty($user)?$user->firstname.' '.$user->lastname:"Not Found";
				}
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	function oldStock($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			// if($this->input->post('continue')) echo 'continue'; elseif($this->input->post('exit')) echo 'exit'; die;
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
				$user_session = $this->session->userdata('userdata');
		        $old_stock_entry = array(
					'entereddate' => date('Y-m-d'),
					'enteredby' => $user_session['id'],
					'note' => $this->input->post('note'),
					'created_at' => date('Y-m-d H:i:s'),
				);
		        if(trim($this->input->post('stockid')) != null){
		        	$stock_id = $this->input->post('stockid');
		        }elseif($this->db->insert('old_stock_entry', $old_stock_entry)) {
					$stock_id = $this->db->insert_id();
				}
				if(!empty($stock_id)){
					$product_stocks = array();
					$count = 0;
					foreach($this->input->post('productquantity') as $key=>$row){
						if(!empty($row)){
							$count++;
							$product_stocks[$key] = array();
							array_push($product_stocks[$key], $row);
						}else break;
					}
					$model = $this->input->post('model');
					$productMRP = $this->input->post('productMRP');
					for($i=0; $i<$count; $i++){
						array_push($product_stocks[$i], $model[$i]);
						array_push($product_stocks[$i], $productMRP[$i]);
					}
					foreach($product_stocks as $row){
						$purchase_row = array(
							'stockentryid' => '',
							'oldstockentryid' => $stock_id,
							'productmodelid' =>$row[1],
							'quantity' => $row[0],
							'MRP' => $row[2],
							'status' => '1'
						);
						$this->db->insert('product_stocks',$purchase_row);
					}
					if($this->input->post('exit') == 'exit') redirect('/');
					else {
						$old_stock_entry['stockid'] = $stock_id;
						$data['stock'] = $old_stock_entry;
					}
				}
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	
	function sales(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['records']= $this->db_panel->fetch_rows('sales');
			// if(!empty($data['records'])){
			// 	foreach($data['records'] as $row){
			// 		$user = $this->db_panel->fetch_row('users', array('id'=>$this->session->userdata('userdata')['id']));
			// 		$row->enteredby = !empty($user)?$user->firstname.' '.$user->lastname:"Not Found";
			// 	}
			// }
			$this->load->view('admin/admin_base', $data);
		}
	}
	function sale($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			// if($this->input->post('continue')) echo 'continue'; elseif($this->input->post('exit')) echo 'exit'; die;
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
				// echo "<pre>"; print_r($this->input->post()); echo "</pre>";
		        $sale_entry = array(
					'customername' => $this->input->post('customername'),
					'salesdate' =>  $this->input->post('salesdate'),
					'created_at' => date('Y-m-d H:i:s'),
				);
				$count = 0;
				$product_sales = array();
				foreach($this->input->post('productMRP') as $key=>$row){
					if(!empty($row)){
						$count++;
						$product_sales[$key] = array();
						array_push($product_sales[$key], $row);
					}else break;
				}
				if($count>0){
			        if(trim($this->input->post('salesid')) != NULL){
			        	$sale_id = $this->input->post('salesid');
			        }elseif($this->db->insert('sales', $sale_entry)) {
						$sale_id = $this->db->insert_id();
					}
					if(!empty($sale_id)){
						$model = $this->input->post('model');
						$productserialno = $this->input->post('productserialno');
						$warrantycardno = $this->input->post('warrantycardno');
						$discount = $this->input->post('discount');
						$vatamount = $this->input->post('vatamount');
						$taxamount = $this->input->post('taxamount');
						$commision = $this->input->post('commision');
						$actualprice = $this->input->post('actualprice');
						for($i=0; $i<$count; $i++){
							array_push($product_sales[$i], $model[$i]);
							array_push($product_sales[$i], $productserialno[$i]);
							array_push($product_sales[$i], $warrantycardno[$i]);
							array_push($product_sales[$i], $discount[$i]);
							array_push($product_sales[$i], $vatamount[$i]);
							array_push($product_sales[$i], $taxamount[$i]);
							array_push($product_sales[$i], $commision[$i]);
							array_push($product_sales[$i], $actualprice[$i]);
						}
						foreach($product_sales as $row){
							$purchase_row = array(
								'salesid' => $sale_id,
								'productmodelid' =>$row[1],
								'MRP' => $row[0],
								'productserialno' => $row[2],
								'warrantycardno' => $row[3],
								'discount' => $row[4],
								'vatamount' => $row[5],
								'taxamount' => $row[6],
								'commision' => $row[7],
								'actualprice' => $row[8],
								'status' => '1'
							);
							$this->db->insert('sale_products',$purchase_row);
						}
						if($this->input->post('exit') == 'exit') redirect('/');
						else {
							$sale_entry['saleid'] = $sale_id;
							$data['sale'] = $sale_entry;
							$this->session->set_flashdata('success','Sale Details successfully Updated !!!');
						}
					}
				}else{
					$this->session->set_flashdata('error','Please enter Sold Product Details !!!');
				}
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	
}
?>