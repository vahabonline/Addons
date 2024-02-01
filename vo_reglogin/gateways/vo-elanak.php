<?php
function vo_sendSms($params){
    $username = $params['username'];
	$password = $params['password'];
	$from = $params['sendernumber'];
	$to[] = $params['usermobile'];
	$message = $params['message'];
	

	//call soap client
	$soap=new SoapClient("http://payammatni.com/webservice/send.php?wsdl");

	//SendSMS
	$soap->Username=$username;
	$soap->Password=$password;
	$soap->fromNum=$from;
	$soap->toNum=$to;
	$soap->Content = $message;
	$soap->Type = '0';

	$res = $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
	$params['status'] = false;
	if(strlen($res[0]) > 5){
	    $params['status'] = true;
	}
	$params['result'] = $res;
	return $params;
}
