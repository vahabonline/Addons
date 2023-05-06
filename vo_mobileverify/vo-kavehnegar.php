<?php
function vo_sendSms($params){
	$ApiKey = $params['username'];
	if(empty($ApiKey)){
		$ApiKey = $params['password'];
	}
	
	$formnumber = $params['formnumber'];
	$message = $params['message'];
	$usernumber = $params['usernumber'];

	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.kavenegar.com/v1/{$ApiKey}/sms/send.json?receptor={$usernumber}&sender={$formnumber}&message={$message}",
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
	
	if($response){
		$json = json_decode($response);
		if($json['return']['status'] == 200){
			return 'success';
		}
	}

	return $response;
}