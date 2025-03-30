<?php
function vo_sendSms($params){
    $input_data = json_decode($msg);
    $otpMsg = json_decode($params['message']);
    $otpBody = $otpMsg->otpbody;
    $otpID = $otpMsg->otpid;
    $username = $params['username'];
    $password = $params['password'];
    $from = $params['sendernumber'];
    
    $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
    $data = array(
        "username"=> $username,
        "password"=> $password,
        "text"=>array($otpBody->otp),
        "to"=> $params['usermobile'],
        "bodyId"=> $otpID
    );
    $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;
    $params['status'] = false;
  	if(strlen($send_Result->string) > 5){
  	    $params['status'] = true;
  	}
    $params['result'] = $send_Result;
    return $params;
}
