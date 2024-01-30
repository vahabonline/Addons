<?php

function vo_sms_sending($vars){
    $soap=new SoapClient("http://yourdomain.ir/webservice/send.php?wsdl");
  	$soap->Username=$vars['panel_username'];
  	$soap->Password=$vars['panel_password'];
  	$soap->fromNum=$vars['panel_sendernumber'];
  	$soap->toNum=array($vars['sec_usernumber']);
  	$soap->Content = $vars['msgtxt'];
  	$soap->Type = '0';
  	$array = $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
  	return json_encode($array);
}
