<?php
function vo_sendSms($params){
	$apikey = $params['token'];
	$smsnumber= $params['sendernumber'];;
	$mobile = $params['usermobile'];
	$txt = $params['message'];
	try 
	{
		$url  = 'http://sms.parsgreen.ir/UrlService/sendSMS.ashx?from=' . $smsnumber . '&to=' . $mobile .'&text=' . urlencode($txt) . '&signature=' . $apikey;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$res = curl_exec($ch);
		curl_close($ch);
		$result = explode(";",$res);
		$usermobile = $result[0];
		$status = $result[1];
		$rescode = $result[2];
		if($status == '0'){
		    return true;
		}
		return $res;
	}
	catch (SoapFault $ex) 
	{
		return $ex->faultstring;  
	}
}
