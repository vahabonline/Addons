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
 * Author: Vahab Sydi
 * -----
 * Last Modified: 2024-10-30
 * Modified By: the developer formerly known as vahab seyed chorteh at myvahab@gmail.com
 * -----
 * Copyright (c) 2026 VahabOnline.ir
 */


// اطلاعات ارسال کننده
function info_pishgamrayan(){
    return array(
        "name" => "pishgamrayan",
        "username_label" => "Token",
        "password_label" => false,
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_pishgamrayan($user,$pass,$sender){
	if($user && $sender){
		return true;
	}else{
		return false;
	}
}

// نمایش اعتبار پنل
function balance_pishgamrayan($user,$pass,$sender){
	return true;
}

// ارسال عادی
function sending_default_pishgamrayan($token,$field2,$from,$to,$txt){
		$recipientNumbers = explode(",",$to);
    $messageBodies[] = $txt;
    $senderNumbers[] = $from;
    $userTag = 'send sms module';

    $url = "https://api.pishgamrayan.com/sendP2P";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Authorization:' . $token,
        'Content-Type: application/json'
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $request = [
        'messageBodies' => $messageBodies,
        'recipientNumbers' => $recipientNumbers,
        'userTag' => $userTag,
        'senderNumbers' => $senderNumbers
    ];
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));
    $response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    $statusReturnType = [
        401 => "خطا احرازهویت",
        402 => "حساب کاربری غیرفعال",
        406 => "ورودی نامعتبر",
        423 => "توکن غیرفعال",
        428 => "آی پی نامعتبر",
        429 => "تعداد ارسال در واحد زمانی بیشتر از حد مجاز است",
        500 => "خطای ناشناخته"
    ];

    if ($status == 200) {
        return json_decode($response)->result;
    }
    $result = $statusReturnType[$status] ?? ($status == 400 ? json_decode($response)->message : false);
    return json_encode($result);

  
}

// ارسال به صورت پترن
function sending_pattern_pishgamrayan($username,$password,$fromNum,$to,$pattern_code,$msg){
	return false;
}
