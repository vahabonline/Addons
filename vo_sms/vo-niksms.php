<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-niksms.php
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


function vosms_niksms_send($vars){
	$username = $vars['usr'];
    $password = $vars['pas'];
    $apikey = $vars['apikey'];
    $sendernumber = $vars['from'];
    $phonenumber = $vars['to'];
    $message = $vars['msg'];
    $now = date('Y/m/d-H:i:s');
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://niksms.com/fa/publicapi/ptpSms?username={$username}&password={$password}&senderNumber={$sendernumber}&numbers={$phonenumber}&sendType=1&message=".urlencode($message),
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


// اطلاعات ارسال کننده
function info_niksms(){
    return array(
        "name" => "NikSms",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_niksms($user,$pass,$sender){
	return true;
}

// نمایش اعتبار پنل
function balance_niksms($user,$pass,$sender){
	return null;
}

// ارسال عادی
function sending_default_niksms($field1,$field2,$field3,$to,$txt){
	$params = array(
		'usr' => $field1,
		'pas' => $field2,
		'apikey' => null,
		'from' => $field3,
		'to' => json_encode($numbersend),
		'msg' => $txt
	);
	return vosms_niksms_send($params);
}

// ارسال به صورت پترن
function sending_pattern_niksms($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
