<?php
function info_raygansms(){
    return array(
        "name" => "raygansms",
        "username_label" => "نام کاربری",
        "password_label" => 'رمز عبور',
		    "sendernumber_label" => "شماره ارسال کننده",
		    "pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_raygansms($ApiKey,$pass,$sender){
	return true;
}

// نمایش اعتبار پنل
function balance_raygansms($ApiKey,$pass,$sender){
	return true;
}

// ارسال عادی
function sending_default_raygansms($username,$pass,$fromnumber,$usermobile,$message){
	$Url="http://smspanel.Trez.ir/SendMessageWithPost.ashx";
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL,$Url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
        http_build_query(array('Username' => $username,
        'Password'=>$pass,
        'PhoneNumber'=>$fromnumber,
	      'MessageBody'=>$message,
	      'RecNumber'=>$usermobile,
        'Smsclass'=>$sms)));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec($ch);
        
        curl_close ($ch);

        return $server_output;
}

// ارسال به صورت پترن
function sending_pattern_raygansms($username,$password,$sender,$to,$pattern_code,$msg){
	return false
}
