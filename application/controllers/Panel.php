<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Panel extends CI_Controller {

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
		// echo "<pre>"; print_r($this->session); echo "</pre>";
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		// if (empty($this->session->userdata['userdata'])) {
		// 	// die('here');
		// 	$this->load->view('admin/login');
		// }
		else{
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
	function call($callid = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			// echo "<pre>"; print_r($this->input->post());echo "</pre>"; die; 
			// $data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); 
			// $data['page'] = $this->uri->segment(1).'/open-quick-call';
			if($this->input->post()){
				if(!empty($this->input->post('clientid'))){
					// $complaintype = $this->input->post('complaintype');
					// $prefix = $complain_ids = '';
					// foreach ($complaintype as $row)
					// {
					//     $complain_ids .= $prefix . $row;
					//     $prefix = ',';
					// }
					$usersession = $this->session->userdata('userdata');
					$reg_datetime = (!($this->input->post('reg_datetime')))? $this->input->post('reg_datetime'):date('Y-m-d H:i:s');
					$call_data = array(
						'clientid' => $this->input->post('clientid'),
						'propertytypeid' => $this->input->post('propertytypeid'),
						'calltypeid' => $this->input->post('calltypeid'),
						'term' => $this->input->post('term'),
						'callsource' => $this->input->post('callsource'),
						'regby_name' => $this->input->post('regby_name'),
						'regby_phone' => $this->input->post('regby_phone'),
						'reg_datetime' => $this->input->post('reg_datetime'),
						'priority' => !empty($this->input->post('priority'))? 1:0,
						'duedatetime' => $this->input->post('duedatetime'),
						'calldetail' => $this->input->post('calldetail'),
						'callstatus' => $this->input->post('callstatus'),
						'internalnote' => $this->input->post('internalnote'),
						'calldetail' => $this->input->post('calldetail'),
						'job_assign' => $this->input->post('jobassign'),
					);
					if(trim($this->input->post('callid')) != NULL){
			        	$call_id = $this->input->post('callid'); 
			        	$call_data['updated_at'] = date('Y-m-d H:i:s');
			        	$this->db->where('id',$call_id);
			        	$this->db->update('calls', $call_data);
			        	$this->session->set_flashdata('message','Call updated !!!');
			        }else{
			        	$call_data['created_at'] = date('Y-m-d H:i:s');
			        	$this->db->insert('calls', $call_data);
						$call_id = $this->db->insert_id();
						$this->session->set_flashdata('message','Call updated !!!');
					}
					// redirect('panel/call/'.$call_id);
				// $data['page'] = $this->uri->segment(1).'/open-quick-call';
				}else{
					$this->session->set_flashdata('message','Please select Client and enter Complain !!!');
				}
			} 
			if(!empty($callid) || $this->input->post('callid')){
				$call = $this->db->where('id', $callid)->get('calls')->row_object();
				// foreach($complain as $row){
					$client = $this->db_panel->fetch_row('clients', array('id'=>$call->clientid));
				// print_r($client); echo $call->clientid; die;
					// $loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$client->loadsheddinggroup));
					$call->businessname = !empty($client)?$client->businessname:"Not Found";
					$call->address = !empty($client)?$client->address:"Not Found";
					$call->landmark = !empty($client)?$client->landmark:"Not Found";
					$call->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
					// $data['property'] = $this->db_panel->fetch_row('property', array('id'=>$call->propertyid));
					// $data['property']->type = $this->db_panel->fetch_value('ac_types',array('id'=>$data['property']->type), 'typename'); 
					$activity = $this->db_panel->fetch_row('call_activity', array('callid'=>$callid));
					$data['record'] = $call;
					$data['page'] = $this->uri->segment(1).'/update-call';
					// echo "<pre>"; print_r($data['record']); die;
				// }
			}else{
				$data['page'] = $this->uri->segment(1).'/open-quick-call';
			}
			if($this->input->post('submit') == 'view')
				redirect('panel/calls');
			elseif($this->input->post('submit') == 'add')
				redirect('panel/call');
			else{
				// die('hello');
				// echo $data['page'];
				$this->load->view('admin/admin_base', $data);
				}
		}
	}
	function calls($filter = 'all'){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['calls']= $this->db_panel->fetch_rows('calls', array( 'callstatus!='=>'6', 'callstatus!='=>'5' ,'deactivate!='=>'1'), 'id desc');
			// echo "<pre>"; print_r($data['calls']);die();
			if(!empty($data['calls'])){
				foreach($data['calls'] as $row){
					$row->propertytype = $this->db_panel->fetch_value('property_types', array('id'=>$row->propertytypeid), 'title');
					$row->calltype = $this->db_panel->fetch_value('call_types', array('id'=>$row->calltypeid), 'title');
					$row->callsource = $this->db_panel->fetch_value('call_source', array('id'=>$row->callsource), 'title');
					$row->callterm = $this->db_panel->fetch_value('call_term', array('id'=>$row->term), 'title');
					$row->jobassign = $this->db_panel->fetch_value('employees', array('id'=>$row->job_assign), 'firstname');
					$row->callstatus = $this->db_panel->fetch_value('call_status', array('id'=>$row->callstatus), 'title');
					$row->priority = ($row->priority == 1)? "Urgent" :"Normal";
					// $row->type = $this->db_panel->fetch_value('property_types', array('id'=>$propertytype), 'title');
					// $brand = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'brand');
					// $row->brand = $this->db_panel->fetch_value('brands', array('id'=>$type), 'brandname');
					$client = $this->db_panel->fetch_row('clients', array('id'=>$row->clientid));
					$callstatus = $this->db_panel->fetch_row('call_status', array('id'=>$row->callstatus));
					$row->businessname = !empty($client)?$client->businessname:"Not Found";
					$row->address = $client->city.', '.$client->address.', '.$client->landmark;

					// $row->address = !empty($client)?$client->address:"Not Found";
					// $row->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
					// $row->work_status = !empty($status)?$status->name:"Not Found";
				}
			}
			// echo "<pre>"; print_r($data); die;
			$this->load->view('admin/admin_base', $data);
		}
	}
	
	function calls_report($filter = 'all'){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['calls']= $this->db_panel->fetch_rows('calls', array('deactivate!='=>'1', 'callstatus!='=>'6'), 'id desc');
			if(!empty($data['calls'])){
				foreach($data['calls'] as $row){
					$row->propertytype = $this->db_panel->fetch_value('property_types', array('id'=>$row->propertytypeid), 'title');
					$row->calltype = $this->db_panel->fetch_value('call_types', array('id'=>$row->calltypeid), 'title');
					$row->callsource = $this->db_panel->fetch_value('call_source', array('id'=>$row->callsource), 'title');
					$row->callterm = $this->db_panel->fetch_value('call_term', array('id'=>$row->term), 'title');
					$row->jobassign = $this->db_panel->fetch_value('employees', array('id'=>$row->job_assign), 'firstname');
					$row->callstatus = $this->db_panel->fetch_value('call_status', array('id'=>$row->callstatus), 'title');
					$row->priority = ($row->priority == 1)? "Urgent" :"Normal";
					// $row->type = $this->db_panel->fetch_value('property_types', array('id'=>$propertytype), 'title');
					// $brand = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'brand');
					// $row->brand = $this->db_panel->fetch_value('brands', array('id'=>$type), 'brandname');
					$client = $this->db_panel->fetch_row('clients', array('id'=>$row->clientid));
					$callstatus = $this->db_panel->fetch_row('call_status', array('id'=>$row->callstatus));
					$row->businessname = !empty($client)?$client->businessname:"Not Found";
					$row->address = $client->city.', '.$client->address.', '.$client->landmark;

					// $row->address = !empty($client)?$client->address:"Not Found";
					// $row->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
					// $row->work_status = !empty($status)?$status->name:"Not Found";
				}
			}
			// echo "<pre>"; print_r($data); die;
			$this->load->view('admin/admin_base', $data);
		}
	}
	
	function notice(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['removal_complain'] = $this->db_panel->fetch_rows('complains', array('complainremoval_request!='=>''));
			if(!empty($data['removal_complain'])){
				foreach($data['removal_complain'] as $row){
					$row->businessname = $this->db_panel->fetch_value('clients', array('id'=>$row->clientid), 'businessname');
				}
			}
			// echo "<pre>"; print_r($data['removal_complain']); die;
			$this->load->view('admin/admin_base', $data);
		}
	}
	function print_complain($id){
		$complain = $this->db->where('id', $id)->get('complains')->row_object();
		$client = $this->db_panel->fetch_row('clients', array('id'=>$complain->clientid));
		$complaintype = explode(",",$complain->complaintype); 
        // $db_complaintype= $this->db_panel->fetch_row('complain_type', array('id'=>$complain->clientid));
        $postfix = $complainlist = '';
        foreach($complaintype as $row){
            // if (in_array($row, $db_complaintype))
            $db_complaintype= $this->db_panel->fetch_value('complain_type', array('id'=>$row), 'name');
            $complainlist .= $postfix.$db_complaintype;
            $postfix = ', ';
            // $complainlist = ($db_complaintype->id == $row);
        }
        $complain->complainlist = $complainlist;
				// print_r($client); echo $complain->clientid; die;
					// $loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$client->loadsheddinggroup));
		$status = $this->db_panel->fetch_row('status', array('id'=>$complain->work_status));
		$complain->businessname = !empty($client)?$client->businessname:"Not Found";
		$complain->address = !empty($client)?$client->address:"Not Found";
		$complain->landmark = !empty($client)?$client->landmark:"Not Found";
		$complain->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
		// $complain->work_status = !empty($status)?$status->statusdesc:"Not Found";
		$data['property'] = $this->db_panel->fetch_row('property', array('id'=>$complain->propertyid));
		$data['property']->brand = $this->db_panel->fetch_value('brands',array('id'=>$data['property']->brand), 'brandname'); 
		$data['property']->type = $this->db_panel->fetch_value('ac_types',array('id'=>$data['property']->type), 'typename'); 
		$data['record'] = $complain;
		$this->load->view('admin/print/complain', $data);
	}
	
	function completed_complains(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/complains';
			$data['complains']= $this->db_panel->fetch_rows('complains', array('status'=>'4'), 'id desc');
			if(!empty($data['complains'])){
				foreach($data['complains'] as $row){
					$type = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'type');
					$row->type = $this->db_panel->fetch_value('ac_types', array('id'=>$type), 'typename');
					$brand = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'brand');
					$row->brand = $this->db_panel->fetch_value('brands', array('id'=>$type), 'brandname');
					$client = $this->db_panel->fetch_row('clients', array('id'=>$row->clientid));
					// $loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$client->loadsheddinggroup));
					$status = $this->db_panel->fetch_row('status', array('id'=>$row->status));
					$row->businessname = !empty($client)?$client->businessname:"Not Found";
					$row->address = !empty($client)?$client->address:"Not Found";
					$row->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
					$row->work_status = !empty($status)?$status->name:"Not Found";
				}
			}
			// echo "<pre>"; print_r($data); die;
			$this->load->view('admin/admin_base', $data);
		}
	}
	function deactivated_complains(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/deactivated-complains';
			$data['complains']= $this->db_panel->fetch_rows('complains', array('deactivate'=>'1'), 'id desc');
			if(!empty($data['complains'])){
				foreach($data['complains'] as $row){
					$type = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'type');
					$row->type = $this->db_panel->fetch_value('ac_types', array('id'=>$type), 'typename');
					$brand = $this->db_panel->fetch_value('property', array('id'=>$row->propertyid), 'brand');
					$row->brand = $this->db_panel->fetch_value('brands', array('id'=>$type), 'brandname');
					$client = $this->db_panel->fetch_row('clients', array('id'=>$row->clientid));
					// $loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$client->loadsheddinggroup));
					$status = $this->db_panel->fetch_row('status', array('id'=>$row->status));
					$row->businessname = !empty($client)?$client->businessname:"Not Found";
					$row->address = !empty($client)?$client->address:"Not Found";
					$row->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
					$row->work_status = !empty($status)?$status->name:"Not Found";
				}
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	
	function new_complain($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
				$post = $this->input->post();
				if(!empty($post['clientid']) && !empty($post['propertyid'])){
					$complaintype = $this->input->post('complaintype');
					$prefix = $complain_ids = '';
					foreach ($complaintype as $row)
					{
					    $complain_ids .= $prefix . $row;
					    $prefix = ',';
					}
					$usersession = $this->session->userdata('userdata');
					$reg_datetime = (!($this->input->post('reg_datetime')))? $this->input->post('reg_datetime'):date('Y-m-d H:i:s');
					$complain_data = array(
						'clientid' => $this->input->post('clientid'),
						'propertyid' => $this->input->post('propertyid'),
						'complaintype' => $complain_ids,
						'complaindetail' => $this->input->post('complaindetail'),
						'complainer' => $this->input->post('complainer'),
						'complainerpost' => $this->input->post('complainerpost'),
						'complainerphone' => $this->input->post('complainerphone'),
						'reg_by' => $usersession['id'],
						'reg_datetime' => $reg_datetime,
						'status' => '1',
					);
					if(trim($this->input->post('complainid')) != NULL){
			        	$complain_id = $this->input->post('complainid'); 
			        	$complain_data['updated_at'] = date('Y-m-d H:i:s');
			        	$this->db->where('id',$complain_id);
			        	$this->db->update('complains', $complain_data);
			        	$this->session->set_flashdata('message','Complain updated !!!');
			        	redirect('panel/complain/'.$complain_id);
			        }else{
			        	$complain_data['created_at'] = date('Y-m-d H:i:s');
			        	$this->db->insert('complains', $complain_data);
						$complain_id = $this->db->insert_id();
						$this->session->set_flashdata('message','Complain updated !!!');
						redirect('panel/complain/'.$complain_id);
						// die('here');
					}
				
				}else{
					$this->session->set_flashdata('message','Please select Client and enter Complain !!!');
				}
			} else{
				$data['page'] = $this->uri->segment(1).'/complain-new';
				$this->load->view('admin/admin_base', $data);
			}
		}
	}
	function deactivated_complain($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$data['page'] = $this->uri->segment(1).'/deactivated-complain';
			if(!empty($id)){
				$complain = $this->db->where('id', $id)->get('complains')->row_object();
				$client = $this->db_panel->fetch_row('clients', array('id'=>$complain->clientid));
				$status = $this->db_panel->fetch_row('status', array('id'=>$complain->work_status));
				$complain->businessname = !empty($client)?$client->businessname:"Not Found";
				$complain->address = !empty($client)?$client->address:"Not Found";
				$complain->landmark = !empty($client)?$client->landmark:"Not Found";
				$complain->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
				// $complain->work_status = !empty($status)?$status->statusdesc:"Not Found";
				$data['property'] = $this->db_panel->fetch_row('property', array('id'=>$complain->propertyid));
				$data['property']->type = $this->db_panel->fetch_value('ac_types',array('id'=>$data['property']->type), 'typename'); 
				$data['property']->brand = $this->db_panel->fetch_value('brands',array('id'=>$data['property']->brand), 'brandname'); 
				$data['record'] = $complain;
				$data['activity'] =  $this->db_panel->fetch_rows('complain_activity', array('complainid'=>$complain->id));
			}else{
				$data['page'] = $this->uri->segment(1).'/complain-new';
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	function complain($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
				echo "<pre>"; print_r($this->input->post()); die;
				if(!($this->input->post('clientid'))){
					$complain_data = array(
						'clientid' => $this->input->post('clientid'),
						'firstname' => $this->input->post('complainby'),
						'post' => $this->input->post('post'),
						'cphone' => $this->input->post('phone'),
						'cdescription' => $this->input->post('description'),
						'reg_datetime' => $this->input->post('reg_datetime'),
						'work_status' => $this->input->post('work_status'),
					);
					if(trim($this->input->post('complainid')) != NULL){
			        	$complain_id = $this->input->post('complainid'); 
			        	$complain_data['updated_at'] = date('Y-m-d H:i:s');
			        	$this->db->where('id',$complain_id);
			        	$this->db->update('complains', $complain_data);
			        }else{
			        	$complain_data['created_at'] = date('Y-m-d H:i:s');
			        	$this->db->insert('complains', $complain_data);
						$complain_id = $this->db->insert_id();
					}
					$count = 0;
					$ac_data = array();
					foreach($this->input->post('problem') as $key=>$row){
						if(!empty($row)){
							$count++;
							$ac_data[$key] = array();
							// array_push($ac_data[$key], $row);
						}else break;
					}
					if($count>0){
				        if(!empty($complain_id)){
							$ac_work_id = $this->input->post('ac_work_id');
							$brand = $this->input->post('brand');
							$modelname = $this->input->post('modelname');
							$room = $this->input->post('room');
							$quantity = $this->input->post('quantity');
							$capacity = $this->input->post('capacity');
							$problem = $this->input->post('problem');
							for($i=0; $i<$count; $i++){
								array_push($ac_data[$i], $ac_work_id[$i]);
								array_push($ac_data[$i], $brand[$i]);
								array_push($ac_data[$i], $modelname[$i]);
								array_push($ac_data[$i], $room[$i]);
								array_push($ac_data[$i], $quantity[$i]);
								array_push($ac_data[$i], $capacity[$i]);
								array_push($ac_data[$i], $problem[$i]);
							}
							echo "<pre>"; print_r($ac_data); echo "</pre>"; die;
							foreach($ac_data as $row){
								$ac_row = array(
									'complainid' => $complain_id,
									// 'id' =>$row[0],
									'brand' =>$row[1],
									'model' => $row[2],
									'room' => $row[3],
									'quantity' => $row[4],
									'capacity' => $row[5],
									'problem' => $row[6],
									'solved' => '0'
								);
								$dbw=$this->db_panel->fetch_row('ac_complain_works', array('id'=>$row[0]));
								if(!empty($dbw)){
						        	$this->db->where('id',$row[0]);
						        	$this->db->update('ac_complain_works', $ac_row);
								}else
									$this->db->insert('ac_complain_works',$ac_row);
							}
							if($this->input->post('exit') == 'exit') redirect('/');
							else {
								$sale_entry['complainid'] = $complain_id;
								$data['complain'] = $complain_data;
								$data['ac_work'] = $ac_data;
								$this->session->set_flashdata('success','Complain Details successfully Updated !!!');
							}
						}
					}else{
						$this->session->set_flashdata('error','Please enter Complain Details !!!');
					}
				
				}else{
					$this->session->set_flashdata('message','Please select Client and enter Complain !!!');
				}
			} 
			if(!empty($id) || $this->input->post('id')){
				$complain = $this->db->where('id', $id)->get('complains')->row_object();
				// foreach($complain as $row){
					$client = $this->db_panel->fetch_row('clients', array('id'=>$complain->clientid));
				// print_r($client); echo $complain->clientid; die;
					// $loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$client->loadsheddinggroup));
					$status = $this->db_panel->fetch_row('status', array('id'=>$complain->work_status));
					$complain->businessname = !empty($client)?$client->businessname:"Not Found";
					$complain->address = !empty($client)?$client->address:"Not Found";
					$complain->landmark = !empty($client)?$client->landmark:"Not Found";
					$complain->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
					// $complain->work_status = !empty($status)?$status->statusdesc:"Not Found";
					$data['property'] = $this->db_panel->fetch_row('property', array('id'=>$complain->propertyid));
					$data['property']->type = $this->db_panel->fetch_value('ac_types',array('id'=>$data['property']->type), 'typename'); 
					$data['record'] = $complain;
					// echo "<pre>"; print_r($data['record']); die;
				// }
			}else{
				$data['page'] = $this->uri->segment(1).'/complain-new';
			}
			// echo "<pre>"; print_r($this->input->post()); die;
			// if (!empty($id) || $this->input->post('id')) {
   //      		if($this->input->post()){
   //      			if($id == '') $id = $this->input->post('id');
   //      			$p_data['updated_at'] = date('Y-m-d H:i:s');
	  //       		$this->db->where('id',$id);
			//         $this->db->update('complains',$p_data);
	  //       		// $this->db->where('id', $id);
	  //       	}
	  //       	$complain = $this->db->where('id', $id)->get('complains')->result_object();
	  //       	foreach($complain as $row){
			// 		$client = $this->db_panel->fetch_row('clients', array('id'=>$row->clientid));
			// 		$loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$client->loadsheddinggroup));
			// 		$status = $this->db_panel->fetch_row('status', array('id'=>$row->work_status));
			// 		$row->businessname = !empty($client)?$client->businessname:"Not Found";
			// 		$row->address = !empty($client)?$client->address:"Not Found";
			// 		$row->landmark = !empty($client)?$client->landmark:"Not Found";
			// 		$row->loadshedding = !empty($client)?$loadshedding->groupname:"Not Found";
			// 		// $row->work_status = !empty($status)?$status->statusdesc:"Not Found";
			// 		$data['ac_complains'] = $this->db_panel->fetch_rows('ac_complain_works', array('complainid'=>$row->id));

			// 	}
	  //       	// echo "<pre>"; print_r($complain); 
	  //       	// echo "<pre>"; print_r($ac_complains); die;

   //      		$data['record'] = $complain;
			// }
			// else{
			// 	if($this->input->post()){
			// 		$complain_data['created_at'] =  date('Y-m-d H:i:s');
			// 		// print($p_data); echo 'pdata';
			// 		if ($this->db->insert('complains', $complain_data)) {
		 //            	$last_id = $this->db->insert_id();
		 //            	// $callid = get_code($this->input->post('producttypeid'), $last_id);
		            	
			//             // $up_data = array('callid'=>$callid);
			//             // $this->db->where('id',$last_id);
			//             // $this->db->update('complains',$up_data);
			//             $complains = $this->db->where('id', $last_id)->get('complains')->result_object();
			//             $data['record'] = $complains;
		            	
		 //            	$this->data['record'] = $complain_data;
			//             $this->data['message'] = 'Saved Successfully!!!';
			//             $this->session->set_flashdata('message','Updated successfully!!!');
			// 		}
			// 	}
			// }
			if($this->input->post('submit') == 'view')
				redirect('panel/complains');
			elseif($this->input->post('submit') == 'add')
				redirect('panel/complain');
			else
				$this->load->view('admin/admin_base', $data);
		}
	}
	function prospect($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post('customer')){
				$prospect_data = array(
					'reg_datetime' => $this->input->post('reg_datetime'),
					'referredBy' => $this->input->post('referredBy'),
					'met' => $this->input->post('met'),
					'interestIn' => $this->input->post('interestIn'),
					'businessname' => $this->input->post('businessname'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'landmark' => $this->input->post('landmark'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'note' => $this->input->post('note'),
				);
				if (!empty($id)) {
        			if($id == '') $id = $this->input->post('id');
        			$prospect_data['updated_at'] = date('Y-m-d H:i:s');
	        		$this->db->where('id',$id);
			        $this->db->update('prospects',$prospect_data);
	        		$this->db->where('id', $id);
		        	$prospect = $this->db->where('id', $id)->get('prospects')->result_object();
	        		$data['record'] = $prospect;
				}
				else{
					$prospect_data['created_at'] =  date('Y-m-d H:i:s');
					if ($this->db->insert('prospects', $prospect_data)) {
		            	$last_id = $this->db->insert_id();
			            $prospects = $this->db->where('id', $last_id)->get('prospects')->result_object();
			            $data['record'] = $prospects;
		            	
		            	$this->data['record'] = $prospect_data;
			            $this->data['message'] = 'Saved Successfully!!!';
			            $this->session->set_flashdata('message','Saved successfully!!!');
					}
				}
			}
			elseif($this->input->post('followup') && !empty($id)){
				$followup_data = array(
					'prospectId' => $this->input->post('prospectId'),
					'followedDate' => $this->input->post('followedDate'),
					'followMedium' => $this->input->post('followMedium'),
					'discussion' => $this->input->post('discussion'),
					'reminder' => $this->input->post('reminder'),
					'note' => $this->input->post('note'),
				);
				$followup_data['created_at'] =  date('Y-m-d H:i:s');
				if ($this->db->insert('follow_up', $followup_data)) {
	            	$last_id = $this->db->insert_id();
		            $follow_up = $this->db->where('id', $last_id)->get('follow_up')->result_object();
		            $data['followups'] = $follow_up;
	            	$this->data['followups'] = $follow_up;
		            $this->data['message'] = 'Saved Successfully!!!';
		            $this->session->set_flashdata('message','Saved successfully!!!');
				}
			}
			
			elseif(!empty($id)){
				$prospect = $this->db->where('id', $id)->get('prospects')->result_object();
	        	$data['record'] = $prospect;
	        	$followup = $this->db->where('prospectId', $id)->get('follow_up')->result_object();
	        	if(!empty($followup)) $data['followups'] = $followup;
	        	// echo "<pre>"; print_r($data); die;
			}
			$this->load->view('admin/admin_base', $data);
		}
	}
	function clients(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data['clients']= $this->db_panel->fetch_rows('clients', '', 'id desc');
			if(!empty($data['clients'])){
				foreach($data['clients'] as $row){
					// $client = $this->db_panel->fetch_row('clients', array('id'=>$row->clientid));
					// $loadshedding = $this->db_panel->fetch_row('loadshedding_group', array('id'=>$row->loadsheddinggroup));
					// $status = $this->db_panel->fetch_row('status', array('id'=>$row->work_status));
					// $row->clientname = !empty($client)?$client->businessname:"Not Found";
					// $row->address = !empty($client)?$client->address:"Not Found";
					// $row->loadshedding = !empty($loadshedding)?$loadshedding->groupname:"Not Assigned";
					// $row->work_status = !empty($status)?$status->statusdesc:"Not Found";
				}
			}
			// echo "<pre>"; print_r($data); die;
			$this->load->view('admin/admin_base', $data);
		}
	}
	function property(){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			if($this->input->post()){

				// if(!empty($this->input->post('clientid'))){
					$clientid = $this->input->post('clientid');
					$id = $this->input->post('id');
					$brand = $this->input->post('brand');
					$type = $this->input->post('type');
					$modelnumber = $this->input->post('modelnumber');
					$serialnumber = $this->input->post('serialnumber');
					$capacityinton = $this->input->post('capacityinton');
					$assignname = $this->input->post('assignname');
					$location = $this->input->post('location');
					$installdate = $this->input->post('installdate');
					$rundate = $this->input->post('rundate');
					$count = 0; $property_data = array();
					// echo "<pre>"; print_r($this->input->post()); die;
					foreach($capacityinton as $key=>$row){
						if(!empty($row)){
							$count++;
							$property_data[$key] = array();
							// array_push($ac_data[$key], $row);
						}else break;
					}
					if($count>0){
				        if(!empty($clientid)){
							for($i=0; $i<$count; $i++){
								$property_post= array(
									'brand' => $brand[$i],
									'type' => $type[$i],
									'modelnumber' => $modelnumber[$i],
									'serialnumber' => $serialnumber[$i],
									'capacityinton' => $capacityinton[$i],
									'assignname' => $assignname[$i],
									'location' => $location[$i],
									'installdate' => $installdate[$i],
									'rundate' => $rundate[$i],
								);
								if(!empty($id[$i])){
									$this->db->where('id',$id[$i]);
						        	$this->db->update('property', $property_post);
						        	// echo 'updated';
								}else{
									$property_post['clientid'] = $clientid;
									$this->db->insert('property', $property_post);
									// echo 'inserted';
								}
								// array_push($ac_data[$i], $ac_work_id[$i]);
								// array_push($ac_data[$i], $brand[$i]);
								// array_push($ac_data[$i], $modelname[$i]);
								// array_push($ac_data[$i], $room[$i]);
								// array_push($ac_data[$i], $quantity[$i]);
								// array_push($ac_data[$i], $capacity[$i]);
								// array_push($ac_data[$i], $problem[$i]);
							}
							// echo "<pre>"; print_r($ac_data); echo "</pre>"; 
							// foreach($ac_data as $row){
							// 	$ac_row = array(
							// 		'complainid' => $complain_id,
							// 		// 'id' =>$row[0],
							// 		'brand' =>$row[1],
							// 		'model' => $row[2],
							// 		'room' => $row[3],
							// 		'quantity' => $row[4],
							// 		'capacity' => $row[5],
							// 		'problem' => $row[6],
							// 		'solved' => '0'
							// 	);
							// 	$dbw=$this->db_panel->fetch_row('ac_complain_works', array('id'=>$row[0]));
							// 	if(!empty($dbw)){
						 //        	$this->db->where('id',$row[0]);
						 //        	$this->db->update('ac_complain_works', $ac_row);
							// 	}else
							// 		$this->db->insert('ac_complain_works',$ac_row);
							// }
							// if($this->input->post('exit') == 'exit') redirect('/');
							// else {
							// 	$sale_entry['complainid'] = $complain_id;
							// 	$data['complain'] = $complain_data;
							// 	$data['ac_work'] = $ac_data;
							// 	$this->session->set_flashdata('success','Complain Details successfully Updated !!!');
							// }
						}
					}else{
						$this->session->set_flashdata('error','Please enter Complain Details !!!');
					}
				
				// }else{
				// 	$this->session->set_flashdata('message','Please select Client and enter Complain !!!');
				// }
		       
			}
			// echo "<pre>"; print_r($this->input->post()); die;
			// empty post array and redirect to client
			redirect('panel/client/'.$clientid);
		}
	}
	function client($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
		        $p_data = array(
		            // 'callid' => $this->input->post('callid'),
					// 'reg_datetime' => $this->input->post('reg_datetime'),
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
	        	$data['record'] = $this->db->where('id', $id)->get('clients')->row_object();
	        	if(!empty($data['record'])){
		        	$data['properties'] = $this->db->where('clientid', $id)->get('property')->result_object();
		        	foreach($data['properties'] as $row){
		        		// $row->type = $this->db_panel->fetch_value('ac_types',array('id'=>$row->type), 'typename');
		        	}
	        	}else{
	        		$this->data['message'] = 'No record found!!!';
			        $this->session->set_flashdata('message','No record found!!!');
	        		redirect('panel/clients');
	        	}
	        	// print_r($data['properties']); die;
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
			if($this->input->post('submit') == 'view')
				redirect('panel/clients');
			elseif($this->input->post('submit') == 'add')
				redirect('panel/client');
			else
				$this->load->view('admin/admin_base', $data);
		}
	}
	function complain_old($id = ''){
		if ($this->session->userdata('userdata') == NULL) {
			$this->load->view('admin/login');
		}
		else{
			$data['page'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			if($this->input->post()){
		        $p_data = array(
		            // 'callid' => $this->input->post('callid'),
					'reg_datetime' => $this->input->post('reg_datetime'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'businessname' => $this->input->post('businessname'),
					'city' => $this->input->post('city'),
					'address' => $this->input->post('address'),
					'landmark' => $this->input->post('landmark'),
					'loadsheding_group' => $this->input->post('loadsheding_group'),
					'brand' => $this->input->post('brand'),
					'producttypeid' => $this->input->post('producttypeid'),
					'model_number' => $this->input->post('model_number'),
					'complain_type' => $this->input->post('complain_type'),
					'purchase_date' => $this->input->post('purchase_date'),
					'sales_dealer' => $this->input->post('sales_dealer'),
					'warranty_status' => '',
					'machine_serial_number' => $this->input->post('machine_serial_number'),
					'bill_number' => $this->input->post('bill_number'),
					'contact_number' => $this->input->post('contact_number'),
					'work_status' => $this->input->post('work_status'),
					'parts_description' => $this->input->post('parts_description')
				);
			}
			// echo "<pre>"; print_r($this->input->post()); die;
			if (!empty($id) || $this->input->post('id')) {
        		if($this->input->post()){
        			if($id == '') $id = $this->input->post('id');
        			$p_data['updated_at'] = date('Y-m-d H:i:s');
	        		$this->db->where('id',$id);
			        $this->db->update('complains',$p_data);
	        		$this->db->where('id', $id);
	        	}
	        	$complains = $this->db->where('id', $id)->get('complains')->result_object();
        		$data['record'] = $complains;
			}
			else{
				if($this->input->post()){
					$p_data['created_at'] =  date('Y-m-d H:i:s');
					// print($p_data); echo 'pdata';
					if ($this->db->insert('complains', $p_data)) {
		            	$last_id = $this->db->insert_id();
		            	$callid = get_code($this->input->post('producttypeid'), $last_id);
		            	
			            $up_data = array('callid'=>$callid);
			            $this->db->where('id',$last_id);
			            $this->db->update('complains',$up_data);
			            $complains = $this->db->where('id', $last_id)->get('complains')->result_object();
			            $data['record'] = $complains;
		            	
		            	$this->data['record'] = $p_data;
			            $this->data['message'] = 'Saved Successfully!!!';
			            $this->session->set_flashdata('message','Updated successfully!!!');
					}
				}
			}
			if($this->input->post('submit') == 'view')
				redirect('panel/complains');
			elseif($this->input->post('submit') == 'add')
				redirect('panel/complain');
			else
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