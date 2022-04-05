<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Admin Helper Functions... */
if (!function_exists('get_all_days_of_month')) {
	function get_all_days_of_month($month = '', $year = '') {
		if ($month == '' || $year == '') {
			$month = date('m');
			$year = date('Y');
		}
		for($d=1; $d<=31; $d++)
		{
		    $time=mktime(12, 0, 0, $month, $d, $year);          
		    if (date('m', $time)==$month)       
		        $list[]=date('Y-m-d', $time);
		}
		return $list;
	}
}


if (!function_exists('get_date_range')) {
	function get_date_range($start = '', $end = '') {
		$array = array(); 
		// Use strtotime function 
		$Variable1 = strtotime($start); 
		$Variable2 = strtotime($end); 
		// Use for loop to store dates into array 
		// 86400 sec = 24 hrs = 60*60*24 = 1 day 
		for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) {       
			$Store = date('Y-m-d', $currentDate); 
			$array[] = $Store; 
		}
		// Display the dates in array format 
		return $array;
	}
}


if (!function_exists('get_sidebar_details')) {
	function get_sidebar_details() {
		$CI = get_instance();
		// Mod Common for Menus... 
		$CI->load->model('mod_common');
		$sidebar_actions = $CI->mod_common->get_formated_list_of_menus();		
		return $sidebar_actions;
	}
}

if (!function_exists('verify_login')) {
	function verify_login()
    {
        $ci =& get_instance();
        $logged_in = $ci->session->userdata('username');
        if (!$logged_in) {
			$ci->session->set_flashdata('err_message', 'Login is required to access this section ');
            redirect(SURL. 'login/');
        }
    }
}

/* END Admin Helper Function */
if (!function_exists('compareByName')) {
	function compareByName($a, $b)
	{
		return strcmp($a, $b);
	}
}

if (!function_exists('sanitizeString')) {
	function sanitizeString($value = '')
	{
		$value = trim($value);
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		$value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
		$value = strip_tags($value);
		//$value = mysqli_real_escape_string($value);
		$value = htmlspecialchars($value);
		return $value;
	}
}
if (!function_exists('slugify')) {
	function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		// trim
		$text = trim($text, '-');
		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);
		// lowercase
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text;
	}
}

function array2csv($array)
{
	if (count($array) == 0) {
		return null;
	}
	ob_start();
	$df = fopen("php://output", 'w');
	fputcsv($df, array_keys((array) reset($array)));
	foreach ($array as $key => $row) { 
		fputcsv($df, (array) $row);
	}
	fclose($df);
	return ob_get_clean();
}

if (!function_exists('convert_digits')) {
	function convert_digits($data)
	{
		$CI = &get_instance();
		$lenth = strlen(substr(strrchr($data, "."), 1));
		if ($lenth == 6) {
			$new_data = $data . '0';
		} else {
			$new_data = $data;
		}
		return $new_data;
	}
} //end convert_digits

if (!function_exists('num')) {
	function num($data)
	{
		$data = (float) $data;
		return number_format($data, 8, '.', '');
	}
} //end num

if (!function_exists('number_format_short')) {
	function number_format_short($n)
	{
		if ($n > 0 && $n < 1000) {
			// 1 - 999
			$n_format = number_format($n, 2, '.', '');
			$suffix   = '';
		} else if ($n >= 1000 && $n < 1000000) {
			// 1k-999k
			$n_format = number_format($n / 1000, 2, '.', '');
			$suffix   = 'K+';
		} else if ($n >= 1000000 && $n < 1000000000) {
			// 1m-999m
			$n_format = number_format($n / 1000000, 2, '.', '');
			$suffix   = 'M+';
		} else if ($n >= 1000000000 && $n < 1000000000000) {
			// 1b-999b
			$n_format = number_format($n / 1000000000, 2, '.', '');
			$suffix   = 'B+';
		} else if ($n >= 1000000000000) {
			// 1t+
			$n_format = number_format($n / 1000000000000, 2, '.', '');
			$suffix   = 'T+';
		} else if ($n == 0) {
			$n_format = number_format($n, 2, '.', '');
			$suffix   = '';
		}
		$return  = !empty($n_format . $suffix) ? $n_format . $suffix : 0;
		return $return;
	}
}

