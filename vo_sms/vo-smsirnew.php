<?php
/*
 * This file create by VahabOnline
 * WebSite https://vahabonline.ir
 * Mobile 09374655385 - 09118689448
 * Mail info@vahabonline.ir
 * -----
 * File: vo-smsirnew.php
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


function vo___REQ($method='POST',$req,$token,$data=array()){
	if($method == 'POST'){
		try{
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://api.sms.ir/v1/' . $req,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode($data),
				CURLOPT_HTTPHEADER => array(
					'ACCEPT: application/json',
					'X-API-KEY: ' . $token,
					'Content-Type: application/json'
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return json_decode($response,true);
		}catch (Exception $e){}
	}
	if($method == 'GET'){
		try{
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://api.sms.ir/v1/' . $req,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'ACCEPT: application/json',
					'X-API-KEY: ' . $token
				),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			return json_decode($response,true);
		}catch (Exception $e){}
	}
}

// اطلاعات ارسال کننده
function info_smsirnew(){
    return array(
        "name" => "Sms IR New",
        "username_label" => "کلید وبسرویس",
        "password_label" => false,
	"sendernumber_label" => "شماره ارسال کننده",
	"pattern_label" => 'شماره ارسال خدماتی',
        "pattern" => true,
    );
}

// وضعیت اتصال
function status_smsirnew($xapikey,$APIKey,$sender){
	$req = vo___REQ('GET','credit',$xapikey);
	if($req['status'] == '1'){
		return true;
	}
	return false;
}

// نمایش اعتبار پنل
function balance_smsirnew($xapikey,$APIKey,$sender){
	$req = vo___REQ('GET','credit',$xapikey);
	if($req['status'] == '1'){
		return $req['data'];
	}
	return false;
}

// ارسال عادی
function sending_default_smsirnew($xapikey,$APIKey,$LineNumber,$to,$txt){
	$post['lineNumber'] = $LineNumber;
	$post['messageText'] = $txt;
	$post['mobiles'][] = $to;
	$req = vo___REQ('POST','send/bulk',$xapikey,$post);
	return json_encode($req);
}

// ارسال به صورت پترن
function sending_pattern_smsirnew($xapikey,$password,$sender,$to,$pattern_code,$msg){
	$patternss = json_decode($msg,true);
	$json = [];
	$json['mobile'] = $to;
	$json['templateId'] = $pattern_code;
	foreach($patternss as $name => $value){
		$json['parameters'][] = [
			'name' => $name,
			'value' => $value
		];
	}
	$req = vo___REQ('POST','send/verify',$xapikey,$json);
	$out['result'] = json_encode($req);
	$out['username'] = $xapikey;
	$out['password'] = $password;
	$out['sender'] = $sender;
	$out['to'] = $to;
	$out['pattern_code'] = $pattern_code;
	$out['message'] = $msg;
	return json_encode($out);
}
