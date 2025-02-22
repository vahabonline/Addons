<?php


function vo_sms_sending($params){
  $url ='https://api.limosms.com/api/sendpatternmessage';
  $post_data = json_encode(array(
  'OtpId' => $vars['otpid'],
  'ReplaceToken' => [$vars['sec_code']],
  'MobileNumber' => $vars['sec_usernumber']
  ));
  $process = curl_init();
  curl_setopt( $process,CURLOPT_URL,$url);
  curl_setopt( $process, CURLOPT_TIMEOUT,30);
  curl_setopt( $process, CURLOPT_POST, 1);
  curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt( $process, CURLOPT_POSTFIELDS, $post_data);
  curl_setopt( $process, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt( $process, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt( $process, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'ApiKey: ' . $vars['panel_password']
  ));
  $return = curl_exec( $process);
  $httpcode = curl_getinfo( $process, CURLINFO_HTTP_CODE);
  curl_close($process);
  return $return;
}
