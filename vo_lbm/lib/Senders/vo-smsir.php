<?php
ini_set("soap.wsdl_cache_enabled", "0");
function vo_sms_execute($postData, $url, $token){
	$postString = json_encode($postData);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'x-sms-ir-secure-token: '.$token
	));
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POST, count($postString));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
function vo_sms_execute_simple($url, $token){
        $ch = curl_init($url);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'x-sms-ir-secure-token: '.$token
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
}
function vo_sms_GetToken($APIKey,$SecretKey){
	$postData = array(
		'UserApiKey' => $APIKey,
		'SecretKey' => $SecretKey,
		'System' => 'php_rest_v_1_2'
	);
	$postString = json_encode($postData);
	$ch = curl_init("http://RestfulSms.com/api/Token");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POST, count($postString));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
	$result = curl_exec($ch);
	curl_close($ch);
	$response = json_decode($result);
	if(is_object($response)){
		$resultVars = get_object_vars($response);
		if(is_array($resultVars)){
			@$IsSuccessful = $resultVars['IsSuccessful'];
			if($IsSuccessful == true){
				@$TokenKey = $resultVars['TokenKey'];
				$resp = $TokenKey;
			} else {
				$resp = false;
			}
		}
	}
	return $resp;
}

function vo_sms_Send_MessageApi($token,$LineNumber,$MobileNumbers, $Messages, $SendDateTime = '') {
	if($token != false){
		$postData = array(
			'Messages' => $Messages,
			'MobileNumbers' => $MobileNumbers,
			'LineNumber' => $LineNumber,
			'SendDateTime' => $SendDateTime,
			'CanContinueInCaseOfError' => 'false'
		);
		$url = "http://RestfulSms.com/api/MessageSend";
		$SendMessage = vo_sms_execute($postData, $url, $token);
		$object = json_decode($SendMessage);
		if(is_object($object)){
			$array = get_object_vars($object);
			if(is_array($array)){
				$result = $array['Message'];
			} else {
				$result = false;
			}
		} else {
			$result = false;
		}
	} else {
		$result = false;
	}
	return $result;
}


function vo_sms_sending($vars){
	$username = $vars['panel_username'];
    $password = $vars['panel_password'];
    $apikey = $vars['panel_password'];
    $sendernumber = $vars['panel_sendernumber'];
    $phonenumber = $vars['sec_usernumber'];
    $message = $vars['msgtxt'];
    $token = vo_sms_GetToken($apikey,$password);
	$Messages = array($message);
	$SendMessage = vo_sms_Send_MessageApi($token,$sendernumber,$phonenumber, $Messages);
	return $SendMessage;
}