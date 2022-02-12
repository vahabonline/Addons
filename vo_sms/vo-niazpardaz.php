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
        "name" => "نیازپرداز",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_ippanel($user,$pass,$sender){
	ini_set("soap.wsdl_cache_enabled", "0");
	$sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding'=>'UTF-8'));
	$parameters['userName'] = $user;
	$parameters['password'] = $pass;
	$res = $sms_client->GetCredit($parameters)->GetCreditResult;
	if($res_code != false){
		return true;
	}else{
		return false;
	}
}

// نمایش اعتبار پنل
function balance_ippanel($user,$pass,$sender){
	ini_set("soap.wsdl_cache_enabled", "0");
	$sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding'=>'UTF-8'));
	$parameters['userName'] = $user;
	$parameters['password'] = $pass;
	return $sms_client->GetCredit($parameters)->GetCreditResult;
}

// ارسال عادی
function sending_default_ippanel($username,$password,$fromnumber,$to,$txt){
	ini_set("soap.wsdl_cache_enabled", "0");
	$sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding'=>'UTF-8'));
	$usermobiles = explode(",",$to);
	try {
		$parameters['userName'] = $username;
		$parameters['password'] = $password;
		$parameters['fromNumber'] = $fromnumber;
		$parameters['toNumbers'] = $usermobiles;
		$parameters['messageContent'] = $txt;
		$parameters['isFlash'] = false;
		$recId = array();
		$status = array();
		$parameters['recId'] = &$recId ;
		$parameters['status'] = &$status ;
		return $sms_client->SendSMS($parameters)->SendSMSResult;
	}catch (Exception $e){
		return 'Caught exception: ',  $e->getMessage(), "\n";
	}

}

// ارسال به صورت پترن
function sending_pattern_ippanel($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}