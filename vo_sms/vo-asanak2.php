<?php
function info_asanak()
{
    return array(
        "name" => "Asanak",
        "username_label" => "نام کاربری",
        "password_label" => "رمز عبور",
        "sendernumber_label" => "شماره ارسال کننده",
        "pattern_label" => 'شماره پترن',
        "pattern" => false,
    );
}

function status_asanak($user='', $pass='', $sender='')
{
    if ($user && $pass && $sender) {
        return true;
    } else {
        return false;
    }
}

function balance_asanak($user='', $pass='', $sender='')
{
    return false;
}

function sending_default_asanak($user, $pass, $from, $to, $message)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sms.asanak.ir/webservice/v2rest/msgstatus",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array(
            'username' => $user,
            'password' => $pass,
            'Source' => $from,
            'Message' => $message,
            'destination' => $to
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function sending_pattern_asanak($username, $password, $fromNum, $to, $pattern_code, $msg)
{
    return false;
}
