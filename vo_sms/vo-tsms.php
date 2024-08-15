<?php

// اطلاعات ارسال کننده
function info_tsms(){
    return array(
        "name" => "tsms",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
		    "sendernumber_label" => "شماره ارسال کننده",
		    "pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_tsms($user,$pass,$sender){
  return true;
}

// نمایش اعتبار پنل
function balance_tsms($user,$pass,$sender){
	return true;
}

// ارسال عادی
function sending_default_tsms($username,$password,$fromnumber,$to,$txt){
		$mobile = explode(",",$to);
		foreach($mobile as $number){
			$mobile_array[] = mobilechk($number);
		}
    $msg_array[] = $txt;

  



  $api = new SoapClient('http://www.tsms.ir/soapWSDL/?wsdl');
  $sms_number_array[]=$fromnumber;
  $messagid=rand();
  $mclass=array('');
  $rezult=$api->sendSms($username,$password,$sms_number_array,$mobile_array,$msg_array,$mclass,$messagid);
  return json_encode($rezult);
}

// ارسال به صورت پترن
function sending_pattern_tsms($username,$password,$fromNum,$to,$pattern_code,$msg){
  return false;
}
