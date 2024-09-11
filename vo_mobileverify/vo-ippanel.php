<?php
function vo_sendSms($params){
    $url = "https://ippanel.com/services.jspd";
    $param = array(
        'uname'=>$params['username'],
        'pass'=>$params['password'],
        'from'=>$params['formnumber'],
        'message'=>$params['message'],
        'to'=>json_encode(array($params['usernumber'])),
        'op'=>'send'
    );
    $handler = curl_init($url);
    curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
    curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($handler);
    $response = json_decode($result);
    $res_code = $response[0];
    return $result;
}
