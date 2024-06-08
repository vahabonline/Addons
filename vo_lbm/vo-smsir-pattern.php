<?php
function vo_sms_sending($vars){
      $curl = curl_init();
    $params = [
        'mobile' => $vars['sec_usernumber'],
        'templateId' => $vars['otpid'],
        'parameters' => [
            [
                'name' => 'code',
                'value' => $vars['sec_code']
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
          'x-api-key: ' . $vars['panel_password']
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;
}
