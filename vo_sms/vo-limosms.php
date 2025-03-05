<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-ippanel.php
 * Project: vo-senders
 * Version: <<projectversion>>
 * Created Date: Thursday May 7th 2020
 * Author: Vahab Seyed Chorteh
 * -----
 * Last Modified: Thursday May 7th 2020 12:40:14 pm
 * Modified By: the developer formerly known as vahab seyed chorteh at myvahab@gmail.com
 * -----
 * Copyright (c) 2020 Your Company
 */


// اطلاعات ارسال کننده
function info_limosms(){
    return array(
        "name" => "limosms",
        "username_label" => "توکن",
        "password_label" => "توکن",
	"sendernumber_label" => "شماره ارسال کننده",
	"pattern_label" => 'شماره ارسال کننده خدماتی',
        "pattern" => true,
    );
}

// وضعیت اتصال
function status_limosms($user,$pass,$sender){
	
}

// نمایش اعتبار پنل
function balance_limosms($user,$pass,$sender){
	return false;
}

// ارسال عادی
function sending_default_limosms($user,$password,$from,$to,$txt){
		$receiver = explode(",",$to);
		$url ='https://api.limosms.com/api/sendsms';
    $post_data = json_encode(array(
    'Message' =>$txt,
    'SenderNumber' => $from,
    'MobileNumber' => $receiver,
    ));
    $process = curl_init();
    curl_setopt( $process,CURLOPT_URL,$url);
    curl_setopt( $process, CURLOPT_TIMEOUT,30);
    curl_setopt( $process, CURLOPT_POST, 1);
    curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt( $process, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt( $process, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt( $process, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt( $process, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'ApiKey:' . $user
    ));
    $return = curl_exec( $process);
    $httpcode = curl_getinfo( $process, CURLINFO_HTTP_CODE);
    curl_close($process);
     return $return;
}

// ارسال به صورت پترن
function sending_pattern_limosms($username,$password,$fromNum,$to,$pattern_code,$msg){
	$url ='https://api.limosms.com/api/sendpatternmessage';
	$post_data = json_encode(array(
		'OtpId' => $pattern_code,
		'ReplaceToken' => json_decode($msg),
		'MobileNumber' => $to
	));
	$process = curl_init();
	curl_setopt( $process,CURLOPT_URL,$url);
	curl_setopt( $process, CURLOPT_TIMEOUT,30);
	curl_setopt( $process, CURLOPT_POST, 1);
	curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt( $process, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt( $process, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt( $process, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt( $process, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'ApiKey:' . $username
	));
	$return = curl_exec( $process);
	$httpcode = curl_getinfo( $process, CURLINFO_HTTP_CODE);
	curl_close($process);
	$decoded = json_decode($return);
	return $decoded;
}
