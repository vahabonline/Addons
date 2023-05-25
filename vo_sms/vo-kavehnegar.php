<?php
function info_kavehnegar(){
    return array(
        "name" => "KavehNegar",
        "username_label" => "توکن",
        "password_label" => false,
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_kavehnegar($ApiKey,$pass,$sender){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.kavenegar.com/v1/{$ApiKey}/account/config.json?defaultsender={$sender}&apilogs=justfaults&debugmode=enabled",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$response = json_decode($response);
	if($response->return->status == '200'){
		return true;
	}else{
		return false;
	}
}

// نمایش اعتبار پنل
function balance_kavehnegar($ApiKey,$pass,$sender){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.kavenegar.com/v1/{$ApiKey}/account/config.json?defaultsender={$sender}&apilogs=justfaults&debugmode=enabled",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$response = json_decode($response);
	if($response->return->status == '200'){
		return $response->entries->mincreditalarm;
	}else{
		return json_encode($response);
	}
}

// ارسال عادی
function sending_default_kavehnegar($apiKey,$pass,$fromnumber,$usermobile,$message){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.kavenegar.com/v1/{$apiKey}/sms/send.json?receptor={$usermobile}&sender={$fromnumber}&message={$message}",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

// ارسال به صورت پترن
function sending_pattern_kavehnegar($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
