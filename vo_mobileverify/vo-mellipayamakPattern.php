<?php
function vo_sendSms($params){
	ini_set("soap.wsdl_cache_enabled", "0");
	$sms_client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));

    $json = html_entity_decode($params['message']);
    $json = json_decode($json);
    $codename = $json->codename;
	$pattern_code = $json->patterncode;
	$actcode = $json->activecode;
	$usermob = $params['usernumber'];
	

    
    $parameters['username'] = $params['username'];
	$parameters['password'] = $params['password'];
	$parameters['to'] = $usermob;
	$parameters['bodyId'] = $pattern_code;
	$parameters['text'] = $actcode;
    
    $res = $sms_client->SendByBaseNumber2($parameters)->SendByBaseNumber2Result;
    
    if(strlen($res) > 5){
        return 'success';
    }else{
        return $res;
    }
}