<?php


function vo_sms_sending($vars){
	  $username = $vars['panel_username'];
    $password = $vars['panel_password'];
    $apikey = $vars['panel_password'];
    $sendernumber = $vars['panel_sendernumber'];
    $phonenumber = $vars['sec_usernumber'];
    $message = $vars['msgtxt'];
    $now = date('Y/m/d-H:i:s');

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://niksms.com/fa/publicapi/ptpSms?username={$username}&password={$password}&senderNumber={$sendernumber}&numbers={$phonenumber}&sendType=1&message=".urlencode($message),
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
    $res = json_decode($response,true);
    if($res['status'] == 0){
      return 'success';
    }
    return $response;
  

}


