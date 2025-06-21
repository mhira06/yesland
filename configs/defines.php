<?php
	define("PROJECT", "ylr_portal");
	$session = isset($_SESSION[PROJECT]) ? $_SESSION[PROJECT] : array();
	$sessionUser = isset($session["user"]) ? $session["user"] : array();
	$userId = isset($sessionUser["id"]) ? $sessionUser["id"] : "";
	$employeeNumber = isset($sessionUser["number"]) ? $sessionUser["number"] : "";
	$employeeNumberDisplay = isset($sessionUser["number_display"]) ? $sessionUser["number_display"] : "";
	$fullName = isset($sessionUser["full_name"]) ? $sessionUser["full_name"] : "";
	$profilePicture = isset($sessionUser["profile_picture"]) ? $sessionUser["profile_picture"] : "";
	$loginType = isset($sessionUser["login_type"]) ? $sessionUser["login_type"] : "";
	$userType = isset($sessionUser["user_type"]) ? $sessionUser["user_type"] : "";
	$loggedId = isset($sessionUser["logged_id"]) ? $sessionUser["logged_id"] : "";
	if($profilePicture == ""){
		$profilePicture = "assets/images/display/avatar4.png";
	}
	define("ID", $userId);
	define("EMPLOYEE_NUMBER", $employeeNumber);
	define("EMPLOYEE_NUMBER_DISPLAY", $employeeNumberDisplay);
	define("FULL_NAME", $fullName);
	define("PROFILE_PICTURE", $profilePicture);
	define("LOGGED_IN", $loggedId);
	//echo "Hello World";
	//exit;
?>