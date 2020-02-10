<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller {

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
	}

	function new_request(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['records']= $this->db_panel->fetch_rows('account_request', array('account_associated'=>'0'), 'id desc');
			$this->load->view('admin/admin_base', $data);
		}
	}
	
	function new_creation($id = NULL){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
		        $p_data = array(
		            'businessname' => $this->input->post('businessname'),
					'city' => $this->input->post('city'),
					'address' => $this->input->post('address'),
					'landmark' => $this->input->post('landmark'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'repfirstname' => $this->input->post('repfirstname'),
					'replastname' => $this->input->post('replastname'),
					'email1' => $this->input->post('email1'),
					'phone1' => $this->input->post('phone1'),
					'email2' => $this->input->post('email2'),
					'phone2' => $this->input->post('phone2'),
					'loadsheddinggroup' => $this->input->post('loadshedding')
				);
			}
			// echo "<pre>"; print_r($this->input->post()); die;
			if (!empty($id) || $this->input->post('id')) {
        		if($this->input->post()){
        			if($id == '') $id = $this->input->post('id');
        			$p_data['updated_at'] = date('Y-m-d H:i:s');
	        		$this->db->where('id',$id);
			        $this->db->update('clients',$p_data);
	        		$this->db->where('id', $id);
	        	}
	        	$data['record'] = $this->db->where('id', $id)->get('account_request')->row_object();
			}
			else{
				if($this->input->post()){
					$p_data['created_at'] =  date('Y-m-d H:i:s');
					// print($p_data); echo 'pdata';
					if ($this->db->insert('clients', $p_data)) {
		            	$last_id = $this->db->insert_id();
		            	// $callid = get_code($this->input->post('producttypeid'), $last_id);
		            	
			            // $up_data = array('callid'=>$callid);
			            // $this->db->where('id',$last_id);
			            // $this->db->update('clients',$up_data);
			            $data['record']= $this->db->where('id', $last_id)->get('clients')->row_object();
			            $data['properties'] = $this->db->where('clientid', $id)->get('property')->result_object();
			            foreach($data['properties'] as $row){
			        		// $row->type = $this->db_panel->fetch_value('ac_types',array('id'=>$row->type), 'typename');
			        	}
		            	$this->data['record'] = $p_data;
			            $this->data['message'] = 'Saved Successfully!!!';
			            $this->session->set_flashdata('message','Updated successfully!!!');
					}
				}
			}
			
			$this->load->view('admin/admin_base', $data);
		}
	}	
	function creation_success($userid){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['record']= $this->db->where('id', $userid)->get('users')->row_object();
			$this->load->view('admin/admin_base', $data);
		}
	}
}
?>