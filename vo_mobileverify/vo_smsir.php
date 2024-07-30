<?php

function vo_sendSms($params){
  $apikey = $params['username'];
  if(empty($apikey)){
    $apikey = $params['password'];
  }
  	try{
		$data['lineNumber'] = $params['formnumber'];
		$data['messageText'] = $params['message'];
		$data['mobiles'] = [$params['usernumber']];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.sms.ir/v1/send/bulk',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'ACCEPT: application/json',
				'X-API-KEY: ' . $apikey,
				'Content-Type: application/json'
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$res = json_decode($response,true);
		$params['status'] = false;
		if($res['status'] == '1'){
			return 'success';
		}
		$params['result'] = $res;
		return json_encode($params);
	}catch (Exception $e){
		return $e->message;
	}
}
