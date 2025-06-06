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
	try{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.kavenegar.com/v1/{$ApiKey}/account/config.json?defaultsender={$sender}&apilogs=justfaults",
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
	}catch(Exception $e) {
		return $e->getMessage();
	}
}

// نمایش اعتبار پنل
function balance_kavehnegar($ApiKey,$pass,$sender){
	try{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.kavenegar.com/v1/{$ApiKey}/account/config.json?defaultsender={$sender}&apilogs=justfaults",
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
	}catch(Exception $e) {
		return $e->getMessage();
	}
}

// ارسال عادی
function sending_default_kavehnegar($apiKey,$pass,$fromnumber,$usermobile,$message){
	try{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.kavenegar.com/v1/{$apiKey}/sms/send.json?receptor={$usermobile}&sender={$fromnumber}&message=" . urlencode($message),
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
	}catch(Exception $e) {
		return $e->getMessage();
	}
}

// ارسال به صورت پترن
function sending_pattern_kavehnegar($username,$password,$sender,$to,$pattern_code,$msg){
	return false;
}
