<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accounting extends CI_Controller {

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
			$data['page'] = 'panel/home';
			$data['complains']= $this->db_panel->fetch_rows('complain_log', array('deactivate!='=>'1', 'complainstatus!='=>'4'), 'id desc');
			$data['total_complains']= $this->db_panel->count_records('complain_log', array('deactivate!='=>'1'));
			$data['notice']= $this->db_panel->count_records('complain_log', array('complainremoval_request!='=>''));
			$data['total_newcomplains']= $this->db_panel->count_records('complain_log', array('deactivate!='=>'1', 'complainstatus'=>'0', 'complainstatus'=>'1'), 'id desc');
			$data['total_accountrequest']= $this->db_panel->count_records('account_request', array('account_associated'=>'0'));
			if(!empty($data['complains'])){

				foreach($data['complains'] as $row){
					$type = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'type');
					$row->type = $this->db_panel->fetch_value('ac_types', array('id'=>$type), 'typename');
					$brand = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'brand');
					$row->brand = $this->db_panel->fetch_value('brands', array('id'=>$type), 'brandname');
					$client = $this->db_panel->fetch_row('clients', array('id'=>$row->clientid));
					$loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$client->loadsheddinggroup));
					$status = $this->db_panel->fetch_row('call_status', array('id'=>$row->callstatus));
					$row->businessname = !empty($client)?$client->businessname:"Not Found";
					$row->address = !empty($client)?$client->address:"Not Found";
					$row->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
					$row->work_status = !empty($status)?$status->name:"Not Found";
				}
			}
			// print_r($data['complains']); die;
			$this->load->view('admin/admin_base', $data);
			// $ss = $this->session->userdata('userdata');
			// echo $ss['email']; die;
		}
	}
	
	function db_entry(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
				$amount = $this->input->post('amount');
				// echo "<pre>"; print_r($amount); echo "</pre>"; 
				$count = 0; $db_data = array();
				foreach($amount as $key=>$row){
					if(!empty($row)){
						// $db_data[$key] = array();
						$count++;
						$db_post= array(
							'datenep' => $this->input->post('datenep'),
							'dateeng' => $this->input->post('dateeng'),
							'categoryid' => $this->input->post('categoryid')[$key],
							'billtype' => $this->input->post('billtype')[$key],
							'amount' => $this->input->post('amount')[$key],
							'detail' => $this->input->post('detail')[$key],
						);
						$this->db->insert('daybook', $db_post);
					}else{
						// continue;
					}
				}
				// echo "<pre>"; print_r($db_data); echo "</pre>"; die;
				// if($count>0){
				// 	foreach($db_data as $key=>$db_row){

				// 	}
					// for($i=0; $i<$count; $i++){
					// 	$db_post= array(
					// 		'date-nep' => $this->input->post('date-nep'),
					// 		'date-eng' => $this->input->post('date-eng'),
					// 		'categoryid' => $this->input->post('categoryid')[$i],
					// 		'billtype' => $this->input->post('billtype')[$i],
					// 		'amount' => $this->input->post('amount')[$i],
					// 		'detail' => $this->input->post('detail')[$i],
					// 	);
					// 	if(!empty($id[$i])){
					// 		$this->db->where('id',$id[$i]);
				 //        	$this->db->update('daybook', $db_post);
					// 	}else{
					// 		$this->db->insert('daybook', $db_post);
					// 	}
					// }
				// }
				// print_r($db_post); die;
			}
			// if($this->input->post('submit') == 'continue')
			// 	// redirect('panel/calls');
			// elseif($this->input->post('submit') == 'add')
				// redirect('panel/call');
			$this->load->view('admin/admin_base', $data);
		}
	}
	function ajax_search_entry(){
		$datenep = $this->input->post('datenep');
		$data['db_data'] = $this->db_panel->fetch_rows('daybook', array('datenep'=> $datenep));
		// echo "<pre>"; print_r($data['db_data']); echo "</pre>";
		if(!isset($data['db_data'])){
			// echo "not found";
			echo $this->load->view('admin/accounting/ajax-db-entry-table',$data, TRUE);
		}else{
			// echo 'data already entered';
			echo $this->load->view('admin/accounting/ajax-db-entry-table',$data, TRUE);
		}
	}
	function ajax_save_db_entry(){
		// print_r($this->input->post());
		$id = $this->input->post('id');
		$db_post= array(
			'datenep' => $this->input->post('datenep'),
			// 'dateeng' => $this->input->post('dateeng'),
			'categoryid' => $this->input->post('categoryid'),
			'billtype' => $this->input->post('billtype'),
			'amount' => $this->input->post('amount'),
			'detail' => $this->input->post('detail'),
		);
		if($id==0){
			$this->db->insert('daybook', $db_post);
		}else{
			$this->db->where('id',$id);
        	$this->db->update('daybook', $db_post);
		}

		$datenep = $this->input->post('datenep');
		$data['db_data'] = $this->db_panel->fetch_rows('daybook', array('datenep'=> $datenep));
		echo $this->load->view('admin/accounting/ajax-db-entry-table',$data, TRUE);
	}
	function ajax_delete_db_entry(){
		$session = $this->session->all_userdata();
		if (empty($session['userdata'])) {
			$this->load->view('admin/login');
		}else{
			$id = $this->input->post('id');
			$datenep = $this->input->post('datenep');
			if($this->db_panel->delete_row('daybook', $id)){
				$data['db_data'] = $this->db_panel->fetch_rows('daybook', array('datenep'=> $datenep));
				echo $this->load->view('admin/accounting/ajax-db-entry-table',$data, TRUE);
			}else {
				$data['db_data'] = $this->db_panel->fetch_rows('daybook', array('datenep'=> $datenep));
				echo $this->load->view('admin/accounting/ajax-db-entry-table',$data, TRUE);
			}
		}
	}
	
	function db_summary($filter = 'all'){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['calls']= $this->db_panel->fetch_rows('calls', array('deactivate!='=>'1', 'callstatus!='=>'6'), 'id desc');
			$this->load->view('admin/admin_base', $data);
		}
	}
	// function ajax_db_summary(){
	// 	$columns = array(
	// 	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	// 	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	// 	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	// 	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	// 		);
	// 	echo json_encode($columns);
	// }
	function ajax_db_summary(){
		$is_date_search = $this->input->post('is_date_search');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$this->db->where('datenep >=', $start_date);
		$this->db->where('datenep <=', $end_date);
		// $this->db->group_by("billtype");
		$db = $this->db->get('daybook')->result();
		// print_r($db);
		// $this->db->select_sum('amount');
		// $this->db->select('daybook.*');
		// $this->db->select('SUM(daybook.amount) as amt');
		// $this->db->from('daybook');
		// $this->db->where('datenep >=', $start_date);
		// $this->db->where('datenep <=', $end_date);
		// $dbAmt = $this->db->get();
		// if ($dbAmt->num_rows() > 0) {
  //           echo 'rec found';
  //       } else {
  //           echo 'no rec';
  //       }
		// echo 'amt ';
		// print_r($dbAmt);
		$returndb = array();
		$cat_ids_arr = array();
		$cat_amt_sum_arr = array();
		$totalSumAmt = 0;
		foreach($db as $db_row){
			if(!in_array($db_row->categoryid, $cat_ids_arr)){
				array_push($cat_ids_arr, $db_row->categoryid);
			}
		}
		// print_r($cat_ids_arr);
		// now use cat_sum_array to sum the amount acc to categoryid
		// put cat_ids_arr values in key of cat_sum_arr
		// then according to key of cat_sum_arr find the categoryid and put its amount on cat_sum_arr acc to its key
		foreach($cat_ids_arr as $cat_row){
			$subarray = array();
			$sum = 0;
			$type = 0;
			$dVB = $this->db_panel->fetch_rows('daybook', array('categoryid'=>$cat_row, 'billtype'=>'VB'));
			$dPB = $this->db_panel->fetch_rows('daybook', array('categoryid'=>$cat_row, 'billtype'=>'PB'));
			$dNB = $this->db_panel->fetch_rows('daybook', array('categoryid'=>$cat_row, 'billtype'=>'NB'));
			// VAT Bill
			foreach($dVB as $r){
				$sum = $sum + $r->amount;	
				$totalSumAmt = $totalSumAmt + $sum;
				$type = $r->billtype;
			} 
			$subarray[] = $start_date.' to '.$start_date;
			$category = $this->db_panel->fetch_value('account_category', array('id'=>$cat_row), 'title');
			$subarray[] = $category;
			$subarray[] = $type;
			$subarray[] = $sum;
			$subarray[] = 'detail here';
			$cat_amt_sum_arr[] = $subarray;
			// PAN Bill
			$subarray = array();
			$sum = 0;
			$type = 0;
			foreach($dPB as $r){
				$sum = $sum + $r->amount;		
				$totalSumAmt = $totalSumAmt + $sum;
				$type = $r->billtype;
			}$subarray[] = $start_date.' to '.$start_date;
			$category = $this->db_panel->fetch_value('account_category', array('id'=>$cat_row), 'title');
			$subarray[] = $category;
			$subarray[] = $type;
			$subarray[] = $sum;
			$subarray[] = 'detail here';
			$cat_amt_sum_arr[] = $subarray;
			// NO Bill
			$subarray = array();
			$sum = 0;
			$type = 0;
			foreach($dNB as $r){
				$sum = $sum + $r->amount;		
				$totalSumAmt = $totalSumAmt + $sum;
				$type = $r->billtype;
			} 
			$subarray[] = $start_date.' to '.$start_date;
			$category = $this->db_panel->fetch_value('account_category', array('id'=>$cat_row), 'title');
			$subarray[] = $category;
			$subarray[] = $type;
			$subarray[] = $sum;
			$subarray[] = 'detail here';
			$cat_amt_sum_arr[] = $subarray;
			// echo "<pre>"; print_r($cat_amt_sum_arr); echo "</pre>"; 
		}
		$totalSumAmtarray = array();
		$totalSumAmtarray[] = '<strong>Total Amount in Rs.</strong>';
		$totalSumAmtarray[] = '';
		$totalSumAmtarray[] = '';
		$totalSumAmtarray[] = '<strong>'.$totalSumAmt.'</strong>';
		$totalSumAmtarray[] = '';
		$cat_amt_sum_arr[] = $totalSumAmtarray;
		echo json_encode($cat_amt_sum_arr);
		// print_r($cat_amt_sum_arr);
		
	}
	function account_head($id = NULL){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			if(!empty($id) && is_numeric($id)) 
				$data['record'] = $this->db_panel->fetch_row('account_category', array('id'=>$id));
			elseif($this->input->post('id')){
				// die('editing');
				$up_data = array(
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description')
				);
				if($this->db_panel->update_row('account_category',$this->input->post('id'),$up_data) == 'true')
					$this->session->set_flashdata('message','Updated successfully!!!');
			}
			elseif(empty($id) && $this->input->post()){
				// die('hey'.$id);
				if($this->db_panel->insert($this->input->post(), 'account_category') == 'true'){
					$this->session->set_flashdata('message','Added successfully!!!');
				}
				// print_r($this->input->post()); die;
			}
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			// if(isset($id)){ $data['page'] .= '/'.$id; }
			$data['title'] = 'account_category';
			$data['records']= $this->db_panel->fetch_rows('account_category');
			// die($data['page']);
			$this->load->view('admin/admin_base', $data);
			// print_r($data);
		}
	}
}
?>