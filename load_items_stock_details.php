<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$response = array();
	
	$selectedItemsSize = $function->get("items_size");
	$itemsCondition = "isi.items_size_id = '".$selectedItemsSize."'";
	$itemsDetails = $select->get_active_items_display_details($itemsCondition);
	$itemsPrice = $itemsDetails["price"];
	$stock = $itemsDetails["available_stock"];
	$response = array(
		"price" => $itemsPrice, 
		"stock" => $stock
	);
	
	echo json_encode($response);
?>