<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-melipayamak.php
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
function info_melipayamak(){
    return array(
        "name" => "ملی پیامک",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
        "sendernumber_label" => "شماره ارسال کننده",
        "pattern_label" => 'شماره ارسال کننده خدماتی',
        "pattern" => true,
    );
}

// وضعیت اتصال
function status_melipayamak($user,$pass,$sender){
    try {
        $client = new SoapClient('http://api.payamak-panel.com/post/Send.asmx?wsdl', array('encoding'=>'UTF-8'));
        $parameters['username'] = $user;
        $parameters['password'] = $pass;
        $parameters['isRead'] = false;
        $result = $client->getInboxCount($parameters);
        if($result->GetInboxCountResult != '-1'){
            return true;
        }else{
            return false;
        }
    }catch (Exception $exception){
        return $exception;
    }
}

// نمایش اعتبار پنل
function balance_melipayamak($user,$pass,$sender){
    try {
        $client = new SoapClient('http://api.payamak-panel.com/post/Send.asmx?wsdl', array('encoding'=>'UTF-8'));
        $parameters['username'] = $user;
        $parameters['password'] = $pass;
        $result = $client->getCredit($parameters);
        return round($result->GetCreditResult);
    }catch (Exception $exception){
        return $exception;
    }
}

// ارسال عادی
function sending_default_melipayamak($username,$password,$from,$to,$text){
    try {
        $mobile = explode(",",$to);
        foreach($mobile as $number){
            $numbersend[] = mobilechk($number);
        }
        try {
            $client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));
            $parameters['username'] = $username;
            $parameters['password'] = $password;
            $parameters['from'] = $from;
            $parameters['to'] = $numbersend;
            $parameters['text'] = $text;
            $parameters['isflash'] = false;
            $parameters['udh'] = "";
            $parameters['recId'] = array(0);
            $parameters['status'] = 0x0;
            $status = $client->SendSms($parameters)->SendSmsResult;
        } catch (SoapFault $ex) {
            $status = $ex->faultstring;
        }
        if($status == '1'){
            $status = 'ارسال شده';
        }
        return $status;
    }catch (Exception $exception){
        return $exception;
    }
}

// ارسال به صورت پترن
function sending_pattern_melipayamak($username,$password,$sender,$to,$pattern_code,$msg){
    try {
        $client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));
        $parameters['username'] = $username;
        $parameters['password'] = $password;
        $parameters['to'] = mobilechk($to);
        $parameters['text'] = json_decode($msg);
        $parameters['bodyId'] = $pattern_code;
        $result = $client->SendByBaseNumber($parameters)->SendByBaseNumberResult;
        return $result;
    }catch (Exception $exception){
        return $exception;
    }
}
