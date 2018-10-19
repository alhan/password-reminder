<?	
	if (isset($_COOKIE['Token'])) {
		unset($_COOKIE['Token']);
		setcookie('Token', '', time() - 3600, '/pssrmndr/'); 
	}
?>