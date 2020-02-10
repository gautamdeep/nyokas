<?php
class Admin_panel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function product_photos_upload($product=null){
		if($_FILES && $_FILES['product_image']['name'][0]!=''){

			$response['success']=false;

			$CI =& get_instance();
			$config = array(
				'upload_path'   => 'uploads/files/products/',
				'allowed_types' => 'jpg|jpeg|gif|png',
				'overwrite'     => 1,                       
				'max_size'     => '2048',                       
				'file_name'     => strtotime('now').'_'.'111',                       
				);

			$CI->load->library('upload', $config);
			foreach ($_FILES['product_image']['name'] as $key => $value) {
				$CI->upload->initialize($config);
				if(!$CI->upload->do_my_upload('product_image', $key)){
					$response['error']=$CI->upload->display_errors();
				}
				else{
					$my_upload['uploaded'][] = array('upload_data' => $CI->upload->data());
				}
			}
			if($my_upload['uploaded']){
				foreach ($my_upload['uploaded'] as $value) {
					$my_upload['uploaded_files'][]=$value['upload_data']['file_name'];
				}
							//merge two serialzed data
				if($product['pic'] or $product['pic']=='N;'){
					$old_pics = unserialize($product['pic']);
					$pics=array_merge($old_pics,$my_upload['uploaded_files']);							
				}else{
					$pics=$my_upload['uploaded_files'];														
				}						
							// show_pre($pics);
							// die;
				$serialze=serialize($pics);
				$response['success']=true;
				$response['data']=$serialze;
			}
			else
				echo "no";
			//show_pre($response);
			return $response;
		}
	}

	function check_login($username, $password){
		$query = $this->db->get_where('users',array('email' => $username,'password' => $password)); 
		return $query->row_array();
	}

	function check_login_admin($username, $password){
		$query = $this->db->get_where('users',array('email' => $username,'password' => $password,'user_type' => '')); 
		return $query->row_array();
	}

	function set_menu($selectedCategory, $task){
		$this->db->where('id', $selectedCategory);
		$data = array('active_menu'=>$task);
		if($this->db->update('product_categories', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function delete_row($id,$table_name){
		if($this->db->delete($table_name, array('id' => $id))){
			return true;
		} else {
			return false;
		}
	}
	function get_category($category) {
		$query = $this->db->get_where('product_categories',array('id' => $category)); 
		return $query->row_array();

	}
	// function fetch_rows($table_name) {
	// 	$query = $this->db->get($table_name);
	// 	return $query->result();
	// }
	function fetch_rows($table_name, $where = '', $order_by = '', $limit_from = '', $limit_to = '') { 
		//deep
		$this->db->select();
		$this->db->from($table_name);
		if($where != ''){
			$this->db->where($where);
		}
		// $this->db->where('status != 0');
		if (strlen($order_by) > 0) {
			$this->db->order_by($order_by);
		}
		if ($limit_from > 0 || $limit_to > 0) {
			$this->db->limit($limit_to, $limit_from);
		}
		$rs=$this->db->get();
		// echo $this->db->last_query();	
		return $rs->result();	
	}
	
	function fetch_row($id = '',$table_name,  $where = ''){
		if($id == ''){
			$query = $this->db->get_where($table_name,$where);
		}else {
			$query = $this->db->get_where($table_name,array('id' => $id));
		}
		// echo $this->db->last_query();die;
		return $query->row_array();
	}
	// function check_login($username,$password){
	// 	$query = $this->db->get_where('user', array('user_name' => $username,'password' => $password ));
	// 	if($query->num_rows()>0){
	// 		$rows = $query->row_array();
	// 		return true;
	// 	} else{
	// 		return false;
	// 	}
	// }
// listing all 
	function fetch_row_by_email($email) {
		$query = $this->db->get_where('users', array('email' => $email));
		return $query->row_array();
	}
	function list_user($table_name){		
			$query = $this->db->get($table_name);
			return $query->result();
		}

// listing end

// start delete
	// slider delete
	function delete($id,$table_name){
		if($this->db->delete($table_name, array('slider_id' => $id))){
			return true;
		} else {
			return false;
		}
	}
	// project delete
	function deleteProject($id,$table_name){
		if($this->db->delete($table_name, array('project_id' => $id))){
			return true;
		} else {
			return false;
		}
	}
	// news delete
	function deleteNews($id,$table_name){
		if($this->db->delete($table_name, array('news_id' => $id))){
			return true;
		} else {
			return false;
		}
	}
// delete end

// start insert and edit
	// for insert slider,news and project
	function insert($data,$table_name){
		if($this->db->insert($table_name,$data)){
			return true;
		}
		else {
			return false;
		}
	}
	// end insert

	// for slider edit
	function sliderEdit($id,$table_name){
		$query = $this->db->get_where($table_name,array('slider_id' => $id));
		// echo $this->db->last_query();die;
		return $query->row_array();
	}

	// for project edit
	function projectEdit($id,$table_name){
		$query = $this->db->get_where($table_name,array('project_id' => $id));
		// echo $this->db->last_query();die;
		return $query->row_array();
	}

	// for news edit
	function newsEdit($id,$table_name){
		$query = $this->db->get_where($table_name,array('news_id' => $id));
		// echo $this->db->last_query();die;
		return $query->row_array();
	}
// end insert and edit


	// slider update
	function update($data,$id,$table_name){
		$this->db->where('slider_id',$id);
		if($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}

	}
	function update_row($data,$id,$table_name){
		$this->db->where('id',$id);
		if($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}

	}

	function recover_email_password($email, $password){
		$this->db->where('email', $email);
		$data = array('password'=>md5($password));
		if($this->db->update('users', $data)) {
			return true;
		} else {
			return false;
		}
	}
	// project update
	function updateProject($data,$id,$table_name){
		$this->db->where('project_id',$id);
		if($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}
	}
	// news update
	function updateNews($data,$id,$table_name){
		$this->db->where('news_id',$id);
		if($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}
	}
	// for welcome panel
	function welcomePanel($table_name){
		$query = $this->db->get_where($table_name);
		// echo $this->db->last_query();die;
		return $query->row_array();
	}
	function updateWelcomePanel($data,$id,$table_name){
		$this->db->where('welcome_id',$id);
		if($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}
	}
	// end welcome panel

	// start about
	function about(){
		$query = $this->db->get_where('about');
		// echo $this->db->last_query();die;
		return $query->row_array();
	}
	function updateAbout($data,$oldPassword){
		$this->db->where('password',$oldPassword);
		if($this->db->update('user', $data)) {
			return true;
		} else {
			return false;
		}
	}
	// end about
	function getPassword(){
		$query = $this->db->get_where('user');
		// echo $this->db->last_query();die;
		return $query->row_array();
	}
	function updatePassword($data){
		// $this->db->where('slider_id',$id);
		if($this->db->update('user', $data)) {
			return true;
		} else {
			return false;
		}
	}
	function newsToggler($data,$id){
		if($data=="Inactive"){
			$this->db->set('status','1');
			$this->db->where('news_id',$id);
			if($this->db->update('news')) {
				return true;
			} else {
				return false;
			}
		}else{
			$this->db->set('status','0');
			$this->db->where('news_id',$id);
			if($this->db->update('news')) {
				return true;
			} else {
				return false;
			}
		}
	}
	function projectToggler($data,$id){
		if($data=="Inactive"){
			$this->db->set('status','1');
			$this->db->where('project_id',$id);
			if($this->db->update('project')) {
				return true;
			} else {
				return false;
			}
		}else{
			$this->db->set('status','0');
			$this->db->where('project_id',$id);
			if($this->db->update('project')) {
				return true;
			} else {
				return false;
			}
		}
	}
	function sliderToggler($data,$id){
		if($data=="Inactive"){
			$this->db->set('status','1');
			$this->db->where('slider_id',$id);
			if($this->db->update('slider')) {
				return true;
			} else {
				return false;
			}
		}else{
			$this->db->set('status','0');
			$this->db->where('slider_id',$id);
			if($this->db->update('slider')) {
				return true;
			} else {
				return false;
			}
		}
	}
}
?>
