<?php
	function sendSms($params){
		ini_set("soap.wsdl_cache_enabled", "0");
		try {
			$ApiKey = $params['UsernameOrApiKey'];
			$formnumber = $params['sendernumber'];
			$usernumber = $params['mobile'];
			$message = $params['message'];
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.kavenegar.com/v1/{$ApiKey}/sms/send.json?receptor={$usernumber}&sender={$formnumber}&message={$message}",
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
			return $response;
		} catch (SoapFault $ex) {
			$return = $ex->faultstring;
		}
		return $return;
	}

?>
