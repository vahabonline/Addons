<?php
function vo_sendSms($params){
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
	  CURLOPT_POSTFIELDS => array('recipients' => [$params['usermobile']],'message' => $params['message']),
	  CURLOPT_HTTPHEADER => array(
		'Content-type: application/json',
		'username: '.$params['username'],
		'password: '.$params['password']
	  ),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$res = json_decode($response);
    if($res->status == '200'){
		if($res->result->status == '0'){
			$params['status'] = true;
		}
    }
    $params['result'] = $response;
    return $params;
}