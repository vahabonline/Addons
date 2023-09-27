<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-sunwaysms.php
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
function info_sunwaysms(){
    return array(
        "name" => "SunWaySms",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_sunwaysms($user,$pass,$sender){
	return true;
}

// نمایش اعتبار پنل
function balance_sunwaysms($user,$pass,$sender){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://sms.sunwaysms.com/smsws/HttpService.ashx?service=GetCredit&username=%24UserName%24&password=%24Password%24',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

// ارسال عادی
function sending_default_sunwaysms($field1,$field2,$field3,$to,$txt){
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://sms.sunwaysms.com/smsws/HttpService.ashx?service=SendArray&username={$field1}&password={$field2}&to={$to}&message={$txt}&from={$field3}",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

// ارسال به صورت پترن
function sending_pattern_sunwaysms($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}