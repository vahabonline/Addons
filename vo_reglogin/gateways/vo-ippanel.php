<?php
function vo_sendSms($params){
	$url = "https://ippanel.com/services.jspd";
	$usermobile = [$params['usermobile']];
	$param = array(
		'uname'=>$params['username'],
		'pass'=>$params['password'],
		'from'=>$params['sendernumber'],
		'message'=>$params['message'],
		'to'=>json_encode($usermobile),
		'op'=>'send'
	);
	$handler = curl_init($url);             
	curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                       
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($handler);
    $res = json_decode($result);
    $params['status'] = false;
    if($res[0] == '0'){
        $params['status'] = true;
    }
    $params['result'] = $result;
    return $params;
}