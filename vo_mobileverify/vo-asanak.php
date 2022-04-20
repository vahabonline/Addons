<?php
function vo_sendSms($params){
	$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://panel.asanak.com/webservice/v1rest/sendsms",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array(
            'username' => $params['username'],
            'password' => $params['password'],
            'Source' => $params['usernumber'],
            'Message' => $params['message'],
            'destination' => $params['formnumber'],
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
	return $response;
}
