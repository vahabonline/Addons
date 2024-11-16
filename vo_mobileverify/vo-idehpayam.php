<?php
function vo_sendSms($params){
	$to[] = $params['usernumber'];
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
      CURLOPT_POSTFIELDS => json_encode([
		'from' => $params['formnumber'],
		'recipients' => $to,
		'message' => $params['message'],
		'type' => 0
	  ]),
      CURLOPT_HTTPHEADER => array(
        'username: ' . $params['username'],
        'password: ' . $params['password'],
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response, true);
    if($result['status'] == 200){
      return 'success'; 
    }
    return $response;
}
