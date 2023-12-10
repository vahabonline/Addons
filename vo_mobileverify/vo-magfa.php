<?php
vo_sendSms($params){
	$url = 'https://sms.magfa.com/api/soap/sms/v1/server?wsdl';
	$options = [
		'login' => $params['username'], 'password' => $params['password'], // -Credientials
		'cache_wsdl' => WSDL_CACHE_NONE, // -No WSDL Cache
		'trace' => false // -Optional (debug)
	];
	$client = new SoapClient( $url, $options);
	$result = $client->send(
		'magfa',
		[$params['message']],
		[$params['usernumber']],
		[$params['formnumber']],
		[],
		[],
		[],
		[]
		[1989812],
	);
	return $result;
}
