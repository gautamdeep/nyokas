<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('db_panel');
	}
	function add_product(){
		$db_product = $this->db_panel->fetch_row('product_types', array('producttypename'=>$this->input->post('producttypename')));
		if(empty($db_product)){
			if ($this->db->insert('product_types', $this->input->post())) 
				$return = array('status' => 200, 'message' => "Product Added");
			else $return = array('status' => 400, 'message' => "Product unable to Add");
		}else $return = array('status' => 503, 'message' => "Product Already Added");
						
		echo json_encode($return);
	}
	function get_products(){
		$data['table'] = 'product_types';
		$data['records'] = $this->db_panel->fetch_rows('product_types');
		echo $this->load->view('admin/ajax/select-options',$data, TRUE);
	}
	function get_models(){
		$data['table'] = 'product_models';
		if(isset($_GET['productid']))
			$data['records'] = $this->db_panel->fetch_rows($data['table'] , array('producttype'=>$_GET['productid']));
		else $data['records'] = $this->db_panel->fetch_rows($data['table']);
		// print_r($data['records']);
		echo $this->load->view('admin/ajax/select-options',$data, TRUE);
	}
	function get_purchases(){
		$data['table'] = 'product_stocks';
		$whichid = (isset($_GET['id']))? 'stockentryid' : 'oldstockentryid';
		$whichvalue = (isset($_GET['id']))? $_GET['id'] : $_GET['oldstockentryid'];
		$data['records'] = $this->db_panel->fetch_rows($data['table'] , array($whichid=>$whichvalue));
		foreach($data['records'] as $row){
			$model = $this->db_panel->fetch_row('product_models', array('id' => $row->productmodelid));
			$producttype = $this->db_panel->fetch_row('product_types', array('id' => $model->producttype));
			$row->model =$model->modelname;
			$row->producttype =$producttype->producttypename;
		}
		echo $this->load->view('admin/ajax/popup-table',$data, TRUE);
	}
	function get_sales(){
		$data['table'] = 'sale_products';
		$data['records'] = $this->db_panel->fetch_rows($data['table'] , array('salesid'=>$_GET['id']));
		foreach($data['records'] as $row){
			$model = $this->db_panel->fetch_row('product_models', array('id' => $row->productmodelid));
			$producttype = $this->db_panel->fetch_row('product_types', array('id' => $model->producttype));
			$row->model =$model->modelname;
			$row->producttype =$producttype->producttypename;
		}
		echo $this->load->view('admin/ajax/popup-table',$data, TRUE);
	}
	function get_stocks(){
		$data['table'] = 'product_stocks';
		$data['records'] = $this->db_panel->fetch_rows($data['table'] , array('productmodelid' => $_GET['id']));
			print_r($data['records']);
		foreach($data['records'] as $row){
			$model = $this->db_panel->fetch_row('product_models', array('id' => $row->productmodelid));
			$producttype = $this->db_panel->fetch_row('product_types', array('id' => $model->producttype));
			$row->model =$model->modelname;
			$row->producttype =$producttype->producttypename;
		}
		echo $this->load->view('admin/ajax/popup-table',$data, TRUE);
	}
	
	function search_client_fornewcomplain(){
		$data['clients'] = $this->db_panel->fetch_rows('clients');
		// $data['complainid'] = $this->input->get('complainid');
		echo $this->load->view('admin/ajax/search-client-fornewcomplain',$data, TRUE);
	}
	function remove_ac_work_detail(){
		if(isset($_GET['aid'])) 
			if($this->db_panel->delete_row('ac_complain_works', $_GET['aid']) == 1)
				$return = array('status' => 200, 'message' => "AC Detail Removed");
			echo json_encode($return);
	}
	function populate_client_property(){
		$clientid = $this->input->get('clientid');
		$data['property'] = $this->db_panel->fetch_rows('property', array('clientid'=>$clientid));
		foreach($data['property'] as $row){
			$row->brand = $this->db_panel->fetch_value('brands', array('id'=>$row->brand), 'brandname');
			$row->type = $this->db_panel->fetch_value('ac_types', array('id'=>$row->type), 'typename');
		}
		// $data['complainid'] = $this->input->get('complainid');
		echo $this->load->view('admin/ajax/client-property',$data, TRUE);
	}
	function property_complain(){
		$propertyid = $this->input->get('propertyid');
		// $data['property'] = $this->db_panel->fetch_rows('property', array('clientid'=>$clientid));
		// foreach($data['property'] as $row){
		// 	$row->brand = $this->db_panel->fetch_value('brands', array('id'=>$row->brand), 'brandname');
		// 	$row->type = $this->db_panel->fetch_value('ac_types', array('id'=>$row->type), 'typename');
		// }
		// $data['complainid'] = $this->input->get('complainid');
		echo $this->load->view('admin/ajax/property-complain','', TRUE);
	}
	function property_by_id(){
		$propertyid = $this->input->get('propertyid');
		$data['property'] = $this->db_panel->fetch_row('property', array('id'=>$propertyid));
		echo $this->load->view('admin/ajax/client-property-by-id',$data, TRUE);
	}
}
?>