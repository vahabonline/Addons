<?php
function vo_sendSms($params) {
    try {
        $input_data = json_decode($msg);
		$otpMsg = json_decode($params['message']);
		$otpBody = $otpMsg->otpbody;
		$otpID = $otpMsg->otpid;
		$username = $params['username'];
		$password = $params['password'];
		$from = $params['sendernumber'];
		$usermobile[] = $params['usermobile'];
        $client = new SoapClient("https://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
        $res = $client->sendPatternSms($from, $usermobile, $username, $password, $otpID, $otpBody);
        if (empty($res) || is_null($res)) {
			$params['status'] = false;
			$params['result'] = 'پاسخی از سرور دریافت نشد';
        }else{
			$params['status'] = true;
			$params['result'] = $res;
		}
    } catch (SoapFault $e) {
        $params['status'] = false;
        $params['result'] = "خطای SOAP: " . $e->getMessage();
    } catch (Exception $e) {
        $params['status'] = false;
        $params['result'] = "خطا: " . $e->getMessage();
    }
    return $params;
}
