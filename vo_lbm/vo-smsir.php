<?php
function vo_sms_sending($params){
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
        CURLOPT_POSTFIELDS =>'{
          "lineNumber": '.$vars['panel_sendernumber'].',
          "messageText": "'.$vars['msgtxt'].'",
          "mobiles": [
              "'.$vars['sec_usernumber'].'"
          ],
          "sendDateTime": null
      }',
        CURLOPT_HTTPHEADER => array(
          'X-API-KEY: ' . $vars['panel_password'],
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;
}
