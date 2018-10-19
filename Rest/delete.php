<?
	include("../inc/isLogin.php");
	
	if( !isset($_POST["name"]) ) die("error");
	else $name = $_POST["name"];
	if( !isset($_POST["id"]) ) die("error");
	else $id = $_POST["id"];
	
	$content = file_get_contents($Path);
	$contentArr = explode("\r\n", $content);
	
	$itemStr = decrypt($contentArr[$id]);
	$itemArr = explode("|", $itemStr);
	
	if($itemArr[0]==$name){
		$contentArr2 = explode("\r\n".$contentArr[$id], $content);
		$newContent = implode("", $contentArr2);
		file_put_contents($Path, $newContent);
		die("ok");
	} else {
		die("error");
	}
	
?>
