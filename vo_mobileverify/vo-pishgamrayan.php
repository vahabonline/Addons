<?php
function vo_sendSms($params){
    $messageBodies[] = $params['message'];
    $recipientNumbers[] = $params['usernumber'];
    $userTag = 'verify module';
    $senderNumbers[] = $params['formnumber'];
    $token = $params['username'];
  	if(empty($token)){
  		$token = $params['password'];
  	}
    $url = "https://api.pishgamrayan.com/sendP2P";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Authorization:' . $token,
        'Content-Type: application/json'
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $request = [
        'messageBodies' => $messageBodies,
        'recipientNumbers' => $recipientNumbers,
        'userTag' => $userTag,
        'senderNumbers' => $senderNumbers
    ];
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));
    $response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    $statusReturnType = [
        401 => "خطا احرازهویت",
        402 => "حساب کاربری غیرفعال",
        406 => "ورودی نامعتبر",
        423 => "توکن غیرفعال",
        428 => "آی پی نامعتبر",
        429 => "تعداد ارسال در واحد زمانی بیشتر از حد مجاز است",
        500 => "خطای ناشناخته"
    ];

    if ($status == 200) {
        return 'success';
    }
    $result = $statusReturnType[$status] ?? ($status == 400 ? json_decode($response)->message : false);
    return $result;
}
