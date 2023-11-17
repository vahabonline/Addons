<?php

function vo__R_send($apikey,$to,$from,$msg){
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
      "lineNumber": '.$from.',
      "messageText": '.$msg.',
      "mobiles": '.json_encode($to).',
      "sendDateTime": null
  }',
    CURLOPT_HTTPHEADER => array(
      'X-API-KEY: ' . $apikey,
      'Content-Type: application/json'
    ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
}

function vo__R_ptrn($apikey,$json){
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
    CURLOPT_POSTFIELDS => $json,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Accept: text/plain',
      'x-api-key: ' . $apikey
    ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
}

// اطلاعات ارسال کننده
function info_new_smsirnew(){
    return array(
        "name" => "NEW SMS.IR",
        "username_label" => "API-KEY",
        "password_label" => false,
		"sendernumber_label" => "شماره ارسال کننده",
		"pattern_label" => true,
        "pattern" => true,
    );
}

// وضعیت اتصال
function status_new_smsirnew($xapikey,$APIKey,$sender){
	return true;
}

// نمایش اعتبار پنل
function balance_new_smsirnew($xapikey,$APIKey,$sender){
	return false;
}

// ارسال عادی
function sending_default_new_smsirnew($xapikey,$APIKey,$from,$to,$txt){
	$req = vo__R_send($xapikey,$to,$from,$txt);
	return json_encode($req);
}

// ارسال به صورت پترن
function sending_pattern_new_smsirnew($xapikey,$APIKey,$sender,$to,$pattern_code,$msg){
	$patternss = json_decode($msg,true);
	$json = "{";
	$json .= '"mobile": "'.$to.'",';
	$json .= '"templateId": '.$pattern_code.',';
	$json .= '"parameters": [';
	foreach($patternss as $name => $value){
		$json .= '{';
		$json .= '"name": "'.$name.'",';
		$json .= '"value": "'.$value.'"';
		$json .= '},';
	}
	$json .= ']';
	$json .= '}';
	$req = vo__R_ptrn($xapikey,$json);
	return json_encode($req);
}
