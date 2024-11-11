<?php
function SendMsg($params){
    ini_set("soap.wsdl_cache_enabled", "0");
	$numbersend[] = $params['mobile'];
	try {
	$client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));
		$parameters['username'] = $params['username'];
		$parameters['password'] = $params['password'];
		$parameters['from'] = $params['sendNumber'];
		$parameters['to'] = $params['mobile'];
		$parameters['text'] = str_replace('{code}',$params['smsCode'],$params['message']);
		$parameters['isflash'] = false;
		$parameters['udh'] = "";
		$parameters['recId'] = array(0);
		$parameters['status'] = 0x0;
		$status = $client->SendSms($parameters)->SendSmsResult;
	} catch (SoapFault $ex) {
		$status = $ex->faultstring;
	}
	if($status == '1'){
		$status = 'success';
	}
	return $status;
}
