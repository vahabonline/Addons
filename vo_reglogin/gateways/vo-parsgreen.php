<?php
function vo_sendSms($params){
	$webServiceURL  = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
	$webServiceSignature = $params['token'];
	$webServicetoMobile   = $params['usermobile'];
	mb_internal_encoding("utf-8");
	 $textMessage=$params['message'];
	 $textMessage= mb_convert_encoding($textMessage,"UTF-8");
		 $parameters['signature'] = $webServiceSignature;
		 $parameters['toMobile' ]= $webServicetoMobile;
		 $parameters['msgbody' ]=$textMessage;
		 $parameters[ 'retStr'] = "";
	try 
	{
		$con = new SoapClient($webServiceURL);  
		$responseSTD = (array) $con ->Send($parameters); 
		return true;
	}
	catch (SoapFault $ex) 
	{
		return $ex->faultstring;  
	}
}