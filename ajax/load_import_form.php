<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$membersCondition = "ut.users_type_id = '2'";
	$membersList = $select->get_active_users_list("", $membersCondition);
	$importForm = root_url("pages/loads/import_form.php");
	include($importForm);
?>