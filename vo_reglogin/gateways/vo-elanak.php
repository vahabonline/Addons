<?php
function vo_sendSms($params){
    $username = $params['username'];
	$password = $params['password'];
	$from = $params['sendernumber'];
	$to[] = $params['usermobile'];
	$message = $params['message'];
	

	//call soap client
	$soap=new SoapClient("http://yourdomain.ir/webservice/send.php?wsdl");

	//SendSMS
	$soap->Username=$username;
	$soap->Password=$password;
	$soap->fromNum=$from;
	$soap->toNum=$to;
	$soap->Content = $message;
	$soap->Type = '0';

	return $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
}
