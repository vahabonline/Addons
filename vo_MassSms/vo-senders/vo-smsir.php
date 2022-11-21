<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-smsir.php
 * Project: vo-senders
 * Version: 1.0
 * Created Date: Wednesday February 24th 2021
 * Author: Vahab Seyed Chorteh
 * -----
 * Last Modified: Wednesday February 24th 2021 10:24:06 am
 * Modified By: the developer formerly known as SmsModule at myvahab@gmail.com
 * -----
 * Copyright (c) 2021 Your Company
 */


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

function vo_sender($vars){
    $username = $vars['username'];
    $password = $vars['password'];
    $apikey = $vars['apikey'];
    $sendernumber = $vars['sendernumber'];
    $phonenumber = $vars['phonenumber'];
    $message = $vars['message'];

    $token = vo_sms_GetToken($apikey,$password);
	$Messages = array($message);
	$SendMessage = vo_sms_Send_MessageApi($token,$sendernumber,$phonenumber, $Messages);
	return $SendMessage;
}

