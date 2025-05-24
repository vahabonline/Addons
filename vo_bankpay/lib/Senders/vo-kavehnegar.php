<?php

function send_sms($params=[]){
    try {

	$from = $params['sendnumber'];
  	$to = $params['tonumbers'][0];
  	$message = $params['message'];
  	$username = $params['username'] ?: '';
  	$password = $params['password'] ?: '';
    	$apiKey = $username ?: $password;
	    
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.kavenegar.com/v1/{$apiKey}/sms/send.json?receptor={$to}&sender={$from}&message=" . urlencode($message),
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
  	return json_encode([
  	    'Res' => $response,
  	    'Params' => $params,
  	]);
		
    } catch (SoapFault $ex) {
        return $ex->faultstring;
    }
}
