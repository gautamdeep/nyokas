<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Controller {

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
		$this->load->helper('db_helper');
		$this->load->library('session');
		$this->load->library('cart');
	}

	public function index(){
		redirect('member/dashboard');
	}
	public function login(){
		// print_r($this->input->POST());
		if(!empty($this->input->post('email')) && !empty($this->input->post('Password'))){
			// echo $this->input->post('email');
			// echo $this->input->post('Password');
			$user= $this->db_panel->check_login($this->input->post('email'), $this->input->post('Password'));
			// print_r($user); 
			if(!empty($user))
			{
				// $this->load->library('cart');
				// $userInfo = $this->login_panel->get_user('users');
				// var_dump($userInfo); die;
				$sec=$this->session->all_userdata();
				$sec['member_data']=array(
					'id' => $user->id,
					'checkouttype' => 'returned',
					'firstname' => $user->firstname,
					'lastname' => $user->lastname,
					'email' => $user->email,
					'contact' => $user->contact,
					'address' => $user->address,
					'customer_id' => $user->customer_id,
					'logged_in' => TRUE
				);
			   	$this->session->set_userdata($sec);
				// $this->load->view('customer/dashboard');
				echo json_encode(array('status' => true,'msg' => 'Valid Username Or Password' ));
			} else {
				echo json_encode(array('status' => false,'msg' => 'Invalid Username Or Password' ));
			}
		}
		// else {
		// 	$content['records']= $this->db_panel->fetch_rows('product_categories', array('status' => 1) , '', '0', '4');
		// 	$content["template"] = 'home';
		// 	$this->load->view('front/front-base', $content);
		// }
	}
	function guestLogin(){
		if($this->input->post('guestemail')){
			$sec['member_data']=array(
				'checkouttype' => 'guest',
				'email' => $this->input->post('guestemail')
			);
			$this->session->set_userdata($sec);
			redirect('cart/checkoutBillingShipping');
		}
	}
	function dashboard($template = '') {
		if (($this->session->userdata('member_data')['customer_id']) == NULL) {
			redirect('/');
		}else{
			// $content = menu();
			$content["template"] = "profile";
			$content["session"] = $this->session->all_userdata();
			$content['member_info'] = $content["session"]['member_data'];
			if ($template=='order') {
	    		
				if($this->uri->segment(3) == TRUE){
					$content["template"] = 'order-detail';
					$content['orderProduct'] = $this->db_panel->fetch_rows('ordered_products', array('order_code' => $this->uri->segment(3)));
					for ($i=0; $i < count($content['orderProduct']); $i++) { 
						$product_id = $content['orderProduct'][$i]->product_code;
						if($content['orderProduct'][$i]->product_type == 'direct') 
							$type = 'd_products'; 
						else $type = 'c_products';
						$product = $this->db_panel->fetch_row($type, array('product_code'=>$product_id));
						// print_r($product);
						$content['orderProduct'][$i]->product_name = $product['product_name'];
						$content['orderProduct'][$i]->price = $product['price'];
						$content['orderProduct'][$i]->image = $product ['image'];
					}
				}else {
		    		$content["template"] = $template;
					$content['orders'] = $this->db_panel->fetch_rows('orders', array('customer_id' => $user_info['user_id'], 'order_status' => 1));
				}
				
				$this->load->view('customer/base', $content);
			} else if ($template=="logOut") {
				$sec=$this->session->all_userdata();
				$this->session->unset_userdata($sec);
				redirect('/');
			} else {
				$content["template"] = 'dashboard';
				// $content['data'] = array('name'=>'hali', 'phone'=>'8989');
				$this->load->view('front/front-base', $content);
			}
			
			
		}
		
		
		
	}

	function signUp(){
		$content['categories']= $this->db_panel->fetch_rows('categories', array('status' => 1) , 'id desc', '0', '4');
		$content['c_products']= $this->db_panel->fetch_rows('d_products', array('status'=> 1), 'id desc', '0', '4');
		$content['d_products']= $this->db_panel->fetch_rows('d_products', array('status'=> 1), 'id desc', '0', '4');
		
		$content['records'] = "";
		$content['template'] = 'signUp';
		$this->load->view('front/front-base', $content);
	}

	function signOut(){
		$this->session->unset_userdata('member_data');
		redirect('/');
	}

	function forgetPassword(){
		if($this->input->post()) {
			$v = $this->validateEmail( $this->input->post('email') );
			if($v == 1) {
				$content['message'] = 'Sorry, this email has no account with us.';
			}elseif($v == 3){
				$content['message'] = 'Please enter valid Email';
			}else{
				$password = get_random_password();
				$changed = change_forget_password($this->input->post('email'), $password);
				// if($changed == TRUE){
					// echo $password;
					//send mail to user 

					$this->email->from('13deepkiran@gmail.com', 'Creative ideas');
					$this->email->to('mojoking.black@gmail.com'); 

					$this->email->subject('Password Recovery');
					$this->email->message('Your recovered password is '.$password);	

					$this->email->send();
				// }
					$content['message2'] = 'Your new password is sent to your email.';
			}
			
		}
		$content['records'] = "";
		$content['template'] = "forget-password";
		$this->load->view('front/front-base', $content);
	}

	function validateEmail($email = NULL){
		if($this->input->post()){
			$email = $this->input->post('email');
		}
		if (!valid_email($email)){
    		echo 3;
    		return;
		}
		$result= $this->db_panel->fetch_rows('users', array('email' => $email));
		if(count($result)>0){
			echo 2;
			return 2;
		}  else{
			echo 1;
			return 1;
		} 
	}

	function registerCustomer(){
		if($this->input->post('email')){ 
			$data = array(
				'email' => $this->input->post('email'),
				// 'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'address' => $this->input->post('address'),
				'contact' => $this->input->post('contact'),
				// 'city' => $this->input->post('city'),
				// 'country' => $this->input->post('country'),
				// 'state' => $this->input->post('state'),
				// 'postcode' => $this->input->post('postcode'),
				// 'user_type' => "customer",
				'created_at' => date('Y-m-d H:i:s')
			);

			$customer= $this->db_panel->check_duplicate(array('email'=>$data['email']));
			if(empty($customer)){
				$this->db_panel->insert($data, 'customers');	
				$last_id = $this->db->insert_id();
				$customer_id = get_code($this->input->post('firstname'), $last_id);
				$up_data = array('customer_id'=>$customer_id, 'status' => 1);
	            $this->db->where('id',$last_id);
	            $this->db->update('customers',$up_data);
				            
				if ($this->db->update('customers',$up_data)) {
					$msg = array(
						'status' => "success", 
						'message' => "User Registration SuccessFull"
					);
					$customer = $this->db->where('id', $last_id)->get('customers')->result_object();
					set_session($customer); 
					if(!empty($this->input->post('goto'))) redirect($this->input->post('goto'));
				// echo "<pre>"; print_r($this->session->userdata); die;
				} else {
					$msg = array(
						'status' => "error", 
						'message' => "Unable To Insert.Please Try Again!"
					);
				}
			} else {
				$msg = array(
					'status' => "error", 
					'message' => "Duplicate Email Please Use Another Email"
				);
			}
			echo json_encode($msg);
		}
		elseif(!empty($this->input->post('return'))) {
			// going to check out signup again
			$this->session->set_flashdata('error', '*** Please enter your details');
			redirect($this->input->post('return'));	
		}else{
			$msg = array(
				'status' => "error", 
				'message' => "Please enter details"
			);
			echo json_encode($msg);
		}
	}
	function editProfile(){
		if ($this->session->userdata('member_data') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$customer = $this->db_panel->fetch_row('customers', array('customer_id'=>$this->session->userdata('member_data')['customer_id']));
			// print_r($customer);
			$content['template']='editProfile';
			$this->load->view('front/front-base', $content);
		}
	}
	function editPassword(){
		if ($this->session->userdata('member_data') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$customer = $this->db_panel->fetch_row('customers', array('customer_id'=>$this->session->userdata('member_data')['customer_id']));
			// print_r($customer);
			$content['template']='editPassword';
			$this->load->view('front/front-base', $content);
		}
	}
	function profileUpdate(){
		$email = $this->input->post('email');
		
		$data = array(
			'firstname' => $this->input->post('firstName'),
			'lastname' => $this->input->post('lastName'),
			'address' =>$this->input->post('address'),
			'contact' => $this->input->post('contact')
		);
		if($this->db_panel->update_row_by_email($data, $email, 'customers')){
			$user = $this->db_panel->fetch_row('customers', array('email'=>$email));
			$sec['member_data']=array(
				'customer_id' => $user->customer_id,
				'firstname' => $user->firstname,
				'lastname' => $user->lastname,
				'email' => $user->email,
				'contact' => $user->contact,
				'address' => $user->address,
				'logged_in' => TRUE
			);
		   	$this->session->set_userdata($sec);
			$msg = array(
				'status' => "success", 
				'message' => "Profile Updated SuccessFully"
			);
		}else{
			$msg = array(
				'status' => "error", 
				'message' => "Unable to Update. Please Try again Later."
			);
		}
		echo json_encode($msg);
	}

	function passwordUpdate(){
		$newPass = $this->input->post('newPass');
		$oldPass = $this->input->post('oldPass');
		
		$user= $this->db_panel->check_login($this->session->userdata('member_data')['email'], $oldPass);
		if (empty($user)) {
			$msg = array(
				'status' => "error", 
				'message' => "Please Enter Valid Old Password"
			);
		}else {
			$up_data = array('password'=>md5($newPass));
            $this->db->where('id',$user->id);
            if ($this->db->update('users',$up_data)) {
				$msg = array(
					'status' => "success", 
					'message' => "Password Successfully Updated"
				);
			} else {
				$msg = array(
					'status' => "error", 
					'message' => "Unable To Update Password. Please Try Again!"
				);
			}

		}
		echo json_encode($msg);		
	}

	function view_products_acc_to_category($cat_id) {
		echo $cat_id;
		$data['records'] = $this->admin_panel->fetch_rows('products', array('status' => 1, 'category' => $cat_id ));
		// echo 'view_products_acc_to_category';
		// echo "<pre>";
		// print_r($data['records']);
		// echo "</pre>";
		$this->load->view('front/plain', $data);
	}

	function customize_product(){
		$this->load->view('front/customize');
	}
}
?>