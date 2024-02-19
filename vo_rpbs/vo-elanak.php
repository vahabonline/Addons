<?php
function sms_sending($var){
    $soap=new SoapClient("http://yourdomain.ir/webservice/send.php?wsdl");
  	$soap->Username=$vars['username'];
  	$soap->Password=$vars['password'];
  	$soap->fromNum=$vars['form'];
  	$soap->toNum=$vars['to'];
  	$soap->Content = $vars['msg'];
  	$soap->Type = '0';
  	$array = $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
  	return json_encode($array);
}
