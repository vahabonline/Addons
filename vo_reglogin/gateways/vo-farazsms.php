function vo_sendSms($params){
    $username = $params['username'];
	$password = $params['password'];
	$from = $params['sendernumber'];
	$to[] = $params['usermobile'];
	$message = $params['message'];
	

	ini_set("soap.wsdl_cache_enabled",0);
	$soap=new SoapClient("http://yourdomain.ir/webservice/send.php?wsdl");
	$soap->Username=username;
  $soap->Password=$password;
  $soap->fromNum=$from;
  $soap->toNum=$to;
  $soap->Content = $message;
  $soap->Type = '0';
  

  $res = $soap->SendSMS($soap->fromNum,$soap->toNum,$soap->Content,$soap->Type,$soap->Username,$soap->Password);
	if(!empty($res) || is_null($res)){
        	$params['status'] = true;
    	}
    	$params['result'] = $res;
	return $params;
}
