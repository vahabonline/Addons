<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-elanak.php
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
function info_elanak(){
    return array(
        "name" => "Elanak",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_elanak($user,$pass,$sender){
	if(!empty($user) && !empty($pass) && !empty($sender)){
		return true;
	}
	return false;
}

// نمایش اعتبار پنل
function balance_elanak($user,$pass,$sender){
	$soap=new SoapClient("https://panel.elanak.ir//webservice/send.php?wsdl");
	//GetCredit
	$soap->Username=$user;
	$soap->Password=$pass;
	return $soap->GetCredit($soap->Username,$soap->Password);
}

// ارسال عادی
function sending_default_elanak($field1,$field2,$field3,$to,$txt){
	$soap=new SoapClient("https://panel.elanak.ir//webservice/send.php?wsdl");
	//SendSMS
	$soap->Username=$field1;
	$soap->Password=$field2;
	$soap->fromNum=$field3;
	$soap->toNum=array($to);
	$soap->Content = $txt;
	$soap->Type = '0';
	$array = $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
	return json_encode($array);
}

// ارسال به صورت پترن
function sending_pattern_elanak($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
