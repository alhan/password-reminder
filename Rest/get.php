<?	
	include("../inc/isLogin.php");
	
	if( !isset($_REQUEST["name"]) ) die("error");
	else $name = $_REQUEST["name"];
	if( !isset($_REQUEST["id"]) ) die("error");
	else $id = $_REQUEST["id"];
	if( !isset($_REQUEST["col"]) ) $col = "both";
	else $col = $_REQUEST["col"];
	
	$content = file_get_contents($Path);
	$contentArr = explode("\r\n", $content);
	
	$itemStr = decrypt($contentArr[$id]);
	$itemArr = explode("|", $itemStr);
	
	if($itemArr[0]!=$name) die("error");
	
	switch($col){
		case "both": 
			$result = $itemArr[1]."|".$itemArr[2];
			break;
		case "username": 
			$result = $itemArr[1];
			break;
		case "password":
			$result = $itemArr[2];
			break;
		case "all":
			$result = '';
			$result .= '<div class="ui-controlgroup-controls list-edit-holder" oldsite="'.$itemArr[0].'" listid="'.$id.'">';
			$result .= '<div class="ui-input-text ui-body-inherit ui-corner-all ui-btn controlgroup-textinput list-add-input ui-shadow-inset ui-input-has-clear ui-first-child">';
			$result .= '<input type="text" data-clear-btn="true" name="list-edit-sitename" class="list-edit-sitename" data-wrapper-class="ui-btn controlgroup-textinput list-add-input" value="'.$itemArr[0].'" placeholder="Site Name">';
			$result .= '<a href="#" tabindex="-1" aria-hidden="true" class="ui-input-clear ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all ui-input-clear-hidden" title="Clear text">Clear text</a></div>';

			$result .= '<div class="ui-input-text ui-body-inherit ui-corner-all ui-btn controlgroup-textinput list-add-input ui-shadow-inset ui-input-has-clear">';
			$result .= '<input type="text" data-clear-btn="true" name="list-edit-username" class="list-edit-username" data-wrapper-class="ui-btn controlgroup-textinput list-add-input" value="'.$itemArr[1].'" placeholder="User Name">';
			$result .= '<a href="#" tabindex="-1" aria-hidden="true" class="ui-input-clear ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all ui-input-clear-hidden" title="Clear text">Clear text</a></div>';

			$result .= '<div class="ui-input-text ui-body-inherit ui-corner-all ui-btn ui-btn-inline controlgroup-textinput list-add-input ui-shadow-inset">';
			$result .= '<input type="text" data-clear-btn="false" name="list-edit-password" class="list-edit-password" data-wrapper-class="ui-btn ui-btn-inline controlgroup-textinput list-add-input" value="'.$itemArr[2].'" placeholder="Password"></div>';
			$result .= '<a href="#" id="list-edit-refresh" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline">refresh</a>';

			$result .= '<div class="ui-input-text ui-body-inherit ui-corner-all ui-btn controlgroup-textinput list-add-input ui-shadow-inset ui-input-has-clear">';
			$result .= '<input type="text" data-clear-btn="true" name="list-edit-link" class="list-edit-link" data-wrapper-class="ui-btn controlgroup-textinput list-add-input" value="'.$itemArr[3].'" placeholder="Link">';
			$result .= '<a href="#" tabindex="-1" aria-hidden="true" class="ui-input-clear ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all ui-input-clear-hidden" title="Clear text">Clear text</a></div>';

			$result .= '<textarea type="text" name="list-edit-info" class="list-edit-info" data-wrapper-class="ui-btn controlgroup-textarea list-add-input" value="" placeholder="Information" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-btn controlgroup-textarea list-add-input ui-textinput-autogrow" style="height: 51px;">';
			$result .= $itemArr[4].'</textarea>';
			$result .= '<button id="list-edit-button" class="ui-btn ui-shadow ui-corner-all ui-last-child">Güncelle</button></div>';
			break;
		default:
			$result = "error";
			break;
	}
	
	die($result);
?>
