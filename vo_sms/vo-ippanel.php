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
function info_ippanel(){
    return array(
        "name" => "IpPanel",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => 'شماره پترن',
        "pattern" => true,
    );
}

// وضعیت اتصال
function status_ippanel($user,$pass,$sender){
	$url = "https://ippanel.com/services.jspd";
	$param = array(
		'uname'=>$user,
		'pass'=>$pass,
		'op'=>'credit'
	);		
	$handler = curl_init($url);             
	curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                       
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
	$response2 = curl_exec($handler);
	$response2 = json_decode($response2);
	$res_code = $response2[0];
	$res_data = $response2[1];
	if($res_code == '0'){
		return true;
	}else{
		return false;
	}
}

// نمایش اعتبار پنل
function balance_ippanel($user,$pass,$sender){
	$url = "https://ippanel.com/services.jspd";
		
	$param = array(
		'uname'=>$user,
		'pass'=>$pass,
		'op'=>'credit'
	);
				
	$handler = curl_init($url);             
	curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                       
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
	$response2 = curl_exec($handler);
	$response2 = json_decode($response2);
	$res_code = $response2[0];
	$res_data = $response2[1];
	
	return $res_data;
}

// ارسال عادی
function sending_default_ippanel($field1,$field2,$field3,$to,$txt){
		$mobile = explode(",",$to);
		foreach($mobile as $number){
			$numbersend[] = mobilechk($number);
		}
		$url = "https://ippanel.com/services.jspd";
		$param = array(
			'uname'=>$field1,
			'pass'=>$field2,
			'from'=>$field3,
			'message'=>$txt,
			'to'=>json_encode($numbersend),
			'op'=>'send'
		);
					
		$handler = curl_init($url);             
		curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                       
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		$response2 = curl_exec($handler);
		
		$response2 = json_decode($response2);
		$res_code = $response2[0];
		$res_data = $response2[1];
		
		return $res_data;
}

// ارسال به صورت پترن
function sending_pattern_ippanel($username,$password,$sender,$to,$pattern_code,$msg){
	$mobile = explode(",",$to);
	foreach($mobile as $number){
		$numbersend[] = mobilechk($number);
	}
	$input_data = json_decode($msg);
	$url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$sender&to=" . json_encode($numbersend) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
	$handler = curl_init($url);
	curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($handler);
	return $response;
}