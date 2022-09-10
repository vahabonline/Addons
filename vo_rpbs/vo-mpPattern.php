<?php
function sms_sending($var){
	$username = $var['username'];
	$password = $var['password'];
	$from = $var['form'];
	$to = array($var['to']);
	$client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));
    $parameters['username'] = $username;
	$parameters['password'] = $password;
	$parameters['to'] = $var['to'];
	
	//ارسال پیام اول
	if(!empty($var['code']) && !empty($var['hash'])){
		//در این پیامک باید دو متغییر تعریف شده باشد
		$parameters['text'] = array(
			$var['code'],
			$var['hash']
		);
		$parameters['bodyId'] = "InputPatternID";//آیدی پترن را وارد نمایید
	}
	// ارسال پیام دوم
	if(!empty($var['pass'])){
		// در این پیامک باید یک متغییر تعریف شده باشد.
		$parameters['text'] = array($var['pass']);
		$parameters['bodyId'] = "InputPatternID";//آیدی پترن را وارد نمایید
	}
	$result = $client->SendByBaseNumber($parameters)->SendByBaseNumberResult;
	return $result;
}