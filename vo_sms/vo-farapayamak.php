<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-farapayamak.php
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

function vo__CallFaraSms($usr,$pass,$action,$array=array()){
	$soap=new SoapClient('http://farasms.ir/webservice3/index.php?WSDL',array("login" => $usr,"password" => $pass));
	return $soap->__soapCall($action,$array);
}

// اطلاعات ارسال کننده
function info_farapayamak(){
    return array(
        "name" => "farapayamak",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false
    );
}

// وضعیت اتصال
function status_farapayamak($user,$pass,$sender){
	if(vo__CallFaraSms($user, $pass, 'info')->username == $user){
		return true;
	}
	return false;
}

// نمایش اعتبار پنل
function balance_farapayamak($user,$pass,$sender){
	return vo__CallFaraSms($user, $pass, 'info')->unit3000;
}

// ارسال عادی
function sending_default_farapayamak($user,$pass,$from,$to,$txt){
		return vo__CallFaraSms($user, $pass, 'sendNonComplexMessage', array(
			'number' => $from,
			'mobile' => $to,
			'message' => $txt
		));
}

// ارسال به صورت پترن
function sending_pattern_farapayamak($username,$password,$fromNum,$to,$pattern_code,$msg){
	return false;
}
