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


// اطلاعات ارسال کننده
function info_hostiran(){
    return array(
        "name" => "hostiran",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => 'شماره پترن',
        "pattern" => true,
    );
}

// وضعیت اتصال
function status_hostiran($user,$pass,$sender){
	if($res_code == '0'){
		return true;
	}else{
		return false;
	}
}

// نمایش اعتبار پنل
function balance_hostiran($user,$pass,$sender){
	return false;
}

// ارسال عادی
function sending_default_hostiran($field1,$field2,$field3,$to,$txt){
		return false;
}

// ارسال به صورت پترن
function sending_pattern_hostiran($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
