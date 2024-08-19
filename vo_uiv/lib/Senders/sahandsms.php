<?php
	function sendSms($params){
		try {
      $toNumber = $params['mobile'];
      $url = 'http://www.sahandsms.com/NewWebService/newSMSWebService.asmx?wsdl';
      $client = new SoapClient($url);
      if(is_array($toNumber)){
          $to = $toNumber;
      }else{
          $to = array($toNumber);
      }
      $parameters['username'] = $params['UsernameOrApiKey'];
      $parameters['password'] = $params['PasswordOrSecretkey'];
      $parameters['message'] = $params['message'];
      $parameters['fromNumber'] = '+98'.$params['sendernumber'];
      $parameters['toNumbers'] = $to;
      $return_val = $client->SendQeue($parameters);
      return json_encode($return_val);
		} catch (SoapFault $ex) {
			return $ex->faultstring;
		}
	}

?>
