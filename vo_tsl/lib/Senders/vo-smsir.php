<?php
function vo_tsl_smsir_req($params, $apiKey){
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
	CURLOPT_POSTFIELDS => json_encode($params),
	CURLOPT_HTTPHEADER => array(
		  'Content-Type: application/json',
		  'Accept: text/plain',
		  'x-api-key: ' . $apiKey
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}


function vo_tsl_send_default($vars){
	$params['lineNumber'] = $vars['panel_sendernumber'];
	$params['messageText'] = str_replace('{code}',$vars['sec_code'],$vars['msgtxt']);
	$params['mobiles'][] = $vars['sec_usernumber'];
	$params['sendDateTime'] = null;
	return vo_tsl_smsir_req($params, $vars['panel_password']);
}
function vo_tsl_send_otp($vars){
    $params['mobile'] = $vars['sec_usernumber'];
    $params['templateId'] = '746294';
    $params['parameters'][] = ['name' => 'code', 'value' => $vars['sec_code']];
	return vo_tsl_smsir_req($params, $vars['panel_password']);
}