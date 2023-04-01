<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-hostiran.php
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
ini_set("soap.wsdl_cache_enabled", "0");

// اطلاعات ارسال کننده
function info_hostiran(){
    return array(
        "name" => "hostiran",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
	"sendernumber_label" => "شماره ارسال کننده",
	"pattern_label" => 'شماره پترن',
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_hostiran($user,$pass,$sender){
	$sms_client = new SoapClient('http://api.payamak-panel.com/post/Send.asmx?wsdl', array('encoding'=>'UTF-8'));
	$parameters['username'] = $user;
	$parameters['password'] = $pass;
	$res = $sms_client->GetCredit($parameters)->GetCreditResult;
	if($res > 0){
		return true;
	}else{
		return false;
	}
}

// نمایش اعتبار پنل
function balance_hostiran($user,$pass,$sender){
	$sms_client = new SoapClient('http://api.payamak-panel.com/post/Send.asmx?wsdl', array('encoding'=>'UTF-8'));
	$parameters['username'] = $user;
	$parameters['password'] = $pass;
	return $sms_client->GetCredit($parameters)->GetCreditResult;
}

// ارسال عادی
function sending_default_hostiran($usr,$pas,$frm,$to,$txt){
	$to = array($to);
	try {
		$client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));
	 	$parameters['username'] = $usr;
	    	$parameters['password'] = $pas;
	    	$parameters['from'] = $frm;
	    	$parameters['to'] = $to;
	    	$parameters['text'] = $txt;
	    	$parameters['isflash'] = false;
	    	$parameters['udh'] = "";
	    	$parameters['recId'] = array(0);
		$parameters['status'] = 0x0;
		$client->GetCredit(array("username"=>"wsdemo","password"=>"wsdemo"))->GetCreditResult;
		return $client->SendSms($parameters)->SendSmsResult;
	 } catch (SoapFault $ex) {
	    	return $ex->faultstring;
	}
}

// ارسال به صورت پترن
function sending_pattern_hostiran($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
