<?php
function vo_sendSms($params){
	$json = htmlspecialchars_decode(html_entity_decode($params['message']));
    $json = json_decode($json, true);
    $codename = $json['codename'];
	$pattern_code = $json['patterncode'];

	$to[] = $params['usernumber'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://185.112.33.62/api/v1/rest/sms/pattern-send',
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
		'message' => [$codename => $pattern_code],
		'patternId' => '',
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
