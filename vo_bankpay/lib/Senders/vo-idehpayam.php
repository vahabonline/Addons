<?php

function send_sms($params){
    try {
	    
	$from = $params['sendnumber'];
	$to = json_encode($params['tonumbers']);
	$message = $params['message'];
	$username = $params['username'];
	$password = $params['password'];
	$params1 = '{
	    "from": "'.$from.'",
	    "recipients": '.$to.',
	    "message": "'.$message.'",
	    "type": 0
	}';
	$params2 = array(
	    'username: '.$username,
	    'password: '.$password,
	    'Content-Type: application/json'
	  );
	    
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
	  CURLOPT_POSTFIELDS =>$params1,
	  CURLOPT_HTTPHEADER => $params2
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return json_encode([
	    'Res' => $response,
	    'Params1' => $params1,
	    'Params2' => $params2
	]);
		
    } catch (SoapFault $ex) {
        return $ex->faultstring;
    }
}
