<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedUserType = $function->get("users_type");
	$selectedUserStatus = "";
	$selectedPosition = "";
	$selectedDateHired = "";
	$selectedRateType = "";
	$selectedRateValue = "";
	$usersCompanyDetails = root_url("pages/loads/users_company_details.php");
	include($usersCompanyDetails);
?>