<?php 
	function generateRandomString($length = 36) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
	
	function generateSessionId(){
	  return generateRandomString(36);
	}
	
	function isSessionIdValid($sessionId){
		$pattern = "/^[\da-zA-Z]{36}$/";
		$result = preg_match($pattern, $sessionId);
		if ($result == 0){
			return FALSE;
		}
		return TRUE;
	}

	function isRedirectionUrlValid($redirectionUrl){
		$pattern = "/^(http(s)?:\/\/)[\w.-]+(\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$/";
		$result = preg_match($pattern, $redirectionUrl);
		if ($result == 0){
			return FALSE;
		}
		return TRUE;
	}
?>