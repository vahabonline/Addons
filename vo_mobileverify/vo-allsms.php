<?php
vo_sendSms($params){
	$curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://allSMSSend.ir/api/apicore/SendFarapayamak',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "UserName": "' . $params['username'] .'",
      "PassWord": "' . $params['password'] .'",
      "bodyId": "1",
      "text": "' . $params['message'] .'",
      "to": "' . $params['usernumber'] .'"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  //echo $response;
	return $response;
}
