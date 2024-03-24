<?php
function vo__reglogin_CallFaraSms($usr,$pass,$action,$array=array()){
	$soap=new SoapClient('http://farasms.ir/webservice3/index.php?WSDL',array("login" => $usr,"password" => $pass));
	return $soap->__soapCall($action,$array);
}
function vo_sendSms($params){
  $res = vo__reglogin_CallFaraSms($params['username'], $params['password'], 'sendNonComplexMessage', array(
			'number' => $params['sendernumber'],
			'mobile' => $params['sendernumber'],
			'message' => $params['message']
  ));
	preg_match_all('/\d+/', $res, $matches);
  $count = strlen($matches[0][0]);
	if($count > 8){
    return true;
  }
  return $res;
}
