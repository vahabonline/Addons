<?php
function vo_sendSms($params){
	try{
		$data['lineNumber'] = $params['sendernumber'];
		$data['messageText'] = $params['message'];
		$data['mobiles'] = [$params['usermobile']];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.sms.ir/v1/send/bulk',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'ACCEPT: application/json',
				'X-API-KEY: ' . $params['token'],
				'Content-Type: application/json'
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
