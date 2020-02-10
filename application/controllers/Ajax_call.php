<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_call extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('db_panel');
	}
	// function search_client(){
	// 	$data['clients'] = $this->db_panel->fetch_rows('clients');
	// 	$data['complainid'] = $this->input->get('complainid');
	// 	echo $this->load->view('admin/ajax-complain/search-client',$data, TRUE);
	// }
	function search_client_list(){
		$data['clients'] = $this->db_panel->fetch_rows('clients');
		echo $this->load->view('admin/ajax-call/search-client-list',$data, TRUE);
	}
	function populate_client_info(){
		$data['clientinfo']= $this->input->get();
		// print_r($data['clientinfo']);
		echo $this->load->view('admin/ajax-call/populate-client-info',$data, TRUE);
	}
	function load_call_info_n_activity(){
		$this->load->view('admin/ajax-call/load-call-info-n-activity',TRUE);
	}
	function get_complainproperty(){
		$data['propertyid'] = $this->input->post('property_id');
		$data['complainid'] = $this->input->post('complain_id');
		$data['property'] = $this->db_panel->fetch_row('property', array('id'=> $data['propertyid']));
		$data['property']->brand = $this->db_panel->fetch_value('brands', array('id'=>$data['property']->brand), 'brandname' );
		// $data['properties'] = $this->db_panel->fetch_rows('property', array('clientid'=>$clientid));
		// foreach($data['properties'] as $row){
		// 	$row->brand = $this->db_panel->fetch_value('brands', array('id'=>$row->brand), 'brandname');
		// 	$row->type = $this->db_panel->fetch_value('ac_types', array('id'=>$row->type), 'typename');
		// }
		$data['complain'] = $this->db_panel->fetch_row('complains', array('id'=> $data['complainid']));
		// if($this->input->post()){
		// 	print_r($this->input->post());
		// }
		echo $this->load->view('admin/ajax-complain/get-complainproperty',$data, TRUE);
	}
	function populate_client_property_for_change(){
		$clientid = $this->input->get('clientid');
		$data['complainid'] = $this->input->get('complainid');
		$data['property'] = $this->db_panel->fetch_rows('property', array('clientid'=>$clientid));
		foreach($data['property'] as $row){
			$row->brand = $this->db_panel->fetch_value('brands', array('id'=>$row->brand), 'brandname');
			$row->type = $this->db_panel->fetch_value('ac_types', array('id'=>$row->type), 'typename');
		}
		// $data['complainid'] = $this->input->get('complainid');
		echo $this->load->view('admin/ajax-complain/client-property-for-change',$data, TRUE);
	}
	function update_complain_property(){
		$complainid = $this->input->get('complainid');
		$propertyid = $this->input->get('propertyid');
		$this->db->where('id', $complainid);
		if($this->db->update('complains', array('propertyid'=> $propertyid))){
			$return = array('status' => 200, 'message' => "Property Updated" );
		}else $return = array('status' => 400, 'message' => "Property Update Failed");
		echo json_encode($return);
	}
	function callactivity_form(){
		$data['table'] = 'workactivity-form';
		$data['callid'] = $this->input->post('call_id');
		$data['activity'] = $this->db_panel->fetch_rows('call_activity', array('callid'=> $data['callid']));
		// print_r($data['activity']);
		// if($this->input->post()){
		// 	print_r($this->input->post());
			
		// }
		echo $this->load->view('admin/ajax-call/callactivity-form',$data, TRUE);
	}
	function call_history(){
		$is_date_search = $this->input->post('is_date_search');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$this->db->where('reg_datetime >=', $start_date);
		$this->db->where('reg_datetime <=', $end_date);
		$calls = $this->db->get('calls')->result();
		
		$returncalls = array();
		foreach($calls as $row){
			$sub_array = array();
			$client = $this->db->where('id', $row->clientid)->get('clients')->row_object();
			$sub_array[] = strtoupper($client->businessname).'<br>'.$client->address;
			$propertytype = $this->db_panel->fetch_value('property_types', array('id'=>$row->propertytypeid), 'title');
			$calltype = $this->db_panel->fetch_value('call_types', array('id'=>$row->calltypeid), 'title');
			$callsource = $this->db_panel->fetch_value('call_source', array('id'=>$row->callsource), 'title');
			$callterm = $this->db_panel->fetch_value('call_term', array('id'=>$row->term), 'title');
			$sub_array[] = 'Call on:'.$propertytype.'<br>Call for: '.$calltype.'<br>Source: '.$callsource.'<br>Term: '.$callterm;
			$date1 = strtotime($row->reg_datetime);
			$date2 = strtotime(date('Y-m-d'));
            $secs = $date2 - $date1; 
            $days = round($secs/86400);
            $days.= ($days=='0')?'Today':($days=='1')? $days.' day ago':$days.' days ago';
			$sub_array[] = $row->regby_name.'<br><strong>'.$row->regby_phone.'</strong><br>Reg Date: '.$row->reg_datetime.'<br>'.$days;
			$note = (!empty($row->internalnote))? '# '.$row->internalnote:"";
			$sub_array[] = $row->calldetail.'<br>'.$note;
			$jobassign = $this->db_panel->fetch_value('employees', array('id'=>$row->job_assign), 'firstname');
			$sub_array[] = $jobassign;
			$callstatus = $this->db_panel->fetch_value('call_status', array('id'=>$row->callstatus), 'title');
			$sub_array[] = $callstatus;

			$returncalls[] = $sub_array;
		}
		// print_r($returncalls);
		echo json_encode($returncalls);
		// $calls = $this->db->get('calls');
	}
	function fetch_test(){
		$columns = array(
	    array(  "Tiger Nixon","System Architect","Edinburgh","5421","2011/04/25","$320,800" ),
	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    array( "Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    // array( 'db' => 'position',   'dt' => 2 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    
		);
	 
		// SQL server connection information
		$sql_details = array(
		    'user' => '',
		    'pass' => '',
		    'db'   => '',
		    'host' => ''
		);
	 
		echo json_encode($columns);
	}
	function fetch_test2(){
		$columns = array(
	    array(  "12Tiger Nixon","System Architect","Edinburgh","5421","2011/04/25","$320,800" ),
	    array( "12Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    array( "34Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    array( "465Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    array( "768Garrett Winters","Accountant","Tokyo","8422","2011/07/25","$170,750" ),
	    // array( 'db' => 'position',   'dt' => 2 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    // array( 'db' => 'office',     'dt' => 3 ),
	    
		);
	 
		// SQL server connection information
		$sql_details = array(
		    'user' => '',
		    'pass' => '',
		    'db'   => '',
		    'host' => ''
		);
	 
		echo json_encode($columns);
	}
	
	function del_callactivity_row(){
		$act_id = $this->input->post('act_id');
		if($this->db_panel->delete('call_activity', array('id'=>$act_id))){
			$return = array('status' => 200, 'message' => "Call Deleted" );
		}else $return = array('status' => 400, 'message' => "Call Deletion Failed");
		echo json_encode($return);
	}
	function workactivity_form(){
		$data['table'] = 'workactivity-form';
		$data['callid'] = $this->input->post('call_id');
		$data['records'] = $this->db_panel->fetch_rows('call_activity', array('callid'=> $data['callid']));
		// if($this->input->post()){
		// 	print_r($this->input->post());
			
		// }
		echo $this->load->view('admin/ajax/workactivity-form',$data, TRUE);
	}
	function post_callactivity_form(){
		$data['callid'] = $this->input->post('callid');
		$activityid = $this->input->post('activityid');
		$reportno = $this->input->post('reportno');
		$date = $this->input->post('date');
		$activity = $this->input->post('activity');
		$materialused = $this->input->post('materialused');
		$quantity = $this->input->post('quantity');
		$remarks = $this->input->post('remarks');
		// print_r($this->input->post('technician')); die;
		$count = 0; $activity_data = array();
		foreach($activity as $key=>$row){
			if(!empty($row)){
				$count++;
				$activity_data[$key] = array();
				// array_push($ac_data[$key], $row);
			}else break;
		}
		if($count>0){
			for($i=0; $i<$count; $i++){
				// if(!empty($technician)){
				// 	$prefix = $technician_ids = '';
				// 	foreach ($technician[$i] as $row)
				// 	{
				// 	    $technician_ids .= $prefix . $row;
				// 	    $prefix = ',';
				// 	}
				// }
				// array_push($activity_data[$i], $activityid[$i]);
				// array_push($activity_data[$i], $assumedproblem[$i]);
				// array_push($activity_data[$i], $steps[$i]);
				// array_push($activity_data[$i], $technician[$i]);
				// array_push($activity_data[$i], $materialused[$i]);
				// array_push($activity_data[$i], $remarks[$i]);
				$activity_post= array(
					'reportno' => $reportno[$i],
					'date' => $date[$i],
					'activity' => $activity[$i],
					'materialused' => $materialused[$i],
					'quantity' => $quantity[$i],
					'remarks' => $remarks[$i],
				);
				// if(!empty($technician)){
				// 	$activity_post['technician'] = $technician_ids;
				// }
				if(!empty($activityid[$i])){
					$this->db->where('id',$activityid[$i]);
		        	if($this->db->update('call_activity', $activity_post))
						$return = array('status' => 200, 'message' => "Call Updated" );
					else $return = array('status' => 400, 'message' => "Call Update Failed");
					// echo json_encode($return);
				}else{
					$activity_post['callid'] = $data['callid'];
					if($this->db->insert('call_activity', $activity_post))
						$return = array('status' => 200, 'message' => "Call Updated" );
					else $return = array('status' => 400, 'message' => "Call Update Failed");
				}
			}                                                                                                                                
			echo json_encode($return);
			// $data['records'] = $this->db_panel->fetch_rows('complain_activity', array('complainid'=> $data['complainid']));
			// print_r($activity_data);
		}
	}
	function post_workactivity_form(){
		$data['complainid'] = $this->input->post('complainid');
		$activityid = $this->input->post('activityid');
		$assumedproblem = $this->input->post('assumedproblem');
		$steps = $this->input->post('steps');
		$technician = $this->input->post('technician');

		
		$materialused = $this->input->post('materialused');
		$remarks = $this->input->post('remarks');
		// print_r($this->input->post('technician')); die;
		$count = 0; $activity_data = array();
		foreach($assumedproblem as $key=>$row){
			if(!empty($row)){
				$count++;
				$activity_data[$key] = array();
				// array_push($ac_data[$key], $row);
			}else break;
		}
		if($count>0){
			for($i=0; $i<$count; $i++){
				if(!empty($technician)){
					$prefix = $technician_ids = '';
					foreach ($technician[$i] as $row)
					{
					    $technician_ids .= $prefix . $row;
					    $prefix = ',';
					}
				}
				// array_push($activity_data[$i], $activityid[$i]);
				// array_push($activity_data[$i], $assumedproblem[$i]);
				// array_push($activity_data[$i], $steps[$i]);
				// array_push($activity_data[$i], $technician[$i]);
				// array_push($activity_data[$i], $materialused[$i]);
				// array_push($activity_data[$i], $remarks[$i]);
				$activity_post= array(
					'assumedproblem' => $assumedproblem[$i],
					'steps' => $steps[$i],
					'materialused' => $materialused[$i],
					'remarks' => $remarks[$i],
				);
				if(!empty($technician)){
					$activity_post['technician'] = $technician_ids;
				}
				if(!empty($activityid[$i])){
					$this->db->where('id',$activityid[$i]);
		        	if($this->db->update('complain_activity', $activity_post))
						$return = array('status' => 200, 'message' => "Complain Updated" );
					else $return = array('status' => 400, 'message' => "Complain Update Failed");
					// echo json_encode($return);
				}else{
					$activity_post['complainid'] = $data['complainid'];
					if($this->db->insert('complain_activity', $activity_post))
						$return = array('status' => 200, 'message' => "Complain Updated" );
					else $return = array('status' => 400, 'message' => "Complain Update Failed");
				}
			}                                                                                                                                
			echo json_encode($return);
			// $data['records'] = $this->db_panel->fetch_rows('complain_activity', array('complainid'=> $data['complainid']));
			// print_r($activity_data);
		}
	}
	function update_property_complain(){
		// print_r($this->input->post()); die;
		if($this->input->post()){

			$id = $this->input->post('complainid');
			$post_complain_ids = $this->input->post('complaintype');

			// echo $complain_ids['checkcomplain'][0];
			// echo "<pre>"; print_r($this->input->post());  die;
			$prefix = $complain_ids = '';
			foreach ($post_complain_ids as $row)
			{
			    $complain_ids .= $prefix . $row;
			    $prefix = ', ';
			}
			// print_r($complain_ids); die;
			$update_complain = array(
				// 'clientid' => $this->usersession['clientid'],
				// 'propertyid' => $this->input->post('propertyid'),
				'complaintype' => $complain_ids
				// 'complaindetail' => $this->input->post('complaindetail')
			);
			// print_r($post_complain); 
			$this->db->where('id', $id);
			if($this->db->update('complains', $update_complain)){
				// $complainid = $this->db->insert_id();
				$return = array('status' => 200, 'message' => "Complain Updated" );
			}else $return = array('status' => 400, 'message' => "Complain Update Failed");
			echo json_encode($return);
		}
	}
	function update_complain_info(){
		// print_r($this->input->post()); die;
		if($this->input->post()){
			$id = $this->input->post('complainid');

			$update_complain = array(
				'complainer' => $this->input->post('complainer'),
				'complainerpost' => $this->input->post('complainerpost'),
				'complainerphone' => $this->input->post('complainerphone'),
				'complaindetail' => $this->input->post('complaindetail'),
				'status' => $this->input->post('status'),
				'reg_datetime' => $this->input->post('reg_datetime'),
			);
			// print_r($post_complain); 
			$this->db->where('id', $id);
			if($this->db->update('complains', $update_complain)){
				// $complainid = $this->db->insert_id();
				$return = array('status' => 200, 'message' => "Complain Updated" );
			}else $return = array('status' => 400, 'message' => "Complain Update Failed");
			echo json_encode($return);
		}
	}
	function update_change_client(){
		// print_r($this->input->post());
		$clientid = $this->input->post('clientid');
		$id = $this->input->post('complainid');
		$this->db->where('id', $id);
		if($this->db->update('complains', array('clientid'=>$clientid))){
			// $complainid = $this->db->insert_id();
			$return = array('status' => 200, 'message' => "Complain Updated" );
		}else $return = array('status' => 400, 'message' => "Complain Update Failed");
		echo json_encode($return);
	}
	function delete_call(){
		$callid = $this->input->get('callid');
		$db_activity = $this->db_panel->count_records('call_activity', array('callid'=> $callid));
		if($db_activity<1){
			if($this->db_panel->delete('calls', array('id'=>$callid))){
				$return = array('status' => 200, 'message' => "Call Deleted" );
			}else $return = array('status' => 400, 'message' => "Call Deletion Failed");
		}else{
			$this->db->where('id',$callid);
			$this->db->update('calls', array('deactivate'=> 1));
			$return = array('status' => 201, 'message' => "Call Deactivated");
		}
		echo json_encode($return);

	}
	function delete_client(){
		$clientid = $this->input->get('clientid');
		$db_call = $this->db_panel->count_records('calls', array('clientid'=> $clientid));
		if($db_call<1){

			if($this->db->delete('clients', array('id' => $clientid))){
				$return = array('status' => 200, 'message' => "Client Deleted"); 
			}else $return = array('status' => 400, 'message' => "Client Deletion Failed");
		}else{
			$this->db->where('id',$clientid);
			$this->db->update('clients', array('deactivate'=> 1));
			$return = array('status' => 201, 'message' => "Client Deactivated");
		}
		echo json_encode($return);

	}
}
?>