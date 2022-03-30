<?php
function sms_sending($var){
	
	// دو مقدار زیر را ویرایش نمایید
	$pattern_sms_one = "be9ru3k86p"; // پترن اس ام اس اول
	$pattern_sms_two = "be9ru3k86p"; //پترن اس ام اس دوم


	$username = $var['username'];
	$password = $var['password'];
	$from = $var['form'];
	$to = array($var['to']);
	
	//ارسال پیام اول
	if(!empty($var['code']) && !empty($var['hash'])){
		$input_data = array("code" => $var['code'], "key" => $var['hash']);
		$pattern_code = $pattern_sms_one;
	}
	// ارسال پیام دوم
	if(!empty($var['pass'])){
		$input_data = array("pass" => $var['pass']);
		$pattern_code = $pattern_sms_two;
	}
	$url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
	$handler = curl_init($url);
	curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($handler);
	return $response;
}