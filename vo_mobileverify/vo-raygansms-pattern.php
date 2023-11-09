<?php

function vo_sendSms($params){
    try {
        $Url="http://smspanel.Trez.ir/SendMessageWithCode.ashx";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$Url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
        http_build_query(
          array(
            'Username' => $params['usernumber'],
            'Password  $params['password'],
            'Mobile' => $params['usernumber'],
            'Message' => $params['message']
          )));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        return 'success';
    }catch(Exception $e) {
      return 'Message: ' .$e->getMessage();
    }


        
}

?> 
