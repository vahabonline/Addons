<?php
function vo_sendSms($params){
    /*
        username
        password
        formnumber
        message
        usernumber
    */
    ini_set("soap.wsdl_cache_enabled", "0");
	try {
	$client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));
		$parameters['username'] = $params['username'];
		$parameters['password'] = $params['password'];
		$parameters['from'] = $params['formnumber'];
		$parameters['to'] = array($params['usernumber']);
		$parameters['text'] = $params['message'];
		$parameters['isflash'] = true;
		$parameters['udh'] = "";
		$parameters['recId'] = array(0);
		$parameters['status'] = 0x0;
		$status = $client->SendSms($parameters)->SendSmsResult;
    if($status == '1'){
      return 'success'; 
    }
	 } catch (SoapFault $ex) {
		$status = $ex->faultstring;
	}
	return $status;
}
