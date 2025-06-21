<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedItemsColor = $function->get("items_colors");
	$itemsCondition = "ico.items_colors_id = '".$selectedItemsColor."'";
	$itemsDetails = $select->get_active_items_display_details($itemsCondition);
	$image = $itemsDetails["image"] == "" ? "assets/images/items/not_available.jpg" : $itemsDetails["image"];
	$imagePath = $image != "" ? base_url($image) : "";
	$response = array(
		"items_image" => $imagePath
	);
	
	echo json_encode($response);
?>