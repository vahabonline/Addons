<?php

    function vo_sendSms($params){
        $apikey = $params['username'];
        $secKey = $params['password'];
        $from = $params['formnumber'];
        $to[] = $params['usernumber'];
        $msg[] = $params['message'];
        return VO__P_sendMessage($apikey,$secKey,$from,$to,$msg);
    }

    function VO__P_sendMessage($apiKey,$secKey,$fromNumber,$MobileNumbers, $Messages, $SendDateTime = '')
    {
        $token = VO__P_getToken($apiKey, $secKey);
        $APIURL = "https://ws.sms.ir/";
        if ($token != false) {
            $postData = array(
                'Messages' => $Messages,
                'MobileNumbers' => $MobileNumbers,
                'LineNumber' => $fromNumber,
                'SendDateTime' => $SendDateTime,
                'CanContinueInCaseOfError' => 'false'
            );

            $url = $APIURL."api/MessageSend";
            $SendMessage = VO__P_execute($postData, $url, $token);
            $object = json_decode($SendMessage);

            $result = false;
            if (is_object($object)) {
                $result = $object->IsSuccessful;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
		
		if($result == true){
			return 'success';
		}
        return $result;
    }


    function VO__P_getToken($apiKey,$SecretKey)
    {
        $APIURL = "https://ws.sms.ir/";
        $postData = array(
            'UserApiKey' => $apiKey,
            'SecretKey' => $SecretKey,
            'System' => 'php_rest_v_2_0'
        );
        $postString = json_encode($postData);

        $ch = curl_init($APIURL."api/Token");
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(

                'Content-Type: application/json'
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result);

        $resp = false;
        $IsSuccessful = '';
        $TokenKey = '';
        if (is_object($response)) {
            $IsSuccessful = $response->IsSuccessful;
            if ($IsSuccessful == true) {
                $TokenKey = $response->TokenKey;
                $resp = $TokenKey;
            } else {
                $resp = false;
            }
        }
        return $resp;
    }



    function VO__P_execute($postData, $url, $token)
    {

        $postString = json_encode($postData);

        $ch = curl_init($url);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'x-sms-ir-secure-token: '.$token
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }




?>
