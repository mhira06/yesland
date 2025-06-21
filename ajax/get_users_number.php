<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$response = array();
	$selectedUserType = $function->get("users_type");
	/*$sqlFields = "u.users_number, ut.users_type_desc";
	
	$sqlCondition = "ut.users_type_id = '".$selectedUserType."'";
	
	$sqlOrder = "u.date_added desc";
	$usersDetails = $select->get_active_user_main_details($sqlFields, $sqlCondition, $sqlOrder, "1");
	
	$totalCount = isset($usersDetails["users_number"]) ? $usersDetails["users_number"] : 0;
	$userTypeDesc = isset($usersDetails["users_type_desc"]) ? $usersDetails["users_type_desc"] : "";
	if($userTypeDesc == ""){
		$userTypeDetails = $select->get_user_type($selectedUserType);
		$userTypeDesc = $userTypeDetails["users_type_desc"];
	}
	$usersTypeCode = substr($userTypeDesc, 0, 1);
	$number = $totalCount + 1;
	$display = sprintf("%05d", $number);
	$usersNumberDisplay = $usersTypeCode."YLR-".$display;
	$response = array(
		"display" => $usersNumberDisplay, 
		"value" => $number
	);*/
	$response = $function->get_users_number($selectedUserType);
	echo json_encode($response);
?>