<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedDocumentRequest = $function->get("documents_request_id");
	$documentRequestHistoryList = $select->get_documents_request_history($selectedDocumentRequest);
	$documentsRequestHistory = root_url("pages/loads/documents_request_history.php");
	include($documentsRequestHistory);
?>