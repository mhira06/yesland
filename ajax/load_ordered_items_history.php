<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedOrder = $function->get("order_id");
	$itemsOrderHistoryList = $select->get_ordered_items_history($selectedOrder);
	$orderedItemsHistory = root_url("pages/loads/ordered_items_history.php");
	include($orderedItemsHistory);
?>