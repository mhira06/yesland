<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	
	$selectedItemCount = $function->get("item_count");
	$itemsColorCount = $selectedItemCount;
	$selectedColor = "";
	$selectedImage = "";
	$selectedSize = array();
	$itemStockList = array();
	$colorList = $select->get_active_colors_list();
	$sizesList = $select->get_active_sizes_list();
	
	$itemsColorInput = root_url("pages/loads/load_items_color.php");
	include($itemsColorInput);
?>