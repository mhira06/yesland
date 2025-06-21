<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$alert = "";
	$message = 'true';
	$oldPassword = $function->post("txt_old_password");
	if($oldPassword == ""){
		$alert = "error";
	}
	if($alert == ""){
		$userDetails = $select->users_login(EMPLOYEE_NUMBER_DISPLAY, $oldPassword);
		if(empty($userDetails)){
			$alert = "error";
		}
	}
	
	if($alert != ""){
		$message = 'No Found User';
	}
	echo json_encode($message);
	
?>