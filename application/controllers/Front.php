<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
class Front extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('mr_robot');
		$this->load->model('Db_panel');
		$this->load->library('form_validation');
		$this->load->library('cart');
	}

	public function index()
	{

		$content["template"] = 'home';
		$content['sliders']= $this->Db_panel->fetch_rows('sliders', array('status'=> 1));
		$content['products']= $this->Db_panel->fetch_rows('products', array('status'=> 1), '', 0, 2);
		// $content['categories']= $this->Db_panel->fetch_rows('categories', array('status'=> 1));
		foreach($content['products'] as $row){
			$r = $this->Db_panel->fetch_row('page_url', array('table_id'=> $row->id));
			$row->url = (!empty($r))? $r->url:'';
		}
		// foreach($content['categories'] as $row){
		// 	$r = $this->Db_panel->fetch_row('page_url', array('table_id'=> $row->id));
		// 	$row->url = $r->url;
		// }
		// echo "<pre>"; print_r($content['categories']); echo "</pre>"; die;
		$this->load->view('front/front-base', $content);
	}
	public function product_detail(){
		$content["template"] = 'product-detail';
		$url = $this->uri->segment(2); 
		$result = $this->Db_panel->fetch_row('page_url', array('url'=> $url));
		// print_r($result); die;
		$content['product'] = $this->Db_panel->fetch_row('products', array('id'=> $result->table_id));

		$this->load->view('front/front-base', $content);
	}
	public function order_sim($seg = NULL){
		// print_r($this->session->all_userdata());
		if($seg == 'select-amount'){
			if (empty($this->session->userdata['simOrder'])) {
				redirect('order-sim');
			}else{
				$content['template']='order-sim-select-amount';
			}
		}elseif($seg == 'bill-amount'){
			if (empty($this->session->userdata['simOrder'])) {
				redirect('order-sim');
			}else{
				$cartid = get_cartid('sim_orders'); //mr_robot_helper / send talbe name in cartid
				$cartamount = $this->input->post('amount')+0.99;
				$content['cartData'] = array(
					'amount' => $cartamount,
					'cartid' => $cartid
				); 
				$content['template']='order-sim-bill-amount';
			}
		}
		elseif($this->input->post()){
			$config = array(
	           array('field'   => 'first_name', 'label'   => 'Firstname', 'rules'   => 'required'),
	           array('field'   => 'last_name', 'label'   => 'Lastname', 'rules'   => 'required'),
	           array('field'   => 'email', 'label'   => 'Email', 'rules'   => 'required'),
	           array('field'   => 'house_no', 'label'   => 'House number', 'rules'   => 'required'),
	           array('field'   => 'road', 'label'   => 'Road', 'rules'   => 'required'),
	           array('field'   => 'address', 'label'   => 'Address', 'rules'   => 'required'),
	           array('field'   => 'town', 'label'   => 'Town', 'rules'   => 'required'),
	           array('field'   => 'post_code', 'label'   => 'Postcode', 'rules'   => 'required'),
	           array('field'   => 'country', 'label'   => 'Country', 'rules'   => 'required'),
	        );

	        $this->form_validation->set_rules($config);
	        $this->form_validation->set_message('required', '* Your %s is required');
	        $this->form_validation->set_message('email', '* Enter valid email');
			if ($this->form_validation->run() == FALSE){
				$content['template']=$this->uri->segment(1);
			}
			else{

				$sess['simOrder'] = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'house_no' => $this->input->post('house_no'),
					'road' => $this->input->post('road'),
					'address' => $this->input->post('address'),
					'town' => $this->input->post('town'),
					'post_code' => $this->input->post('post_code'),
					'country' => $this->input->post('country'),
				);
				$this->session->set_userdata($sess);
				// echo "<pre>"; print_r($this->session->userdata('simOrder'));echo "</pre>"; 
				redirect('order-sim/select-amount');
			}
		}else 
			$content['template']=$this->uri->segment(1);
		$this->load->view('front/front-base', $content);
	}

	public function top_up($url = NULL){
		$content['template']=$this->uri->segment(1);
		
		if($url == 'select-amount'){
			if (empty($this->session->userdata['customerSim'])) {
				redirect('top-up');
			}else{
				$content['cartid'] = get_cartid('worldpay_payments'); //mr_robot_helper
				$content['template']='top-up-select-amount';
			}
			
		}
		if($this->input->post()){
			$config = array(
	           	array(
	                 'field'   => 'mobile_number', 
	                 'label'   => 'Mobile number', 
	                 'rules'   => 'required|callback_mobile_check'
	            )
        	);
	        $this->form_validation->set_rules($config);
	        $this->form_validation->set_message('required', '* Your %s is required');
	        if ($this->form_validation->run() == FALSE){
			}
			else{
				redirect('top-up/select-amount');
			}
		}
		
		$this->load->view('front/front-base', $content);
	}
	
	public function mobile_check($mob){
		if(!is_numeric(trim($mob))){
			 // message("danger","Invalid cell no ,only numbers are allowed..");
			$this->form_validation->set_message('mobile_check', '* Enter valid %s');
			return FALSE;
		}
		if(!is_numeric($mob)){
			 // message("danger","Invalid cell no ,only numbers are allowed..");
			$this->form_validation->set_message('mobile_check', '* Enter valid %s');
			return FALSE;
		}else{
			$simData = $this->db_panel->fetch_row('sims', array('Username'=>$mob));
			if(empty($simData) || $simData['Username'] != $mob){
				$this->form_validation->set_message('mobile_check', '* This %s is not registered in our database');
				return FALSE;
			}elseif($simData['Username'] == $mob){
				$sess['customerSim'] = array(
					'AgentID' => $simData['AgentID'],
					'Agent' => $simData['Agent'],
					'ICCID' => $simData['ICCID'],
					'LiveBalance' => $simData['LiveBalance'],
					'UserId' => $simData['AgentID'],
					'Username' => $simData['Username'],
				);
				$this->session->set_userdata($sess);
				// echo "<pre>"; print_r($this->session->userdata('customerSim'));echo "</pre>"; 
			}
		}

	}
	
	public function success_return(){
		echo "<pre>"; print_r($_POST); echo "</pre>";

		$worldpay_response = $_POST;
		if($worldpay_response['transStatus'] == 'Y'){
			$insert_array = array(
				// 'ICCID' => $worldpay_response['MC_ICCID'],
				// 'Username' => $worldpay_response['MC_Username'],
				'payment_for' => $worldpay_response['MC_calltype'],
				'payment_id' => $worldpay_response['cartId'],
				'instId' => $worldpay_response['instId'],
				'cartId' => $worldpay_response['cartId'],
				'desc' => $worldpay_response['desc'],
				'cost' => $worldpay_response['cost'],
				'amount' => $worldpay_response['amount'],
				'amountString' => $worldpay_response['amountString'],
				'currency' => $worldpay_response['currency'],
				'authMode' => $worldpay_response['authMode'],
				'testMode' => $worldpay_response['testMode'],
				'name' => $worldpay_response['name'],
				'address1' => $worldpay_response['address1'],
				'address2' => $worldpay_response['address2'],
				'address3' => $worldpay_response['address3'],
				'town' => $worldpay_response['town'],
				'region' => $worldpay_response['region'],
				'postcode' => $worldpay_response['postcode'],
				'country' => $worldpay_response['country'],
				'countryString' => $worldpay_response['countryString'],
				'tel' => $worldpay_response['tel'],
				'fax' => $worldpay_response['fax'],
				'email' => $worldpay_response['email'],
				'compName' => $worldpay_response['compName'],
				'transId' => $worldpay_response['transId'],
				'transStatus' => $worldpay_response['transStatus'],
				'transTime' => $worldpay_response['transTime'],
				'authAmount' => $worldpay_response['authAmount'],
				'authCost' => $worldpay_response['authCost'],
				'authCurrency' => $worldpay_response['authCurrency'],
				'authAmountString' => $worldpay_response['authAmountString'],
				'rawAuthCode' => $worldpay_response['rawAuthCode'],
				'callbackPW' => $worldpay_response['callbackPW'],
				'cardType' => $worldpay_response['cardType'],
				'countryMatch' => $worldpay_response['countryMatch'],
				'AVS' => $worldpay_response['AVS'],
				'ipAddress' => $worldpay_response['ipAddress'],
				'charenc' => $worldpay_response['charenc']
			);
			$this->db->insert('worldpay_payments', $insert_array);
			
			if($worldpay_response['MC_calltype'] == 'top_up'){
				$input_xml = '<UserCustID>
				<SIM>
				<ICC-ID>'.$worldpay_response['MC_ICCID'].'</ICC-ID>
				</SIM>
				<Authentication>
				<Username>sundar</Username>
				<Password>gurung</Password>
				</Authentication>
				</UserCustID>';

				$url = "http://api1.globalsimsupport.com/webapi/version400.aspx";
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
				curl_setopt($ch, CURLOPT_POSTFIELDS, "$input_xml");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$data = curl_exec($ch);
				curl_close($ch);

				$cloud9Auth_reponse = json_decode(json_encode(simplexml_load_string($data)), true);

				if($cloud9Auth_reponse['@attributes']['status'] == 'success'){
					$topup_xml = '<AddPrePaidCredit>
					<Credit>
					<CustomerID>'.$cloud9Auth_reponse['sim']['customerid'].'</CustomerID>
					<Amount>'.$worldpay_response['amount'].'</Amount>
					<Narrative>A test credit</Narrative>
					<RequestId>'.$worldpay_response['cartId'].'</RequestId>
					</Credit>
					<Authentication>
					<Username>sundar</Username>
					<Password>gurung</Password>
					</Authentication>
					</AddPrePaidCredit>';

					// $url = "http://api1.globalsimsupport.com/webapi/version400.aspx";
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
					curl_setopt($ch, CURLOPT_POSTFIELDS, "$topup_xml");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$cloud9_topup_data = curl_exec($ch);
					curl_close($ch);

					$cloud9_topup_response = json_decode(json_encode(simplexml_load_string($cloud9_topup_data )), true);
					if($cloud9_topup_response['@attributes']['status'] == 'success'){
						$insert_topup = array(
							'topup_id' => $worldpay_response['cartId'],
							'ICCID' => $worldpay_response['MC_ICCID'],
							'Username' => $worldpay_response['MC_Username'],
							'status' => 1
						);
						$this->db->insert('top_up', $insert_topup);
					}
				}
			}else{
				$insert_order = array(
					'order_id' => $worldpay_response['cartId'],
					'first_name' => $worldpay_response['MC_first_name'],
					'last_name' => $worldpay_response['MC_last_name'],
					'email' => $worldpay_response['MC_email'],
					'address' => $worldpay_response['MC_address'],
					'sim_amount' => 1.99,
					'topup_amount' => $worldpay_response['amount']-1.99,
					'status' => 1
				);
				$this->db->insert('sim_orders', $insert_order);
			}
		}
		$this->load->view('front/templates/success-url', $worldpay_response);
	}
	public function page_load(){
		$content['template']=$this->uri->segment(1);
		$this->load->view('front/front-base', $content);
	}
	public function rates(){
		$content['template']=$this->uri->segment(1);
		$input_xml = '<?xml version="1.0"?>
			<ListCountryAndDescriptionsForSimLocation>
			<AgentId>1895</AgentId>
			<ActiveMsisdn>447440906643</ActiveMsisdn>
			<Authentication>
			<Username>sundar</Username>
			<Password>gurung</Password>
			</Authentication>
			</ListCountryAndDescriptionsForSimLocation>';
		$input_xml = '<?xml version="1.0"?>
			<ListCountryAndDescriptionsForOtherLocation>
			<AgentId>1895</AgentId>
			<Authentication>
			<Username>sundar</Username>
			<Password>gurung</Password>
			</Authentication>
			</ListCountryAndDescriptionsForOtherLocation>';

		$url = "http://api1.globalsimsupport.com/webapi/version400.aspx";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$input_xml");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);

		$cloud9Auth_reponse = json_decode(json_encode(simplexml_load_string($data)), true);
		echo "<pre>"; print_r($cloud9Auth_reponse); echo "</pre>"; 
		echo "<br>";
		// echo "<pre>"; var_dump($cloud9Auth_reponse); echo "<pre>"; 
		echo "<br>-----<br>";
		die;
		$input_xml = '<?xml version="1.0"?>
			<GetRateForInboundCall>
			<SimLocationDescription>Afghanistan Mobile [AFG]</SimLocationDescription>
			<ActiveMsisdn>447440922849</ActiveMsisdn>
			<Authentication>
			<Username>sundar</Username>
			<Password>gurung</Password>
			</Authentication>
			</GetRateForInboundCall>';
		$url = "http://api1.globalsimsupport.com/webapi/version400.aspx";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$input_xml");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);

		$cloud9Auth_reponse = json_decode(json_encode(simplexml_load_string($data)), true);
		echo "<pre>"; print_r($cloud9Auth_reponse); echo "</pre>"; 
		echo "<br>";
		echo "<pre>"; var_dump($cloud9Auth_reponse); echo "<pre>"; 
		die;
		// if($cloud9Auth_reponse['@attributes']['status'] == 'success'){
		$this->load->view('front/front-base', $content);
	}
	public function success_order(){
		echo "<pre>"; print_r($_POST); echo "</pre>";
	}
	public function datetest(){
		$date = "1460464605217";
		echo date('r', $date/1000); // output as RFC 2822 date - returns local time
		echo "<br>";
		echo date('Y-M-d-D h:i:s a', $date/1000); // output as RFC 2822 date - returns local time
die;
		echo gmdate('r', $date); // returns GMT/UTC time
		echo "<br>";
		// echo time();  // current Unix timestamp 
		// echo microtime(true); die;
		// echo gmdate("M d Y H:i:s", $date); die;
		// $epoch = 1344988800; 
		// 1403690460975
		// 1460464605217
		echo $epoch = 1460464605217/1000; 
		$dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
		echo $dt->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00 
		die;
		// echo gmdate("d M Y H:i:s",$date/1000);
		// echo "<br>";
		// echo $phpDate = date('d-m-Y H:i:s', $date/1000);
		// http://no2.php.net/strtotime 
		// http://php.net/manual/en/function.date.php
		// echo $d=strtotime("8923418563547814811");
		// print_r($d);
		// echo strtotime("now");
		// previous to PHP 5.1.0 you would compare with -1, instead of false
		$str = "8923418563547814811";
if (($timestamp = strtotime($str)) === false) {
    echo "The string ($str) is bogus";
} else {
    echo "$str == " . date('l dS \o\f F Y h:i:s A', $timestamp);
}
		// echo "Created date is " . date("Y-m-d h:i:sa", $d);
		// $myDateTime = DateTime::createFromFormat('Y-m-d', '8923418563547814811');
		// $newDateString = $myDateTime->format('d-m-Y');
		// $format="F j, Y, g:i a";
		// echo date_format(date_create("8923418563547814811"),$format);
	}

	public function htmlmail(){
        $config = Array(        
            'protocol' => 'sendmail',
            'smtp_host' => 'your domain SMTP host',
            'smtp_port' => 25,
            'smtp_user' => 'SMTP Username',
            'smtp_pass' => 'SMTP Password',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
    	$this->email->set_newline("\r\n");
    
        $this->email->from('mojoking.black@gmail.com', 'Deep Labs');
        $data = array(
             'userName'=> 'Deep kiran Gautam'
                 );
        $this->email->to('ifneeded.callme@gmail.com');  // replace it with receiver mail id
   		$this->email->subject('Mail testing'); // replace it with relevant subject 
    
        $body = $this->load->view('email_template/payment-bill.php','',TRUE);
    	$this->email->message($body);   
        $this->email->send();
    }
    public function textmail(){
    	$this->load->library('email');

		$this->email->from('office@natamobile.co.uk', 'NATA mobile');
		$this->email->to('mojoking.black@gmail.com'); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	

		$this->email->send();

		echo $this->email->print_debugger();
    }
       
	
}
