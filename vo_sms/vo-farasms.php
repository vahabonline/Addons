<?php
function info_farasms(){
    return array(
        "name" => "هاست 97",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
        "sendernumber_label" => "ارسال کننده",
        "pattern_label" => false,
        "pattern" => true,
    );
}

function status_farasms(){
    return true;
}

function balance_farasms(){
    return true;
}

function sending_default_farasms($username,$password,$sendernumber,$to,$txt){
  
      $client = new SoapClient('http://farasmscenter.com/webservice/v2.02.php?wsdl', array('trace' => 1));

      $result=NULL;
      try {
          $result = $client->__soapCall('WSdoSendSMS3', array('username' => $username, 'password' => $password, 'from'=> $sendernumber , 'to'=>$to ,'msg'=>$txt));
      } catch (Exception $exc) {
          $result = $exc;
    }
    return $result;
}

function sending_pattern_farasms($username,$password,$sendernumber,$to,$pattern_code,$patternarray){
	return true;
}
