<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	
	$selectedSize = $function->post("size");
	$selectedItemCount = $function->post("item_count");
	$selectedItemColor = $function->post("item_color");
	$selectedSizeList = $select->generate->array_to_in($selectedSize);
	$sizeCondition = "sizes_id in ('".$selectedSizeList."')";
	$sizeList = $select->get_active_sizes_list("", $sizeCondition);
	$itemsStockInputs = root_url("pages/loads/items_stock_input.php");
	include($itemsStockInputs);
?>