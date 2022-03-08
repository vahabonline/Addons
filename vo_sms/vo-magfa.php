<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-magfa.php
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
function userdomain(){
	$domain = "magfa";
	return $domain;
}
// اطلاعات ارسال کننده
function info_magfa(){
    return array(
        "name" => "Magfa",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_magfa($user,$pass,$sender){
	return true;
}

// نمایش اعتبار پنل
function balance_magfa($username,$password,$sender){
	$domain = userdomain();
	$url = 'https://sms.magfa.com/api/http/sms/v2/balance';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
	curl_setopt($ch, CURLOPT_USERPWD, $username."/".$domain . ":" . $password);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	return json_decode($response, true);
}

// ارسال عادی
function sending_default_magfa($username,$password,$sender,$to,$txt){
	$domain = userdomain();
	$url = 'https://sms.magfa.com/api/soap/sms/v1/server?wsdl';
	$options = [
		'login' => $username,'password' => $password, // -Credientials
		'cache_wsdl' => WSDL_CACHE_NONE, // -No WSDL Cache
		'trace' => false // -Optional (debug)
	];
	$client = new SoapClient( $url, $options);
	$result['send'] = $client->send(
		$domain,
		[$txt],
		[$to],
		[$sender],
		[],
		[],
		[],
		[]
		[1989812],
	);
	return $result;
}

// ارسال به صورت پترن
function sending_pattern_magfa($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
