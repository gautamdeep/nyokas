<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller {

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
		// print_r($this->session->all_userdata()); die;
		// echo "<pre>"; print_r($this->session->userdata('userdata')); echo "<pre>"; die;
		
		if (empty($this->session->userdata['userdata'])) {
			$this->load->view('admin/login');
		}else{
			$this->load->view('admin/index');
		}
	}
	function loadshedding_group($id = NULL){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			if(!empty($id) && is_numeric($id)) 
				$data['record'] = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$id));
			elseif($this->input->post('id')){
				// die('editing');
				$up_data = array(
					'groupname' => $this->input->post('groupname'),
					'description' => $this->input->post('description')
				);
				if($this->db_panel->update_row('loadshedding_group',$this->input->post('id'),$up_data) == 'true')
					$this->session->set_flashdata('message','Updated successfully!!!');
			}
			elseif(empty($id) && $this->input->post()){
				// die('hey'.$id);
				if($this->db_panel->insert($this->input->post(), 'loadshedding_group') == 'true'){
					$this->session->set_flashdata('message','Added successfully!!!');
				}
				// print_r($this->input->post()); die;
			}
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			// if(isset($id)){ $data['page'] .= '/'.$id; }
			$data['title'] = 'Loadshedding Group';
			$data['records']= $this->db_panel->fetch_rows('loadshedding_group');
			// die($data['page']);
			$this->load->view('admin/admin_base', $data);
			// print_r($data);
		}
	}
	function ac_types($id = NULL){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			if(!empty($id) && is_numeric($id)) 
				$data['record'] = $this->db_panel->fetch_row('ac_types', array('id'=>$id));
			elseif($this->input->post('id')){
				$up_data = array(
					'typename' => $this->input->post('typename'),
				);
				if($this->db_panel->update_row('ac_types',$this->input->post('id'),$up_data) == 'true')
					$this->session->set_flashdata('message','Updated successfully!!!');
			}
			elseif(empty($id) && $this->input->post()){
				if($this->db_panel->insert($this->input->post(), 'ac_types') == 'true'){
					$this->session->set_flashdata('message','Added successfully!!!');
				}
			}
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['title'] = 'AC Types';
			$data['records']= $this->db_panel->fetch_rows('ac_types');
			$this->load->view('admin/admin_base', $data);
		}
	}

	function product_models($id = NULL){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			if(!empty($id) && is_numeric($id)) 
				$data['record'] = $this->db_panel->fetch_row('product_models', array('id'=>$id));
			elseif($this->input->post('id')){
				$up_data = array(
					'producttype' => $this->input->post('producttype'),
					'modelname' => $this->input->post('modelname'),
				);
				if($this->db_panel->update_row('product_models',$this->input->post('id'),$up_data) == 'true')
					$this->session->set_flashdata('message','Updated successfully!!!');
			}
			elseif(empty($id) && $this->input->post()){
				if($this->db_panel->insert($this->input->post(), 'product_models') == 'true'){
					$this->session->set_flashdata('message','Added successfully!!!');
				}
			}
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['title'] = 'Product Models';
			$data['records']= $this->db_panel->fetch_rows('product_models');
			if(!empty($data['records'])){
				foreach($data['records'] as $row){
					$type = $this->db_panel->fetch_row('product_types', array('id' => $row->producttype));
					// print_r($type); die;
					$row->producttypename = !empty($type)?$type->producttypename :"Not Found";
				}
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	function property_brand($id = NULL){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$userdata = $this->session->userdata('userdata');
			// print_r($userdata); die;
			if(!empty($id) && is_numeric($id)) 
				$data['record'] = $this->db_panel->fetch_row('brands', array('id'=>$id));
			elseif($this->input->post('id')){
				$up_data = array(
					'brandname' => $this->input->post('brandname'),
					'description' => $this->input->post('description'),
					'addedby' => $userdata['id'],
				);
				if($this->db_panel->update_row('brands',$this->input->post('id'),$up_data) == 'true')
					$this->session->set_flashdata('message','Updated successfully!!!');
			}
			elseif(empty($id) && $this->input->post()){

				if($this->db_panel->insert($this->input->post(), 'brands') == 'true'){
					$this->session->set_flashdata('message','Added successfully!!!');
				}
			}
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['title'] = 'Brand';

			$data['records']= $this->db_panel->fetch_rows('brands');
			if(!empty($data['records'])){
				foreach($data['records'] as $row){
					$userlevel = $this->db_panel->fetch_value('users',array('id'=>$row->addedby), 'userlevel');
					$row->userlevel = (!empty($userlevel) && $userlevel == 3)? 'Admin' :"Client";
				}
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	function employees($id = NULL){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			if(!empty($id) && is_numeric($id)) 
				$data['record'] = $this->db_panel->fetch_row('employees', array('id'=>$id));
			elseif($this->input->post('id')){
				// die('editing');
				$up_data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'citizenno' => $this->input->post('citizenno'),
					'post' => $this->input->post('post'),
					'enrolldate' => $this->input->post('enrolldate')
				);
				if($this->db_panel->update_row('employees',$this->input->post('id'),$up_data) == 'true')
					$this->session->set_flashdata('message','Updated successfully!!!');
			}
			elseif(empty($id) && $this->input->post()){
				// die('hey'.$id);
				if($this->db_panel->insert($this->input->post(), 'employees') == 'true'){
					$this->session->set_flashdata('message','Added successfully!!!');
				}
				// print_r($this->input->post()); die;
			}
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			// if(isset($id)){ $data['page'] .= '/'.$id; }
			$data['title'] = 'Employees';
			$data['records']= $this->db_panel->fetch_rows('employees');
			// die($data['page']);
			$this->load->view('admin/admin_base', $data);
			// print_r($data);
		}
	}
	
}
?>