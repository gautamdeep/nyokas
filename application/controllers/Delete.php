<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Delete extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('url_helper');
		$this->load->helper('db_helper');
		$this->load->model('db_panel');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->library('calendar');
		$this->load->helper('captcha');
		$this->load->helper('string');		
		$this->load->helper('directory');
		$session = $this->session->all_userdata();
	}

	function index($module, $id){
		$session = $this->session->all_userdata();
		if (empty($session['userdata'])) {
			$this->load->view('admin/login');
		}else{
			
			$this->db_panel->delete_row($module, $id);
			$this->session->set_flashdata('message','Deleted successfully!!!');
			$this->load->library('user_agent');
			redirect($this->agent->referrer());
			// redirect("admin/".$module);
		}
	}
	function client($id){
		$session = $this->session->all_userdata();
		if (empty($session['userdata'])) {
			$this->load->view('admin/login');
		}else{
			// DELETE complain_activity, complains, property, clients
			$complains = $this->db_panel->fetch_rows('complains', array('clientid'=>$id));
			print_r($complains); die;
			
			// $this->db_panel->delete_row('c', $id);
		}
	}
	
}
?>