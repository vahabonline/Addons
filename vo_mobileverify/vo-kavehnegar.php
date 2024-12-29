<?php

function vo_sendSms($params){
    	$token = $params['username'];
	if(empty($ApiKey)){
		$token = $params['password'];
	}
	$sendernumber = $params['formnumber'];
	$usermobile = $params['usernumber'];
	$message = urlencode($params['message']);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "http://api.kavenegar.com/v1/{$token}/sms/send.json",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => "receptor={$usermobile}&sender={$sendernumber}&message={$message}",
	CURLOPT_HTTPHEADER => array(
		'Content-Type: application/x-www-form-urlencoded',
		'Cookie: cookiesession1=678A8C31FHJLMNOQRSTUV012345665A2'
	  ),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$res = json_decode($response);
	if($res->return->status == '200'){
		return 'success';
	}
	return $response;
}
