<?php
// اطلاعات ارسال کننده
function info_sabapayamak(){
    return array(
        "name" => "SabaPayamak",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		    "sendernumber_label" => "شماره ارسال کننده",
		    "pattern_label" => false,
        "pattern" => false
    );
}

// وضعیت اتصال
function status_sabapayamak($user,$pass,$sender){
	return true;
}

// نمایش اعتبار پنل
function balance_sabapayamak($user,$pass,$sender){
	return 0;
}

// ارسال عادی
function sending_default_sabapayamak($username,$password,$formnumber,$to,$message){
  	$message = urlencode($message);
  	$curl = curl_init();
  	curl_setopt_array($curl, array(
  	  CURLOPT_URL => "http://my.sabapayamak.com/API/sendSMS.ashx?username={$username}&password={$password}&to={$to}&from={$formnumber}&text={$message}",
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
function sending_pattern_sabapayamak($username,$password,$fromNum,$to,$pattern_code,$msg){
	retuurn false;
}
