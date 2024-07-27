<?php

function vo_sendSms($params){
	$apiKey = $params['password'];
	$url = "https://api.sabanovin.com/v1/".$apiKey."/sms/send.json";
    $curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array(
			'gateway' => $params['formnumber'],
			'to' => $params['usernumber'],
			'text' => $params['message']
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}
