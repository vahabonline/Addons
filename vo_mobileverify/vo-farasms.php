<?php
function vo_mv__CallFaraSms($usr,$pass,$action,$array=array()){
	$soap=new SoapClient('http://farasms.ir/webservice3/index.php?WSDL',array("login" => $usr,"password" => $pass));
	return $soap->__soapCall($action,$array);
}


function vo_sendSms($params){
  $result = vo_mv__CallFaraSms($params['username'], $params['password'], 'sendNonComplexMessage', array(
			'number' => $params['formnumber'],
			'mobile' => $params['usernumber'],
			'message' => $params['message']
		));
  preg_match_all('/\d+/', $result, $matches);
  $count = strlen($matches[0][0]);
	if($count > 8){
    return 'success'; 
  }
	return $result;
}
