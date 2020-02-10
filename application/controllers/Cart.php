<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->model('login_panel');
		$this->load->model('db_panel');
		$this->load->helper('text');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('url_helper');
		$this->load->helper('text');
		$this->load->library('form_validation');
		$this->load->helper('directory');
		$this->load->library('session');
		$this->load->library('cart');
	}
	function index(){
		$getSession = $this->session->all_userdata();
		$content['session'] = $getSession;
		$content['records'] = "";
		$content['template'] = 'cart';
		if ($this->session->userdata('p_code') == TRUE) {
		   $content['p_code'] = TRUE;
		}
		$this->cart->format_number($this->cart->total());
		// echo "<pre>"; print_r($this->cart->contents()); die;
		$this->load->view('front/front-base', $content);
	}
	function add_product(){
		// $this->cart->destroy();
		// exit();
		// print_r($this->input->post());
		$cart = $this->cart->contents();
		foreach($cart as $item){
			if($item['id'] == $this->input->post('productId')){
				$msg = array('responseCode' => '400', 'message' => 'Product is already inserted');
				echo json_encode($msg);
				// echo $this->cart->total_items();
				exit();
			}
		}
		$data = array(
               'id'      => $this->input->post('productId'),
               'qty'     => 1,
               'price'   => $this->input->post('productPrice'),
               'name'    => $this->input->post('productName'),
               'options' => array('productMemberPrice' => $this->input->post('productMemberPrice'))
            );
		if($this->cart->insert($data)){
			$msg = array('responseCode' => 201, 'message' => "Product is added to cart");
		}else{
			$msg = array('responseCode' => 500, 'message' => "Problem in inserting product to cart");
		}
		echo json_encode($msg);
		// echo $this->cart->total_items();
	}
	function checkout(){
		if (($this->session->userdata('member_data')) == TRUE) {
			redirect('cart/checkoutBillingShipping');
		}else{
			$content['records'] = "";
			$content['template'] = 'checkout';
			if($this->input->post()){
				if($this->input->post('login')) echo 'login'; else 'else';
			}
			$this->load->view('front/front-base', $content);
		}
	}
	
	function checkoutBillingShipping($checkout_type = ''){
		// die($this->input->post('checkouttype')); die('test');
		if($this->input->post('checkouttype')){
			$s_data = array(
	            'c_id' => $this->session->userdata('member_data')['id'],
	            'customer_id' => $this->session->userdata('member_data')['customer_id'],
	            'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'postalcode' => $this->input->post('postalcode'),
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'phone' => $this->input->post('contact'),
				'email' => $this->input->post('email')
			);
			if ($this->db->insert('shipping_details', $s_data)) {
				redirect('cart/orderConfirmation');
			}

		}else{
			if (($this->session->userdata('user_data')) == TRUE) {
				$content['checkout_type'] = 'login';
				$content['customer'] = $this->db_panel->fetch_rows('users', array('user_id'=> $this->session->userdata('user_data')['user_id']));
			}elseif($checkout_type == 'register'){
				$content['checkout_type'] = $checkout_type;
			}else $content['checkout_type'] = 'guest';

			$getSession = $this->session->all_userdata();
			$content['session'] = $getSession;
			$content['records'] = "";
			$content['template'] = 'checkoutBillingShipping';
			$this->load->view('front/front-base', $content);	
		}
	}
	function update_billing_shipping(){
		// !! update order in session
		// !! update billing and shipping in session and insert in table only after payment done
		$billship['billing'] = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'postcode' => $this->input->post('postcode'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'contact' => $this->input->post('contact')
		);
		$billship['shipping'] = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'postcode' => $this->input->post('postcode'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'contact' => $this->input->post('contact')
		);
		
		if($this->input->post() && $this->input->post('checkout_type')=='login' ){

			$billship['billing']['user_id'] = $this->input->post('user_id');
			$billship['billing']['user_type'] = 'customer';
			$billship['shipping']['user_id'] = $this->input->post('user_id');
			$msg = array('status' => "success", 'message' => "User is logged in");
			echo json_encode($msg);

		}elseif($this->input->post() && $this->input->post('checkout_type')=='register' ){
			$user= $this->login_panel->check_duplicate(array('email'=>$this->input->post('email')));
			
			if (empty($user)) {

				$billship['billing']['email'] = $this->input->post('email');
				$billship['billing']['password'] = md5($this->input->post('password'));
				$billship['billing']['username'] = $this->input->post('first_name').'_'.$this->input->post('last_name');
				$billship['billing']['user_type'] = 'customer';
				$insert = $this->db_panel->insert($billship['billing'], 'users');	
				$last_id = $this->db->insert_id();
				$user_id = get_code($this->input->post('first_name'), $last_id);
				$up_data = array('user_id'=>$user_id);
	            $this->db->where('id',$last_id);
				            
				if ($this->db->update('users',$up_data)) {
					$sec['user_data']=array(
						'user_id' => $user_id,
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('first_name').'_'.$this->input->post('last_name'),
						'contact' => $this->input->post('contact'),
						'address' => $this->input->post('address'),
						'logged_in' => TRUE
					);
				   	$this->session->set_userdata($sec);

					$msg = array('status' => "success", 'message' => "User Registration SuccessFull");
				} else {
					$msg = array('status' => "error", 'message' => "Unable To Insert.Please Try Again!");
				}
			} else {
				$msg = array('status' => "error", 'message' => "Duplicate Email Please Use Another Email");
			}
			echo json_encode($msg);

		}elseif($this->input->post() && $this->input->post('checkout_type')=='guest' ){
			$billship['billing']['email'] = $this->input->post('email');
			$billship['billing']['user_type'] = 'guest';
			$msg = array('status' => "success", 'message' => "Guest");	
			echo json_encode($msg);
		}
		$this->session->set_userdata($billship);
		// echo "<pre>"; print_r($this->session->userdata); echo "</pre>";
		// echo '1';
	}
	function orderConfirmation(){
		$content['template'] = 'orderConfirmation';
		$this->load->view('front/front-base', $content);
	}
	function paypal_success(){
		$content = menu();
		echo "<pre>"; print_r($this->session->userdata); echo "</pre>";

		if(@count($this->cart->contents())>0) { 
			// ----- Destroy cart and relative data in session ---
			//insert billing first
			if($this->session->userdata('user_data') == TRUE){
				$this->db->where('id', $this->session->userdata('user_data')['user_id']);
				$this->db->update('users', $this->session->userdata('billing'));
			}else{
				$insertBilling = $this->db_panel->insert($this->session->userdata('billing'), 'users');
				// echo "billing<pre>"; print_r($insertBilling); echo "</pre>";
				$last_id = $this->db->insert_id();
				$user_id = get_code($this->session->userdata('billing')['first_name'], $last_id);
				$up_data = array('user_id'=>$user_id);
		        $this->db->where('id',$last_id);
		        $uploadBilling = $this->db->update('users',$up_data);
			}
			$user_id = ($this->session->userdata('user_data') == TRUE) ? $this->session->userdata('user_data')['user_id'] 
				: $user_id;

			$order = array(
				'customer_id' => $user_id,
				'shipping_cost' => $this->session->userdata('order')['shipping_cost'],
				'discount' => $this->session->userdata('order')['discount'],
				'total' => $this->session->userdata('order')['total'],
				'order_status' => '1',
				'order_date' => date('Y-m-d H:i:s')
				);
			print_r($order);
			$insertOrder = $this->db_panel->insert($order, 'orders');
			$last_id = $this->db->insert_id();
			echo $order_code = get_code($this->session->userdata('billing')['first_name'], $last_id);
			$up_data = array('order_code'=>$order_code);
	        $this->db->where('id',$last_id);
	        if ($this->db->update('orders',$up_data)) {
				$msg = array('status' => "success", 'message' => "Order placed");
			} else {
				$msg = array('status' => "error", 'message' => "Unable To Insertlace order.Please Try Again!");
			}

			// echo "<pre>"; print_r($this->cart_contents()); echo "</pre>"; 

			// if(@count($this->cart->contents())>0) { 
				$i = 1; $c = 1; $sCost = 0; $unCustomizeShipping=0; 
				foreach ($this->cart->contents() as $k=>$items){
					$product['product_id'] = $items['id'];
					$product['order_code'] = $order_code;
					$product['product_code'] = $items['options']['product_code'];
					$product['product_type'] = 'direct'; //$items['options']['product_type'];
					$product['customer_c_product_id'] = '';
					$product['quantity'] = $items['qty'];
					$product['price'] = $items['price'];
					$product['created_at'] = date('Y-m-d H:m:s');

					$insert = $this->db_panel->insert($product, 'ordered_products');
					$c++;
				}
			// }

			$shipping = $this->session->userdata('shipping');
			$shipping['order_code'] = $order_code;
			$shipping['user_id'] = $user_id;
			$shipping['status'] = 1;
			$insertShipping = $this->db_panel->insert($shipping, 'shipping_details');
			
			$this->cart->destroy();
			print_r($shipping);
		}

		// generate order with order id
		// update billing and shipping
		$content['template'] = 'paypal_success';
		$this->load->view('front/front-base', $content);

	}
	function paymentProcess(){
		$content = menu();
		
		$getSession = $this->session->all_userdata();
		$content['session'] = $getSession;

		$content['first_name'] = $this->input->post('first_name');
		$content['last_name'] = $this->input->post('last_name');
		$content['address'] = $this->input->post('address');
		$content['city'] = $this->input->post('city');
		$content['postcode'] = $this->input->post('postcode');
		$content['country'] = $this->input->post('country');
		$content['state'] = $this->input->post('state');
		$content['phone'] = $this->input->post('phone');
		$content['email'] = $this->input->post('email');
		$content['shipping_address'] = $this->input->post('shipping_address');

		$content['records'] = "";
		$content['template'] = 'checkoutPage';
		$content['chekoutSucc'] = "";
		$ord = array(
			'first_name' =>$content['first_name'],
			'last_name' =>$content['last_name'],
			'address' =>$content['address'],
			'city' =>$content['city'],
			'postcode' =>$content['postcode'],
			'country' =>$content['country'],
			'state' =>$content['state'],
			'phone' =>$content['phone'],
			'email' =>$content['email'],
			'shipping_address' =>$content['shipping_address']

		);
		$this->session->set_userdata($ord);
		
			 // die;
		$this->load->view('front/front-base', $content);	
	}
	function paypal_cancel(){
		// echo 'Your PayPal transaction has been canceled.';
		$data['template'] = 'paypal_cancel';
		$data['records'] = "";
		$this->load->view('front/front-base', $data);	
	}

	function paypal_success_1(){
		// ----- Destroy cart and relative data in session ---
		echo "<pre>"; print_r($this->session->userdata); echo "</pre>";
		// print_r($this->session->userdata('first_name')); 
		// echo 'Your payment has been successful.';
		// $data['template'] = 'paypal_success';
		// $data['records'] = "";
		// print_r($this->session->userdata);
		// echo $this->session->userdata('first_name');
		$getSession = $this->session->all_userdata();
		$data['session'] = $getSession;

		$data['first_name'] = $this->session->userdata('first_name');
		$data['last_name'] = $this->session->userdata('last_name');
		$data['address'] = $this->session->userdata('address');
		$data['city'] = $this->session->userdata('city');
		$data['postcode'] = $this->session->userdata('postcode');
		$data['country'] = $this->session->userdata('country');
		$data['state'] = $this->session->userdata('state');
		$data['phone'] = $this->session->userdata('phone');
		$data['email'] = $this->session->userdata('email');
		$data['shipping_address'] = $this->session->userdata('shipping_address');
		$data = array(
			'first_name' =>  $this->session->userdata('first_name'),
			'last_name' => $this->session->userdata('last_name'),
			'address' => $this->session->userdata('address'),
			'city' =>$this->session->userdata('city'),
			'postcode' => $this->session->userdata('postcode'),
			'country' => $this->session->userdata('country'),
			'state' => $this->session->userdata('state'),
			'phone' => $this->session->userdata('phone'),
			'email' => $this->session->userdata('email'),
			'shipping_address' => $this->session->userdata('shipping_address'),
			'username' => "guests",
			'status' => 1
		);
		// print_r($this->session->userdata); die;

		if(@count($this->cart->contents())>0) { 
			$i = 1; $c = 1; $sCost = 0; $unCustomizeShipping=0; 
			foreach ($this->cart->contents() as $k=>$items){
				$data['quantity'] = $items['qty'];
				$data['direct_id'] = $items['id'];
				$data['price'] = $items['price'];

				$insert = $this->db_panel->insert($data, 'order');
				$c++;
			}
		}
		// var_dump($getSession);
		for ($i=0; $i < @count($getSession['user_session']); $i++) {
			$dataS = array(
				'status' => 1,
				'username' => "guests",
			);

			$this->db_panel->update_row($data, $getSession['user_session'][$i]['id'], 'order');
		}

		$data['template'] = 'paypal_success';
		$data['records'] = array();
		$data['chekoutSucc'] = "Order Successfully";
		$this->load->view('front/front-base', $data);	
	}

	function update_cart() {
		$this->load->library('cart');
		$data = array(
               'rowid' => $this->input->post('productId'),
               'qty'   => $this->input->post('quantity')
            );

		if($this->cart->update($data))
			// echo $this->cart->total_items();
			echo count($this->cart->contents() );

	}

	function addToCart(){
		echo "<pre>"; print_r($this->input->post()); echo "</pre>"; 
		$sec = $this->session->all_userdata();
		
		$filename = (isset($_POST['filename'])) ? $_POST['filename'] : '';
		$added_date = (isset($_POST['added_date'])) ? $_POST['added_date'] : '';
		$canvas_obj = (isset($_POST['canvas_obj'])) ? $_POST['canvas_obj'] : '';
		$imageData = (isset($_POST['imageData'])) ? $_POST['imageData'] : '';
		$product_id = (isset($_POST['product_id'])) ? $_POST['product_id'] : '';
		$quantity = (isset($_POST['quantity'])) ? $_POST['quantity'] : '';

		
		$shippingCost = (isset($_POST['shippingCost'])) ? $_POST['shippingCost'] : '';
		
		$price = (isset($_POST['price'])) ? $_POST['price'] : '';

		$productCode = (isset($_POST['productCode'])) ? $_POST['productCode'] : '';
		
		$filename = (isset($_POST['filename'])) ? $_POST['filename'] : '';
		$upload_dir = base_url('filebox');
		// $image = (isset($_POST['imageData'])) ? $_POST['imageData'] : '';
		$image = str_replace('data:image/png;base64,', '', $imageData);
		$image = str_replace(' ', '+', $image);			
		$imData = base64_decode($image);	
		
		$save_path = $_SERVER['DOCUMENT_ROOT'].'/orders/'.$added_date;

		$sqlData = array(
			'image_date' => $added_date,
			'image' => $filename, 
			'image_json' => $canvas_obj,
			'product_id' => $product_id,
			// 'image_data' => $imageData,
			'quantity' => $quantity,
			'status' => 2,
			'shipping_cost' => $shippingCost,
			'price' => $price,			
			'product_code' => $productCode
		);
				
		// $this->editor_panel->updateData($data, $insertId ,'order');
		$getId = $this->editor_panel->insertOrder($sqlData, 'order');

		if ($getId==false) {
			echo json_encode(array('success'=>'false','msg' =>'Unable to Save'));
			die;
		} else {
			if (@$sec['user_session']==null) {
				$sec['user_session'] = array( array(
					'id' => $getId
				));
			} else {
				$data = array('id' => $getId);
				array_push($sec['user_session'], $data);
			}
			
		   $this->session->set_userdata($sec);
		   
		}

		// var_dump($save_path); die;
		//:: check directory exist on server if not then create.
		if(!is_dir($save_path)){
			mkdir($save_path);
		}
		$file = $save_path.'/'.$getId.'-'.$filename;
		$success = file_put_contents($file, $imData);
		if($success){
			echo json_encode(array('success'=>'true','msg' =>'Add To Cart Done'));
		}
		else
		{
			echo json_encode(array('success'=>'false','msg' =>'Unable to Save'));
		}
		
	}
}
?>