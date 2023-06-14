<?php

function send_sms($params){
    ini_set("soap.wsdl_cache_enabled", "0");
    try {
	    
	$from = $params['sendnumber'];
	$to = $params['tonumbers'];
	$message = $params['message'];
	$username = $params['username'];
	$password = $params['password'];
	    
    	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://185.112.33.62/api/v1/rest/sms/send',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
	    "from": "'.$from.'",
	    "recipients": [
		"'.$to.'"
	    ],
	    "message": "'.$message.'",
	    "type": 0
	}',
	  CURLOPT_HTTPHEADER => array(
	    'username: '.$username,
	    'password: '.$password,
	    'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
		
    } catch (SoapFault $ex) {
        return $ex->faultstring;
    }
}
