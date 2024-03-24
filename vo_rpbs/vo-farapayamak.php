<?php

function vo__rpbs_CallFaraSms($usr,$pass,$action,$array=array()){
	$soap=new SoapClient('http://farasms.ir/webservice3/index.php?WSDL',array("login" => $usr,"password" => $pass));
	return $soap->__soapCall($action,$array);
}


function sms_sending($var){
  return vo__rpbs_CallFaraSms($var['username'], $var['password'], 'sendNonComplexMessage', array(
			'number' => $var['form'],
			'mobile' => $var['to'],
			'message' => $vars['msg']
		));
}
