<?php
function SendMsg($params){
	ini_set("soap.wsdl_cache_enabled", "0");
	$sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding'=>'UTF-8'));
	$usermobiles[] = $params['mobile'];
	try {
		$parameters['userName'] = $params['username'];
		$parameters['password'] = $params['password'];
		$parameters['fromNumber'] = $params['sendNumber'];
		$parameters['toNumbers'] = $usermobiles;
		$parameters['messageContent'] = str_replace('{code}',$params['smsCode'],$params['message']);
		$parameters['isFlash'] = false;
		$recId = array();
		$status = array();
		$parameters['recId'] = &$recId ;
		$parameters['status'] = &$status ;
		return $sms_client->SendSMS($parameters)->SendSMSResult;
	}catch (Exception $e){
		return 'Caught exception: ',  $e->getMessage(), "\n";
	}
}