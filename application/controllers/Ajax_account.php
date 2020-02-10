<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_account extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('db_panel');
		$this->load->helper('mr_robot');
	}
	function populate_client(){
		$data['reqid'] = $this->input->post('reqid');
		$data['clients'] = $this->db_panel->fetch_rows('clients');
		echo $this->load->view('admin/ajax-account/populate-client',$data, TRUE);
	}
	function set_accountdetail(){
		if($this->input->post()){
			$reqid = $this->input->post('reqid');
			$clientid = $this->input->post('clientid');
			$data['client'] = $this->db_panel->fetch_row('clients', array('id'=>$clientid));
			$data['req'] = $this->db_panel->fetch_row('account_request', array('id'=>$reqid));
			$check_duplicate = array('email' => $data['req']->email);
			$check = $this->db_panel->check_duplicate('users',$check_duplicate);
			if($check == 1){
				$return = array('status' => 400, 'message' => "User has been already register by this Email. Please use another Email or Recover your account.");
			}else{
				$businessname = $data['req']->businessname;
				$firstname = $data['req']->firstname;
				$lastname = $data['req']->lastname;
				$forusername = array(
					'businessname' => $businessname,
					'firstname' => $firstname,
					'lastname' => $lastname	
				);
				$data['username'] = set_username( $forusername );
				$echo = $this->load->view('admin/ajax-account/populate-accountdetail',$data, TRUE);
				$return = array('status' => 200, 'message' => $echo);
            }
			echo json_encode($return);
        }
	}
	function post_accountdetail(){
		// print_r($this->input->post());
		$update_client = array(
			'businessname' => $this->input->post('businessname'),
			'city' => $this->input->post('city'),
			'address' => $this->input->post('address'),
			'landmark' => $this->input->post('landmark'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),	
			'email1' => $this->input->post('email'),	
			'phone1' => $this->input->post('phone'),	
			'mobile1' => $this->input->post('mobile')
		);
		// update client table
		$this->db->where('id', $this->input->post('clientid'));
		$this->db->update('clients', $update_client);
		$client = $this->db->where('id', $this->input->post('clientid'))->get('clients')->row_object();
		// get username
		$businessname = $client->businessname;
		$firstname = $client->firstname;
		$lastname = $client->lastname;
		$forusername = array(
			'businessname' => $businessname,
			'firstname' => $firstname,
			'lastname' => $lastname	
		);
		$username = set_username( $forusername );
		// $password = set_password( $username );
		list($password_show, $password) = set_password( $username );
		$post_user = array(
			'clientid' => $this->input->post('clientid'),
			'firstname' => $this->input->post('userfirstname'),
			'lastname' => $this->input->post('userlastname'),
			'email' => $this->input->post('useremail'),
			'username' => strtolower($username),
			'password_show' => $password_show,
			'password' => $password,
			'userlevel' => '1',
			'verified' => '1',
			'createdat' => date('Y-m-d')
		);
		// insert user
		if($this->db->insert('users', $post_user)) {
	    	$last_id = $this->db->insert_id();
	    	$this->db->where('id', $this->input->post('reqid'));
			$this->db->update('account_request', array('account_associated'=> $last_id));
	    	// $echo = $this->load->view('admin/ajax-account/success-accountcreation',$data, TRUE);
	    	$return = array('status' => 200, 'message' => 'Account Created', 'userid' => $last_id);
        }else $return = array('status' => 400, 'message' => 'Account Creation Failed');
		echo json_encode($return);
	}
	function send_email(){
		$data = $this->input->post();
		$echo = $this->load->view('admin/ajax-account/email-template', $data, TRUE);

		$htmlContent = '<h1>HTML email testing by CodeIgniter Email Library</h1>';
		$htmlContent .= '<p>You can use any HTML tags and content in this email.</p>';
	    $this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		// $this->email->to($data['email']);
		$this->email->to($this->input->post('email'));
		$this->email->from('nyokasconcern@gmail.com','Nyokas Concern');
		$this->email->subject('Service Center Notification');
		$body =  $this->load->view('admin/ajax-account/email-template', $data, TRUE);
		$this->email->message($body);
		if($this->email->send()){
			$return = array('status' => 200, 'template' => $body);
			echo json_encode($return);
		}
	}
	function get_newaccountform(){
		$data['req'] = $this->db_panel->fetch_row('account_request', array('id'=>$this->input->post('reqid')));
		$echo =  $this->load->view('admin/ajax-account/new-account-form', $data, TRUE);
		$return = array('status' => 200, 'template' => $echo);
		echo json_encode($return);
	}
	function post_newaccount(){
		$post_client = array(
			'businessname' => $this->input->post('businessname'),
			'city' => $this->input->post('city'),
			'address' => $this->input->post('address'),
			'landmark' => $this->input->post('landmark'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),	
			'email1' => $this->input->post('email'),	
			'phone1' => $this->input->post('phone'),	
			'mobile1' => $this->input->post('mobile')
		);
		// update client table
		$this->db->insert('clients', $post_client);
		$last_clientid = $this->db->insert_id();
		$client = $this->db->where('id', $last_clientid)->get('clients')->row_object();
		// get username
		$businessname = $client->businessname;
		$firstname = $client->firstname;
		$lastname = $client->lastname;
		$forusername = array(
			'businessname' => $businessname,
			'firstname' => $firstname,
			'lastname' => $lastname	
		);
		$username = set_username( $forusername );
		list($password_show, $password) = set_password( $username );
		$post_user = array(
			'clientid' => $last_clientid,
			'firstname' => $this->input->post('userfirstname'),
			'lastname' => $this->input->post('userlastname'),
			'email' => $this->input->post('useremail'),
			'username' => strtolower($username),
			'password_show' => $password_show,
			'password' => $password,
			'userlevel' => '1',
			'verified' => '1',
			'createdat' => date('Y-m-d')
		);
		// insert user
		if($this->db->insert('users', $post_user)) {
	    	$last_id = $this->db->insert_id();
	    	$this->db->where('id', $this->input->post('reqid'));
			$this->db->update('account_request', array('account_associated'=> $last_id));
	    	// $echo = $this->load->view('admin/ajax-account/success-accountcreation',$data, TRUE);
	    	$return = array('status' => 200, 'message' => 'Account Created', 'userid' => $last_id);
        }else $return = array('status' => 400, 'message' => 'Account Creation Failed');
		echo json_encode($return);
	}
}
?>