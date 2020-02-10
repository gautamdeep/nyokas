<?php
function set_username( $para = array(), $i = '' ) {
	$para['businessname'] = str_replace(' ', '', $para['businessname']);
	$para['firstname'] = str_replace(' ', '', $para['firstname']);
	$para['lastname'] = str_replace(' ', '', $para['lastname']);
	$user = substr($para['businessname'], 0,9);
	$userlength = strlen($user);
	if($userlength <= 9){
		$reqlength = 9-$userlength;
		$userfirst = substr($para['firstname'], 0,$reqlength);
		$user = $user.$userfirst;
		$userlength = strlen($user);
		if($userlength <=9 ){
			$reqlength = 9-$userlength;
			$userlast = substr($para['lastname'], 0,$reqlength);
			$user = $user.$userlast;
		}
	}
	return check_username($user);
	
	// else 
	// for($i = 1; $i < 10; $i++)
	// else check_dups_username($user, $i );
	// die;
	// print_r($para); die;
	// if($para['businessname'])
	// find space and remove in $para
	// $ret = str_replace(' ', '', $para);
	

	// $CI =& get_instance();
	// $CI->load->model('admin_panel');

	// // $this->load->modal('admin_panel');
	// $six_digit_random_number = mt_rand(100000, 999999);
	// //echo $category.'-'.$product;
	// // $category_name =  $admin_panel->get_category($category);
	// // $category_name = $this->admin_panel->get_category($category);
	// $category_name = $CI->admin_panel->get_category($category);
	// // echo $category_name['category_name'];
	// $cat = strtoupper(substr($category_name['category_name'],0,2));
	// $prod=preg_replace('/\s+/', '', $product);
	// $prod = strtoupper(substr($prod,0,2));
	// $product_code = $cat.'-'.$six_digit_random_number.'-'.$prod;
	// return $product_code;
	// echo '<br>';
	// echo $cat;echo '<br>';
	// echo "<pre>";
	// print_r($category_name);
	//print_r($category_name);
	// $string = substr($product,0,10).'...';
	// return $six_digit_random_number;
}
function check_username($user){
	$CI =& get_instance();
	$CI->load->model('Db_panel');
	$row = $CI->Db_panel->check_duplicate('users', array('username'=>$user));
	// print_r($row);
	if($row == 0) return $user;
	else { 
		// echo 'in else';
		for($i = 1; $i<99; $i++){
			$row = $CI->Db_panel->check_duplicate('users', array('username'=>$user.$i));
			if($row == 0) return $user.$i;
			// check_username($user);
		}
		// die('username duplicate');
	}
}
function set_password($user){
	$user = substr(strtolower($user), 0,3);
	$six_digit_random_number = mt_rand(100101, 999999);
	
	return array($user.$six_digit_random_number, md5($user.$six_digit_random_number));
}
function get_cartid($table){
	$CI =& get_instance();
	$CI->load->model('Db_panel');
	$last_id = $CI->Db_panel->fetch_last_row($table);
	if(empty($last_id)){ $last_id = '1'; } 
	$six_digit_random_number = mt_rand(100000, 999999);
	return $last_id.$six_digit_random_number;
}
function get_rows($table, $filter = array()){
	$CI =& get_instance();
	$CI->load->model('Db_panel');
	$rows = $CI->Db_panel->fetch_rows($table, $filter);
	return $rows;
}
function get_row($table, $filter = array()){
	$CI =& get_instance();
	$CI->load->model('Db_panel');
	$row = $CI->Db_panel->fetch_row($table, $filter);
	return $row;
}
// function get_status(){
// 	$CI =& get_instance();
// 	$CI->load->model('Db_panel');
// 	$rows = $CI->Db_panel->fetch_rows('status', $filter);
// 	return $rows;
// }
if (!function_exists('buildCountryDropdown'))
{
    function buildCountryDropdown($name='',$value='')
    {
        $country=array(
			"PH"=>"Philippines",
			"GB"=>"United Kingdom",
			"US"=>"United States",			
			"AF"=>"Afghanistan",
			"AL"=>"Albania",
			"DZ"=>"Algeria",
			"AD"=>"Andorra",
			"AO"=>"Angola",
			"AI"=>"Anguilla",
			"AQ"=>"Antarctica",
			"AG"=>"Antigua and Barbuda",
			"AR"=>"Argentina",
			"AM"=>"Armenia",
			"AW"=>"Aruba",
			"AU"=>"Australia",
			"AT"=>"Austria",
			"AZ"=>"Azerbaijan",
			"BS"=>"Bahamas",
			"BH"=>"Bahrain",
			"BD"=>"Bangladesh",
			"BB"=>"Barbados",
			"BY"=>"Belarus",
			"BE"=>"Belgium",
			"BZ"=>"Belize",
			"BJ"=>"Benin",
			"BM"=>"Bermuda",
			"BT"=>"Bhutan",
			"BO"=>"Bolivia",
			"BA"=>"Bosnia and Herzegovina",
			"BW"=>"Botswana",
			"BR"=>"Brazil",
			"IO"=>"British Indian Ocean",
			"BN"=>"Brunei",
			"BG"=>"Bulgaria",
			"BF"=>"Burkina Faso",
			"BI"=>"Burundi",
			"KH"=>"Cambodia",
			"CM"=>"Cameroon",
			"CA"=>"Canada",
			"CV"=>"Cape Verde",
			"KY"=>"Cayman Islands",
			"CF"=>"Central African Republic",
			"TD"=>"Chad",
			"CL"=>"Chile",
			"CN"=>"China",
			"CX"=>"Christmas Island",
			"CC"=>"Cocos (Keeling) Islands",
			"CO"=>"Colombia",
			"KM"=>"Comoros",
			"CD"=>"Congo, Democratic Republic of the",
			"CG"=>"Congo, Republic of the",
			"CK"=>"Cook Islands",
			"CR"=>"Costa Rica",
			"HR"=>"Croatia",
			"CY"=>"Cyprus",
			"CZ"=>"Czech Republic",
			"DK"=>"Denmark",
			"DJ"=>"Djibouti",
			"DM"=>"Dominica",
			"DO"=>"Dominican Republic",
			"TL"=>"East Timor",
			"EC"=>"Ecuador",
			"EG"=>"Egypt",
			"SV"=>"El Salvador",
			"GQ"=>"Equatorial Guinea",
			"ER"=>"Eritrea",
			"EE"=>"Estonia",
			"ET"=>"Ethiopia",
			"FK"=>"Falkland Islands (Malvinas)",
			"FO"=>"Faroe Islands",
			"FJ"=>"Fiji",
			"FI"=>"Finland",
			"FR"=>"France",
			"GF"=>"French Guiana",
			"PF"=>"French Polynesia",
			"GA"=>"Gabon",
			"GM"=>"Gambia",
			"GE"=>"Georgia",
			"DE"=>"Germany",
			"GH"=>"Ghana",
			"GI"=>"Gibraltar",
			"GR"=>"Greece",
			"GL"=>"Greenland",
			"GD"=>"Grenada",
			"GP"=>"Guadeloupe",
			"GT"=>"Guatemala",
			"GN"=>"Guinea",
			"GW"=>"Guinea-Bissau",
			"GY"=>"Guyana",
			"HT"=>"Haiti",
			"HN"=>"Honduras",
			"HK"=>"Hong Kong",
			"HU"=>"Hungary",
			"IS"=>"Iceland",
			"IN"=>"India",
			"ID"=>"Indonesia",
			"IE"=>"Ireland",
			"IL"=>"Israel",
			"IT"=>"Italy",
			"CI"=>"Ivory Coast",
			"JM"=>"Jamaica",
			"JP"=>"Japan",
			"JO"=>"Jordan",
			"KZ"=>"Kazakhstan",
			"KE"=>"Kenya",
			"KI"=>"Kiribati",
			"KR"=>"Korea, South",
			"KW"=>"Kuwait",
			"KG"=>"Kyrgyzstan",
			"LA"=>"Laos",
			"LV"=>"Latvia",
			"LB"=>"Lebanon",
			"LS"=>"Lesotho",
			"LI"=>"Liechtenstein",
			"LT"=>"Lithuania",
			"LU"=>"Luxembourg",
			"MO"=>"Macau",
			"MK"=>"Macedonia, Republic of",
			"MG"=>"Madagascar",
			"MW"=>"Malawi",
			"MY"=>"Malaysia",
			"MV"=>"Maldives",
			"ML"=>"Mali",
			"MT"=>"Malta",
			"MH"=>"Marshall Islands",
			"MQ"=>"Martinique",
			"MR"=>"Mauritania",
			"MU"=>"Mauritius",
			"YT"=>"Mayotte",
			"MX"=>"Mexico",
			"FM"=>"Micronesia",
			"MD"=>"Moldova",
			"MC"=>"Monaco",
			"MN"=>"Mongolia",
			"ME"=>"Montenegro",
			"MS"=>"Montserrat",
			"MA"=>"Morocco",
			"MZ"=>"Mozambique",
			"NA"=>"Namibia",
			"NR"=>"Nauru",
			"NP"=>"Nepal",
			"NL"=>"Netherlands",
			"AN"=>"Netherlands Antilles",
			"NC"=>"New Caledonia",
			"NZ"=>"New Zealand",
			"NI"=>"Nicaragua",
			"NE"=>"Niger",
			"NG"=>"Nigeria",
			"NU"=>"Niue",
			"NF"=>"Norfolk Island",
			"NO"=>"Norway",
			"OM"=>"Oman",
			"PK"=>"Pakistan",
			"PS"=>"Palestinian Territory",
			"PA"=>"Panama",
			"PG"=>"Papua New Guinea",
			"PY"=>"Paraguay",
			"PE"=>"Peru",
			"PN"=>"Pitcairn Island",
			"PL"=>"Poland",
			"PT"=>"Portugal",
			"QA"=>"Qatar",
			"RE"=>"R&eacute;union",
			"RO"=>"Romania",
			"RU"=>"Russia",
			"RW"=>"Rwanda",
			"SH"=>"Saint Helena",
			"KN"=>"Saint Kitts and Nevis",
			"LC"=>"Saint Lucia",
			"PM"=>"Saint Pierre and Miquelon",
			"VC"=>"Saint Vincent and the Grenadines",
			"WS"=>"Samoa",
			"SM"=>"San Marino",
			"ST"=>"S&atilde;o Tome and Principe",
			"SA"=>"Saudi Arabia",
			"SN"=>"Senegal",
			"RS"=>"Serbia",
			"CS"=>"Serbia and Montenegro",
			"SC"=>"Seychelles",
			"SL"=>"Sierra Leon",
			"SG"=>"Singapore",
			"SK"=>"Slovakia",
			"SI"=>"Slovenia",
			"SB"=>"Solomon Islands",
			"SO"=>"Somalia",
			"ZA"=>"South Africa",
			"GS"=>"South Georgia and the South Sandwich Islands",
			"ES"=>"Spain",
			"LK"=>"Sri Lanka",
			"SR"=>"Suriname",
			"SJ"=>"Svalbard and Jan Mayen",
			"SZ"=>"Swaziland",
			"SE"=>"Sweden",
			"CH"=>"Switzerland",
			"TW"=>"Taiwan",
			"TJ"=>"Tajikistan",
			"TZ"=>"Tanzania",
			"TH"=>"Thailand",
			"TG"=>"Togo",
			"TK"=>"Tokelau",
			"TO"=>"Tonga",
			"TT"=>"Trinidad and Tobago",
			"TN"=>"Tunisia",
			"TR"=>"Turkey",
			"TM"=>"Turkmenistan",
			"TC"=>"Turks and Caicos Islands",
			"TV"=>"Tuvalu",
			"UG"=>"Uganda",
			"UA"=>"Ukraine",
			"AE"=>"United Arab Emirates",
			"UM"=>"United States Minor Outlying Islands",
			"UY"=>"Uruguay",
			"UZ"=>"Uzbekistan",
			"VU"=>"Vanuatu",
			"VA"=>"Vatican City",
			"VE"=>"Venezuela",
			"VN"=>"Vietnam",
			"VG"=>"Virgin Islands, British",
			"WF"=>"Wallis and Futuna",
			"EH"=>"Western Sahara",
			"YE"=>"Yemen",
			"ZM"=>"Zambia",
			"ZW"=>"Zimbabwe");
			$class = 'class="form-control" id="country"';
		return form_dropdown($name, $country, 'GB', $class);
    }
}
