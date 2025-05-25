<?php
function vo_sendSms($params){
    $username = $params['username'];
	$password = $params['password'];
	$token = $params['token'];
	$usermobile = $params['usermobile'];
	$otpMsg = json_decode($params['message']);
    $otpBody = $otpMsg->otpCode;
    $otpID = $otpMsg->otpid;
    $otpName = $otpMsg->otpName;
    $from = $params['sendernumber'];
    	
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	    	CURLOPT_URL => 'http://api.kavenegar.com/v1/'.$token.'/verify/lookup.json',
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
