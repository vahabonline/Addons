<?php
function sendSms($vars){
    $soap=new SoapClient("http://yourdomain.ir/webservice/send.php?wsdl");
  	$soap->Username=$vars['UsernameOrApiKey'];
  	$soap->Password=$vars['PasswordOrSecretkey'];
  	$soap->fromNum=$vars['sendernumber'];
  	$soap->toNum=array($vars['mobile']);
  	$soap->Content = $vars['message'];
  	$soap->Type = '0';
  	$array = $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
  	return json_encode($array);
}

?>
