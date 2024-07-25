<?php

function vo_sendSms($params){
	$apiKey = $params['password'];
    $curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.sabanovin.com/v1/{$apiKey}/sms/send.json",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array(
			'gateway' => $params['formnumber'],
			'to' => $params['mobile'],
			'text' => $params['message']
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$result = json_decode($response, true);
	if($result['status']['code'] == '200'){
        return 'success';
    }else{
        return $response;
    }
}
