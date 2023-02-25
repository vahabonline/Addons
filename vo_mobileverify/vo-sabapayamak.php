<?php
function vo_sendSms($params){
	$username = $params['username'];
	$password = $params['password'];
	$formnumber = $params['formnumber'];
	$to = $params['usernumber'];
	$message = $params['message'];
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://my.sabapayamak.com/API/sendSMS.ashx?username={$username}&password={$password}&to={$to}&from={$formnumber}&text={$message}",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	if(strlen($response) > 5){
		return 'success';
	}else{
		return $response;
	}
}
