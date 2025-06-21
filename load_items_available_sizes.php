<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedItemsColor = $function->get("items_colors");
	$itemsCondition = "ico.items_colors_id = '".$selectedItemsColor."'";
	$itemsDetails = $select->get_active_items_display_details($itemsCondition);
	$availableSizes = $itemsDetails["sizes_value_list"];
	$availableItemsSize = root_url("pages/loads/available_items_sizes.php");
	include($availableItemsSize);
?>