<?php
function vo_sendSms($params){
    $pAdmin['Username'] = $params['username'];
    $pAdmin['Password'] = $params['password'];
    $pAdmin['From'] = $params['formnumber'];
	return multipleSend($pAdmin,$params['usernumber'], $params['message']);
}


function request($params) {
    $qryStr = '';
    foreach ($params as $key => $value) {
        $qryStr .= '&' . $key . '=' . urlencode($value);
    }
    $qryStr = substr($qryStr, 1);
    $url = 'http://my.sabapayamak.com/API/sendSMS.ashx';
    $url .= '?' . $qryStr;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);

    $results = (!$data ? null : $data );

    return $results;
}

function multipleSend($pAdmin=array(),$to, $sms_content) {

    $phones = '';
    foreach ($to as $val) {
        $phones .= ',' . $val;
    }
    $phones = substr($phones, 1);

    $param = array(
        'username' => $pAdmin['Username'],
        'password' => $pAdmin['Password'],
        'to' => $phones,
        'from' => $pAdmin['From'],
        'text' => $sms_content
    );

    $res = request($param);

    return $res;
}
