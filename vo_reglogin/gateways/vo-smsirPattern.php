<?php
function vo_sendSms($params){
	try{
		$input_data = json_decode($msg);
    $otpMsg = json_decode($params['message']);
    $usrMobile = $params['usermobile'];
    $otpBody[] = $otpMsg->otpbody;
    $post = [
    	'mobile' => $usrMobile,
    	'templateId' => $otpMsg->otpid,
    	'parameters' => $otpBody
    ]
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sms.ir/v1/send/verify',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($post),
    CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Accept: text/plain',
              'x-api-key: ' . $params['token']
            ),
          ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response,true);
    $params['status'] = false;
    if($res['status'] == '1'){
    	$params['status'] = true;
    }
    $params['result'] = $res;
    return $params;
	}catch (Exception $e){
		return $e->message;
	}
}
