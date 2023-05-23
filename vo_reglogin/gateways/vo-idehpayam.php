<?php
function vo_sendSms($params){
    $username = $params['username'];
	$password = $params['password'];
	$sendernumber = $params['sendernumber'];
	$usermobile = $params['usermobile'];
	$message = $params['message'];
	
	$curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://185.112.33.62/api/v1/rest/sms/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "from": "'.$sendernumber.'",
        "recipients": [
            "'.$usermobile.'"
        ],
        "message": "'.$message.'",
        "type": 0
    }',
      CURLOPT_HTTPHEADER => array(
        'username: '.$username,
        'password: '.$password,
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
	$res = json_decode($response);
	$params['status'] = false;
	if($res->status == '200'){
		if($res->result->status == '0'){
			$params['status'] = true;
		}
	    }
	    $params['result'] = $response;
	    return $params;

}
