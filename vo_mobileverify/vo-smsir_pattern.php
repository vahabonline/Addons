<?php
function vo_sendSms($params){
    try {
        
        $jsonString = html_entity_decode(htmlspecialchars_decode($params['message']));
        $json = json_decode($jsonString);
        $codename = $json->codename;
        $pattern_code = $json->patterncode;
        $actcode = $json->activecode;
        $usermob = $params['usernumber'];
        $APIKey = $params['username'];
        $SecretKey = $params['password'];
          
        $curl = curl_init();
        $params = [
            'mobile' => $params['usernumber'],
            'templateId' => $pattern_code,
            'parameters' => [
                [
                    'name' => $codename,
                    'value' => $actcode
                ]
            ]
        ];
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sms.ir/v1/send/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Accept: text/plain',
              'x-api-key: ' . $SecretKey
            ),
          ));
    
          $response = curl_exec($curl);
    
          curl_close($curl);
          return $response;
            return 'success';
    }catch(Exception $e) {
      return 'Message: ' .$e->getMessage();
    }
}
