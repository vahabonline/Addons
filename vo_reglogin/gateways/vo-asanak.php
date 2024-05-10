<?php
function __this_checkString($str) {
    if (ctype_digit($str)) {
        if (strlen($str) > 4) {
            return true;
        } else {
            return false;
        }
    } else {
        return $str;
    }
}
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
            'Source' => $params['sendernumber'],
            'Message' => $params['message'],
            'destination' => $params['usermobile']
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return __this_checkString($response);
}
