<?php
function sms_sending($var){
    $data=array(
        'username' => $var['username'], 
        'password'=> $var['password'], 
        'to' => $var['to'], 
        'from' => $var['form'], 
        "text" => $var['msg']
    );
    $post_data = http_build_query($data);
    $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/SendSMS');
    curl_setopt($handle, CURLOPT_HTTPHEADER, array(
        'content-type' => 'application/x-www-form-urlencoded'
    ));
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($handle);
    $res = json_decode($response, true);
    
    if($res['StrRetStatus'] == 'Ok'){
        $status = 'ارسال شده';
    }else{
        $status = $res;
    }
    return $status;
}
