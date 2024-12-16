<?php
// اطلاعات ارسال کننده
function info_sahandsms(){
    return array(
        "name" => "sahandsms",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
    		"sendernumber_label" => "شماره ارسال کننده",
    		"pattern_label" => false,
        "pattern" => false,
    );
}

// وضعیت اتصال
function status_sahandsms($user='',$pass='',$sender=''){
	if($user && $pass && $sender){
    return true;
  }
  return false;
}

// نمایش اعتبار پنل
function balance_sahandsms($user,$pass,$sender){
	return false;
}

// ارسال عادی
function sending_default_sahandsms($username,$password,$from,$to,$txt){
	$to = explode(",",$to);
	try {
	      $toNumber = $params['mobile'];
	      $url = 'http://www.sahandsms.com/NewWebService/newSMSWebService.asmx?wsdl';
	      $client = new SoapClient($url);
	      if(is_array($toNumber)){
	          $toNumber = $to;
	      }else{
	          $toNumber = array($to);
	      }
	      $parameters['username'] = $username;
	      $parameters['password'] = $password;
	      $parameters['message'] = $txt;
	      $parameters['fromNumber'] = '+98'.$from;
	      $parameters['toNumbers'] = $toNumber;
	      $return_val = $client->SendQeue($parameters);
      		return json_encode($return_val);
	} catch (SoapFault $ex) {
		return $ex->faultstring;
	}
}

// ارسال به صورت پترن
function sending_pattern_sahandsms($username,$password,$fromNum,$to,$pattern_code,$msg){
	return false;
}
