<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://niksms.com/fa/publicapi/ptpSms?username=YourUsername&password=YourPassword&senderNumber=**********&numbers=**********%2C***********&sendOn=2018%2F01%2F04-10%3A00&sendType=1&yourMessageIds=1001%2C1002&message=Here%20You%20Should%20Put%20Your%20First%20Message%20Text%2C%20Here%20You%20should%20put%20your%20second%20message%20text',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
