<?php
function vo_sendSms($params){
    $username = $params['username'];
	$password = $params['password'];
	$from = $params['sendernumber'];
	$to[] = $params['usermobile'];
	$message = $params['message'];
	

	ini_set("soap.wsdl_cache_enabled",0);
	$sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
	$data = array(
		"username"	=>	$username,
		"password"	=>	$password,
		"to"	=>	$to,
		"from"	=>	$from,
		"text"	=>	$message,
		"isflash"	=>	false
	);
	$res = $sms->SendSimpleSMS($data)->SendSimpleSMSResult;

	$params['status'] = false;
	if(!empty($res) || is_null($res)){
        	$params['status'] = true;
    	}
    	$params['result'] = $res;
	return $params;
}
