<?php
function vo_sendSms($vars){
	$input_data = json_decode($msg);
    	$otpMsg = json_decode($params['message']);
    	$otpBody = $otpMsg['otpbody'];
    	$otpID = $otpMsg['otpid'];
    	$otpName = $otpMsg['otpName'];
	$username = $params['username'];
    	$password = $params['password'];
    	$from = $params['sendernumber'];
    	$usermobile = $params['usermobile'];

	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	    	CURLOPT_URL => 'http://api.kavenegar.com/v1/'.$username.'/verify/lookup.json',
	    	CURLOPT_RETURNTRANSFER => true,
	    	CURLOPT_ENCODING => '',
	    	CURLOPT_MAXREDIRS => 10,
	    	CURLOPT_TIMEOUT => 0,
	    	CURLOPT_FOLLOWLOCATION => true,
	    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    	CURLOPT_CUSTOMREQUEST => 'POST',
	    	CURLOPT_POSTFIELDS => 'receptor='.$usermobile.'&'.$otpName.'='.$otpBody.'&template=' . $otpID,
	    	CURLOPT_HTTPHEADER => array(
	      		'Content-Type: application/x-www-form-urlencoded'
	    	),
	  ));
	  $response = curl_exec($curl);
	  curl_close($curl);
	  $json = json_decode($response, true);
	  if($json['return']['status'] == '200'){
		return 'success';
	  }
	  return $response;
}
