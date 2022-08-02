<?php
function info_host97(){
    return array(
        "name" => "هاست 97",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
        "sendernumber_label" => "ارسال کننده",
        "pattern_label" => false,
        "pattern" => true,
    );
}

function status_host97(){
    
}

function balance_host97(){
    return true;
}

function sending_default_host97($username,$password,$sendernumber,$to,$txt){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_URL, "http://sms321.ir/webservice/rest/sms_send?");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,   "login_username={$username}&login_password={$password}&receiver_number={$to}&note_arr[]={$txt}&sender_number={$sendernumber}");
	$results2 = curl_exec($ch);
	curl_close($curl);
	return $response;
}

function sending_pattern_host97($username,$password,$sendernumber,$to,$pattern_code,$patternarray){
	return true;
}
