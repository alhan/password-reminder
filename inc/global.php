<?
	require_once 'keys.php';
	
	function generatekey($length)	{
		$options = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.,:;)(%+-_*?=!é<>[]{}";
		$code = "";
		for($i = 0; $i < $length; $i++){
			$key = rand(0, strlen($options) - 1);
			$code .= $options[$key];
		}
		return $code;
	}
	
	function getMD5($str){
		$md5 = explode('$',crypt($str, ENCRYPTION_KEY_MD5) ); 
		$cleanA = explode("/", end($md5));
		$clean = implode("", $cleanA);
		return $clean;
	}
	
	function encrypt($str){
		global $UserKey;
		$result = openssl_encrypt($str, 'BF-ECB', $UserKey);
		return $result;
	}
	function decrypt($str){
		global $UserKey;
		$result = openssl_decrypt($str, 'BF-ECB', $UserKey);
		return $result;
	}
	
?>