<?php
function vo_sendSms($params){
	$sms_client = new SoapClient('http://webservice.0098sms.com/service.asmx?wsdl', array('encoding'=>'UTF-8'));
	$parameters['username'] = $params['username'];
	$parameters['password'] = $params['password'];
	$parameters['mobileno'] = '0' . $params['usermobile'];
	$parameters['pnlno'] = $params['sendernumber'];
	$parameters['text'] = $params['message'];
	$parameters['isflash'] = false;
	$res = $sms_client->SendSMS($parameters)->SendSMSResult;
	if($res == '2'){
	    $params['status'] = true;
	}else{
	    $params['status'] = false;
	}
	$params['result'] = $res;
	return $params;
}
