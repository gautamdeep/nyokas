<?php
function menu(){

	$CI =& get_instance();
	$CI->load->model('db_panel');
	$content['categories']= $CI->db_panel->fetch_rows('categories', array('status' => 1) , 'id desc', '0', '4');
	$content['c_products']= $CI->db_panel->fetch_rows('d_products', array('status'=> 1), 'id desc', '0', '4');
	$content['d_products']= $CI->db_panel->fetch_rows('d_products', array('status'=> 1), 'id desc', '0', '4');
	foreach($content['d_products'] as $row){
		$url = $CI->db_panel->fetch_row('page_url', array('table_name'=>'d_products', 'table_id'=>$row->id));
		$row->url = isset($url['url']) && !empty($url['url']) ? $url['url']:'';
	}
	foreach($content['c_products'] as $row){
		$url = $CI->db_panel->fetch_row('page_url', array('table_name'=>'d_products', 'table_id'=>$row->id));
		$row->url = isset($url['url']) && !empty($url['url']) ? $url['url']:'';
	}
	foreach($content['categories'] as $row){
		$url = $CI->db_panel->fetch_row('page_url', array('table_name'=>'d_products', 'table_id'=>$row->id));
		$row->url = isset($url['url']) && !empty($url['url']) ? $url['url']:'';
	}
	return $content;

	// $cat = $CI->load->db_panel->fetch_row('categories', array('id'=>$getId ));
	// $menu = $CI->load->db_panel->fetch_rows('categories', array('status' => 1) , 'id desc', '0', '4');
	// if(!empty($menu)) return $content;
	// else return FALSE;
}

function fund_categories(){
	$ci=& get_instance();
	return $rows=$ci->load->model('fund_category/fund_category_m')->read_all_published(); 
}
function get_name($getId){
	$CI =& get_instance();
	$CI->load->model('db_panel');
	$cat = $CI->load->db_panel->fetch_row('categories', array('id'=>$getId ));
	// print_r($name);
	// var_dump($cat);
	if (empty($cat['category_name'])) {
		$a = "NONE";
	} else {
		$a = $cat['category_name'];
	}
	// echo $a;
	return $a;
}

function get_code($name, $id) {
	// $ci=& get_instance();
	$six_digit_random_number = mt_rand(100000, 999999);
	$name=preg_replace('/\s+/', '', $name);
	$n = strtoupper(substr($name,0,3));
	$promotional_code = $n.$six_digit_random_number.$id;
	return $promotional_code;
}
function set_session($par = array()){
	$CI =& get_instance();
	// echo "<pre>"; print_r($CI->session->all_userdata());
	$sec['member_data']=array(
		'checkouttype' => 'new',
		'id' => $par[0]->id,
		'customer_id' => $par[0]->customer_id,
		'firstname' => $par[0]->firstname,
		'lastname' => $par[0]->lastname,
		'email' => $par[0]->email,
		'contact' => $par[0]->contact,
		'address' => $par[0]->address,
		'logged_in' => TRUE
	);
	$CI->session->set_userdata($sec);
}
function get_promotional_code($name) {
	// $ci=& get_instance();
	$six_digit_random_number = mt_rand(100000, 999999);
	$name=preg_replace('/\s+/', '', $name);
	$n = strtoupper(substr($name,0,3));
	$promotional_code = $n.$six_digit_random_number;;
	return $promotional_code;
}

function get_product_code( $product, $category ) {
	$CI =& get_instance();
	$CI->load->model('admin_panel');

	// $this->load->modal('admin_panel');
	$six_digit_random_number = mt_rand(100000, 999999);
	//echo $category.'-'.$product;
	// $category_name =  $admin_panel->get_category($category);
	// $category_name = $this->admin_panel->get_category($category);
	$category_name = $CI->admin_panel->get_category($category);
	// echo $category_name['category_name'];
	$cat = strtoupper(substr($category_name['category_name'],0,2));
	$prod=preg_replace('/\s+/', '', $product);
	$prod = strtoupper(substr($prod,0,2));
	$product_code = $cat.'-'.$six_digit_random_number.'-'.$prod;
	return $product_code;
	// echo '<br>';
	// echo $cat;echo '<br>';
	// echo "<pre>";
	// print_r($category_name);
	//print_r($category_name);
	// $string = substr($product,0,10).'...';
	// return $six_digit_random_number;
}
function uploadFiles($folder, $id = NULL)
{
	echo ROOTDIR;
	$CI =& get_instance();
	if($folder == 'products') $up_path = 'product977';
	elseif($folder == 'categories') $up_path = 'category977';
	$config['upload_path'] = './uploads/'.$up_path;
  	$config['allowed_types'] = 'gif|jpg|png';
	// $config['max_width']  = '1024';
	// $config['max_height']  = '768';
	$CI->load->library('upload', $config);
	$CI->upload->initialize($config);
	if(!empty($id)){
		$CI->load->model('db_panel', 'get_row');
		$data = $CI->get_row->fetch_row($folder,  array('id'=>$id));
		//echo '/uploads/'.$up_path.'/'.$data['image'];
		if( file_exists(ROOTDIR.'/uploads/'.$up_path.'/'.$data->image) ) {
	        unlink(ROOTDIR.'/uploads/'.$up_path.'/'.$data->image);
	    }
	}

	if ( ! $CI->upload->do_upload())
	{
		$error = array('error' => $CI->upload->display_errors());
		log_message('error','Upload Error '.print_r($error,true));
	}
	else
	{
		$data = array('upload_data' => $CI->upload->data());
		log_message('error','Upload Data '.print_r($data,true));
		return $data;
	}
}
function seoUrl($string, $separator = '-')
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array ('&' => 'and');
    $string = strtolower(trim($string));
    $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
    $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}
