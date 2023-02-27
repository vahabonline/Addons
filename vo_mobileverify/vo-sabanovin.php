<?php

vo_sendSms($params){
  $apikey = $params['username'];
  if(empty()){
    $apikey = $params['password'];
  }
  $from = $params['formnumber'];
  $to = $params['usernumber'];
  $msg = $params['message'];
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.sabanovin.com/v1/{$apikey}/sms/send.json?gateway={$from}&to={$to}&text={$msg}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $res = json_decode($response);
  if($res['status']['code'] == 200){
    return 'success';
  }else{
    return $response;
  }
}
