<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	
	$selectedItemSizeId = $function->get("items_size_id");
	$itemsStockCondition = "isi.items_size_id = '".$selectedItemSizeId."'";
	$itemsStockDetails = $select->get_active_items_stock_details("", $itemsStockCondition);
	$itemsTypeDesc = $itemsStockDetails["items_type_desc"];
	$itemsName = $itemsStockDetails["items_desc"];
	$itemsColor = $itemsStockDetails["colors_desc"];
	$itemsSize = $itemsStockDetails["sizes_desc"];
	$itemsPrice = $itemsStockDetails["price"];
	$itemsStock = $itemsStockDetails["quantity"];
	$itemsImage = $itemsStockDetails["image"];
	$itemsCode = $itemsStockDetails["items_type_code"];
	$itemsSizeId = $itemsStockDetails["items_size_id"];
	$itemsColorsId = $itemsStockDetails["items_colors_id"];
	$itemsStockForm = root_url("pages/loads/items_stock_form.php");
	include($itemsStockForm);
?>