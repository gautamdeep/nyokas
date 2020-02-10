<?php
class Db_panel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function check_login($username, $password){
		$query = $this->db->get_where( 'customers',array('email' => $username,'password' => md5($password)) ); 
		return $query->row();
	}
	function check_duplicate($table,$data){
		$query = $this->db->get_where($table,$data); 
		$q = $query->row_array();
		return !empty($q)? 1:0;
	}
	function check_admin_login($username, $password){
		$query = $this->db->get_where('users',array('username' => $username,'password' => $password,'verified' => '1')); 
		// echo "<pre>"; print_r($query->row_array()); die;
		return $query->row_array();
	}
	function update_row_by_email($data,$email,$table_name){
		$this->db->where('email',$email);
		if($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}

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

	function delete_row($table_name,$id){
		$data = $this->fetch_row($table_name,  array('id'=>$id));
		if( file_exists(ROOTDIR.'/uploads/'.$table_name.'/'.$data->image) ) {
            unlink(ROOTDIR.'/uploads/'.$table_name.'/'.$data->image);
        }
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

	function fetch_rows($table_name, $where = array(), $order_by = '', $limit_from = '', $limit_to = '') { 
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
	
	function fetch_row($table_name,  $where = ''){
		$query = $this->db->get_where($table_name,$where);
		// echo $this->db->last_query();die;
		error_reporting(0);
		return $query->row();
		// return $query->row_array();
	}

	function fetch_last_row($table_name){
		$query = $this->db->select('id')->order_by('id','desc')->limit(1)->get($table_name)->row('id');
		return $query;
	}

	function fetch_value($table_name,  $where, $column) {
		$this->db->select($column);
		$this->db->from($table_name);
		$this->db->where($where);
		// print_r($this->db->get()->row($column)); die;
		return $this->db->get()->row($column);
	}
	function count_records($table_name, $where){
		$this->db->select('id')->from($table_name)->where($where); 
		$rec = $this->db->get(); 
		return $rec->num_rows();
	}
	function fetch_row_by_url($url){
		$query = $this->db->select('table_name, table_id')->where('url', $url)->from('page_url')->get();
        if ($query->num_rows() == 0) {
            return false;
        }
        $result = $query->row_array();

        $table_name = $result['table_name'];
        $table_id = $result['table_id'];

        $this->db->select()->where($table_name.'.id',
            $table_id)->from($table_name);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return false;
        }
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


	function delete($table_name, $where){
		if($this->db->delete($table_name, $where)){
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
		// var_dump($data);
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
	function update_row($table_name,$id,$data){
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
