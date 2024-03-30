<?php
function vo_rpbs__CallFaraSms($usr,$pass,$action,$array=array()){
	$soap=new SoapClient('http://farasms.ir/webservice3/index.php?WSDL',array("login" => $usr,"password" => $pass));
	return $soap->__soapCall($action,$array);
}
function sms_sending($params){
    return vo_mv__CallFaraSms($params['username'], $params['password'], 'sendNonComplexMessage', array(
			'number' => $params['form'],
			'mobile' => $params['to'],
			'message' => $params['msg']
		));
}
