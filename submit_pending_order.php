<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$generate = new Generate();
	$insert = new Insert();
	$update = new Update();
	$select = new Select();
	$delete  = new Delete_data();
	
	$alert = "";
	$messge = "";
	$page = "pages/display/online_ordering.php?action=invoice";
	$pendingOrder = $select->get_users_pending_orders(ID);
	if(empty($pendingOrder)){
		$alert = "error";
		$message = "No Pending Items Found";
	}
	
	if($alert == ""){
		$itemsOrderHistoryData = array();
		foreach($pendingOrder as $pRows){
			$itemsOrder = $pRows["items_orders_id"];
			$itemsSizeId = $pRows["items_size_id"];
			if($alert == ""){
				$selectedOrderQuantiy = $function->post("txt_items_order_quantity_".$itemsOrder);
				if($selectedOrderQuantiy == ""){
					$alert = "error";
					$message = "No Quantity Found";
				}
			}
			
			if($alert == ""){
				if($selectedOrderQuantiy <= 0){
					$alert = "error";
					$message = "Quantity must be more than 0";
				}
			}
			
			if($alert == ""){
				$itemCondition = "isi.items_size_id = '".$itemsSizeId."'";
				$itemDetails = $select->get_active_items_display_details($itemCondition);
				$availableStock = isset($itemDetails["available_stock"]) ? $itemDetails["available_stock"] : 0;
				if($availableStock <= 0){
					$alert = "error";
					$message = "Out of stock item. Cannot proceed";
				}
			}
			
			if($selectedOrderQuantiy > $availableStock){
				$alert = "error";
				$message = "Preferred Quantity is greater than available stock";
			}
			
			if($alert != ""){
				break;
			}
		}
	}
	
	if($alert == ""){
		$itemStockData = [];
		foreach($pendingOrder as $p2Rows){
			$itemsOrder = $p2Rows["items_orders_id"];
			$itemsSizeId = $p2Rows["items_size_id"];
			$selectedOrderQuantiy = $function->post("txt_items_order_quantity_".$itemsOrder);
			$itemCondition = "isi.items_size_id = '".$itemsSizeId."'";
			$itemDetails = $select->get_active_items_display_details($itemCondition);
			$availableStock = isset($itemDetails["available_stock"]) ? $itemDetails["available_stock"] : 0;
			$newStock = ($availableStock - $selectedOrderQuantiy);
			
			$updateItemsOrderData = array(
				"quantity" => $selectedOrderQuantiy,
				"status_id" => 15, 
				"date_updated" => date("Y-m-d H:i:s"), 
				"updated_by" => ID
			);
			
			$updateItemsOrderCondition = array(
				"items_orders_id" => $itemsOrder
			);
			
			$updateItemsOrder = $update->items_order($updateItemsOrderData, $updateItemsOrderCondition);
			if(!is_numeric($updateItemsOrder)){
				$alert = "error";
				$message = "Error in updating order: <br>";
				$message .= "Error: ".$updateItemsOrder;
			}
			
			if($alert == ""){
				$deleteItemStockCondition = array(
					"items_sizes_id" => $itemsSizeId, 
					"transaction_status" => "active", 
					"status" => "active"
				);
				$remarks = "Order Id: ".$itemsOrder;
				$deleteItemStock = $delete->items_stock($deleteItemStockCondition, ID, $remarks);
				if(!is_numeric($deleteItemStock)){
					$alert = "danger";
					$message = "Error in updating stock: <br>";
					$message .= "Error: ".$deleteItemStock;
				}
			}
			
			if($alert == ""){
				$itemStockData[] = array(
					"items_sizes_id" => $itemsSizeId, 
					"quantity" => $newStock, 
					"transact_by" => ID, 
					"date_transaction" => date("Y-m-d H:i:s"), 
					"date_added" => date("Y-m-d H:i:s"), 
					"added_by" => ID
				);
			}
			if($alert == ""){
				$itemsOrderHistoryData[] = array(
					"items_order_id" => $itemsOrder, 
					"quantity" => $selectedOrderQuantiy, 
					"status_id" => 15, 
					"date_transaction" => date("Y-m-d H:i:s"), 
					"transact_by" => ID, 
					"date_added" => date("Y-m-d H:i:s"), 
					"added_by" => ID
				);
			}
		}
	}
	
	if($alert == ""){
		$insertItemsStocks = $insert->items_stock($itemStockData);
		if(!is_numeric($insertItemsStocks)){
			$alert = "danger";
			$message = "Error in saving items stock: <br>";
			$message .= "Error: ".$insertItemsStocks;
		}
	}
	
	if($alert == ""){
		$insertItemsOrderHistory = $insert->items_order_history($itemsOrderHistoryData);
		if(!is_numeric($insertItemsOrderHistory)){
			$alert = "danger";
			$message = "Error in saving order history: <br>";
			$message .= "Error: ".$insertItemsOrderHistory;
		}
	}
	
	if($alert == ""){
		$alert = "success";
		$message = "Transaction Done: All items successfully submitted. <br>"; 
		$message .= "Please check the system regularly";
		$page = "pages/display/online_ordering.php";
	}
	$redirect = base_url($page);
	$function->flash_message($alert, $message, $redirect);
		
?>