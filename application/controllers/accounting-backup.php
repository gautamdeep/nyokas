function ajax_db_summary1(){
		$is_date_search = $this->input->post('is_date_search');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$this->db->where('datenep >=', $start_date);
		$this->db->where('datenep <=', $end_date);
		$db = $this->db->get('daybook')->result();
		
		$returndb = array();
		$cat_ids_arr = array();
		$cat_amt_sum_arr = array();
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
			$sum = 0;
			$d= $this->db_panel->fetch_rows('daybook', array('categoryid='=>$cat_row));
			foreach($d as $r){
				$sum = $sum + $r->amount;	
			} 
			$subarray[] = $cat_row;
			$subarray[] = 'type';
			$subarray[] = $sum;
			$cat_amt_sum_arr[$cat_row] = $subarray;

		}
		// print_r($cat_amt_sum_arr);
		
	}