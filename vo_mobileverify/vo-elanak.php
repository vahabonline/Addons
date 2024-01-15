<?php
function vo_sendSms($params){
	$username = $params['username'];
	$password = $params['password'];
	$formnumber = $params['formnumber'];
	$message = $params['message'];
	$usernumber = $params['usernumber'];
	date_default_timezone_set('Asia/tehran');
    $soap=new SoapClient("http://yourdomain.ir/webservice/send.php?wsdl");
    $soap->Username=$username;
	$soap->Password=$password;
	$soap->fromNum=$formnumber;
	$soap->toNum=[$usernumber];
	$soap->Content = $message;
	$soap->Type = '0';
	$array = $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
	if(strlen($array[0]) > 10){
		return 'success';
	}
	return $array[0];
}