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

function vo___vo__get_data($Data) {
	$url = "https://sms.sunwaysms.com/smsws/HttpService?";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url . $Data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
function vo___vo__SendArray($UserName, $Password, $RecipientNumber, $Message, $SpecialNumber, $IsFlash=false, $CheckingMessageID="") {
	$Number = "";
	$chkMessageID = "";
	foreach ($RecipientNumber as $item) {
		$Number = $Number . $item . ",";
	}
	foreach ($CheckingMessageID as $item) {
		$chkMessageID = $chkMessageID . $item . ",";
	}
	 return vo___vo__get_data("service=SendArray&UserName=" . urlencode($UserName) . "&Password=" . urlencode($Password) . "&To=" . urlencode(rtrim($Number,",")) . "&Message=" . urlencode($Message) .
	 "&From=" . urlencode($SpecialNumber) . "&Flash=" . urlencode(($IsFlash ? "true" : "false")) . "&chkMessageId=" . urlencode(rtrim($chkMessageID,",")));
}

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
function balance_sunwaysms($UserName,Password,$sender){
	return vo___vo__get_data("service=GetCredit&UserName=" . urlencode($UserName) . "&Password=" . urlencode($Password));
}

// ارسال عادی
function sending_default_sunwaysms($UserName,$Password,$SpecialNumber,$to,$Message){
	$mobile = explode(",",$to);
	foreach($mobile as $number){
		$RecipientNumber[] = mobilechk($number);
	}
	return vo___vo__SendArray($UserName, $Password, $RecipientNumber, $Message, $SpecialNumber)
}

// ارسال به صورت پترن
function sending_pattern_sunwaysms($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
