<?php

function send_sms($params=[]){
    try {
	    
  	$from = $params['sendnumber'];
  	$to = $params['tonumbers'][0];
  	$message = $params['message'];
  	$username = $params['username'];
  	$password = $params['password'];
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
  	CURLOPT_POSTFIELDS => "receptor={$to}&sender={$from}&message={$message}",
  	CURLOPT_HTTPHEADER => array(
  		'Content-Type: application/x-www-form-urlencoded',
  		'Cookie: cookiesession1=678A8C31FHJLMNOQRSTUV012345665A2'
  	  ),
  	));
  	$response = curl_exec($curl);
  	curl_close($curl);
  	return json_encode([
  	    'Res' => $response,
  	    'Params' => $params,
  	]);
		
    } catch (SoapFault $ex) {
        return $ex->faultstring;
    }
}
