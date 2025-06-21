<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	
	$remarksForm = root_url("pages/loads/remarks_form.php");
	include($remarksForm);
?>