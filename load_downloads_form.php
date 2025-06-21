<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	
	$downloadList = array(
		"default" => "Default", 
		"search" => "Searched"
	);
	$downloadFileType = array(
		"excel" => "Excel", 
		"pdf" => "PDF"
	);
	$downloadForm = root_url("pages/loads/download_form.php");
	include($downloadForm);
?>