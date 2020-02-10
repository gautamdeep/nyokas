<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('db_panel');
		$this->load->library('session');
	}
	function index(){
		$username = $this->input->post('userName');
		$password = md5($this->input->post('password'));
		$data = $this->db_panel->check_admin_login($username, $password);
		if(!empty($data)){
			$sec=$this->session->all_userdata();
			$sec['userdata']=array(
				'id' => $data['id'],
				'name' => $data['firstname'].' '.$data['lastname'],
				'username' => $data['username'],
				'email' => $data['email'],
				'userlevel' => $data['userlevel'],
				'logged_in' => TRUE
			);
		   $this->session->set_userdata($sec);
			// print_r($sec['userdata']); die;
		   // echo "<pre>"; print_r($this->session); echo "</pre>"; die;
			redirect('/');
		} else{
			$data['msg'] = "Invalid User Name or Password";
			$this->load->view('admin/login',$data);
		}
	}

	function signOut(){
		$this->session->sess_destroy();
		redirect();
	}
}