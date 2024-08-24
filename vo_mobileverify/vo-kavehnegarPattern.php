<?php
function vo_sendSms($params){
	$ApiKey = $params['username'];
	if(empty($ApiKey)){
		$ApiKey = $params['password'];
	}
	$json = htmlspecialchars_decode(html_entity_decode($params['message']));
    $json = json_decode($json);
    $codename = $json->codename;
    $otpid = $json->patterncode;
    $actcode = $json->activecode;
    $usermob = $params['usernumber'];
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://api.kavenegar.com/v1/'.$ApiKey.'/verify/lookup.json',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => 'receptor='.$usermob.'&code='.$actcode.'&template=' . $otpid,
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
