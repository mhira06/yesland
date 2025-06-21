<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$contactNumberList = $select->get_active_contact_numbers_list();
	$addressList = $select->get_active_address_list();
	$clientsForm = root_url("pages/loads/clients_form.php");
	include($clientsForm);
?>