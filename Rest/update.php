<?
	include("../inc/isLogin.php");

	if( !isset($_POST["id"]) || !isset($_POST["oldsite"]) || !isset($_POST["site"]) || !isset($_POST["user"]) || 
		!isset($_POST["pass"]) || !isset($_POST["link"]) || !isset($_POST["info"]) ) die("error");
	$id = $_POST["id"];
	$oldsite = $_POST["oldsite"];
	$site = $_POST["site"];
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$link = $_POST["link"];
	$info = $_POST["info"];
	
	$content = file_get_contents($Path);
	$contentArr = explode("\r\n", $content);
	
	$itemStr = decrypt($contentArr[$id]);
	$itemArr = explode("|", $itemStr);
	
	
	if($itemArr[0]==$oldsite){
		
		$contentStr = $site."|".$user."|".$pass."|".$link."|".$info;
		$contentResult = "\r\n".encrypt($contentStr);
		
		$contentArr2 = explode("\r\n".$contentArr[$id], $content);
		$newContent = implode($contentResult, $contentArr2);
		file_put_contents($Path, $newContent);
		die("ok");
	} else {
		die("error");
	}
?>