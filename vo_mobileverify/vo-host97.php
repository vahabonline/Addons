<?php
function vo_sendSms($params){
  $apiKey = $params['username'];
  if(empty($apiKey)){
    $apiKey = $params['password'];
  }
  $usermobiles = $params['usernumber'];
  $msg = $params['message'];
  $sender = $params['formnumber'];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_URL, 'http://sms.fou.ir/webservice/rest/sms_send?');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS,   'api_key='.$apiKey.'&receiver_number='.$usermobiles.'&note_arr[]='.$msg.'&sender_number='.$sender);
  $results2 = curl_exec($ch);
  $json = json_decode($results2);
  if($json->result == 'true'){
   return 'success';
  }
  return $results2;
}