if (!function_exists('show_error_404()')) {
	function show_error_404()
	{
		redirect(base_url('not_found'));
	}
}

if (!function_exists('time_elapsed_string')) {
	function time_elapsed_string($datetime, $timezone, $full = false)
	{
		$CI = &get_instance();
		$datetime2 = date("Y-m-d g:i:s A");
		$timezone = $timezone;
		$date = date_create($datetime2);
		date_timezone_set($date, timezone_open($timezone));
		$now1 = date_format($date, 'Y-m-d g:i:s A');
		$now = new DateTime($now1);
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;
		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}
		if (!$full) {
			$string = array_slice($string, 0, 1);
		}

		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
{
	$output = NULL;
	if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
		$ip = $_SERVER["REMOTE_ADDR"];
		if ($deep_detect) {
			if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	}
	$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	$continents = array(
		"AF" => "Africa",
		"AN" => "Antarctica",
		"AS" => "Asia",
		"EU" => "Europe",
		"OC" => "Australia (Oceania)",
		"NA" => "North America",
		"SA" => "South America"
	);
	if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
		$ipdat = @json_decode(file_get_contents("https://www.geoplugin.net/json.gp?ip=" . $ip));
		if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
			switch ($purpose) {
				case "location":
					$output = array(
						"city"           => @$ipdat->geoplugin_city,
						"state"          => @$ipdat->geoplugin_regionName,
						"country"        => @$ipdat->geoplugin_countryName,
						"country_code"   => @$ipdat->geoplugin_countryCode,
						"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
						"continent_code" => @$ipdat->geoplugin_continentCode
					);
					break;
				case "address":
					$address = array($ipdat->geoplugin_countryName);
					if (@strlen($ipdat->geoplugin_regionName) >= 1)
						$address[] = $ipdat->geoplugin_regionName;
					if (@strlen($ipdat->geoplugin_city) >= 1)
						$address[] = $ipdat->geoplugin_city;
					$output = implode(", ", array_reverse($address));
					break;
				case "city":
					$output = @$ipdat->geoplugin_city;
					break;
				case "state":
					$output = @$ipdat->geoplugin_regionName;
					break;
				case "region":
					$output = @$ipdat->geoplugin_regionName;
					break;
				case "country":
					$output = @$ipdat->geoplugin_countryName;
					break;
				case "countrycode":
					$output = @$ipdat->geoplugin_countryCode;
					break;
			}
		}
	}
	return $output;
}

//random number generator
function get_random_value(){
	
	$randstr = '';
	$length = 8;
    srand((double) microtime(TRUE) * 1000000);
    //our array add all letters and numbers if you wish
    $chars = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p',
        'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5',
        '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 
        'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

    for($rand = 0; $rand < $length; $rand++){

        $random = rand(0, count($chars) - 1);
        $randstr .= $chars[$random];
    }

    return $randstr;
	
}//end random number generator


if (!function_exists('download_clients_campaign_list_report')){

	function download_clients_campaign_list_report($result, $delim = ',', $newline = "\n" ,$list_fields){
		
		$out = '';
		
		foreach ($list_fields as $name){
			
			$out .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $name).$enclosure.$delim;
		}

		$out = substr($out, 0, -strlen($delim)).$newline;

		// Next blast through the result array and build out the rows
		foreach($result as $row){
			
			$line = array();
			
			foreach ($row as $item){
				
				$item_new =  remove_slaches(str_replace(',','',$item));
				$item_new =  remove_slaches(str_replace('"','',$item_new));
				$item_new =	 str_replace("’","'",$item_new);
				$item_new =  str_replace(chr(194),"",$item_new);
				$item_new =  str_replace("&nbsp;","",$item_new);

				$line[] = $enclosure.str_replace($enclosure, $enclosure.$enclosure,$item_new).$enclosure;
			}
			$out .= implode($delim, $line).$newline;
		}

		return $out;
	}

}//End download_clients_campaign_list_report



if (!function_exists('remove_slaches')){

	function remove_slaches($contents){

		$refine_contents = preg_replace('/\\\\/', '', strip_tags($contents));
		
		return $refine_contents;
	}  

}//End remove_slaches


?>
