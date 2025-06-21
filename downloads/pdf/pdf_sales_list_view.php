<?php
	session_start();
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	
	$selectedAction = $function->get("action");
	$selectedDonwloadType = $function->get("type");
	$selectedAgent = $function->get("agent");
	//$function->echo_array($_SESSION);
	$session = isset($_SESSION[PROJECT][$selectedAction]) ?  $_SESSION[PROJECT][$selectedAction] : array();
	$selectedStartDate = isset($session["start_date"]) && $session["start_date"] != "" ? $session["start_date"] : date("Y-m-01");
	$selectedEndDate = isset($session["end_date"]) && $session["end_date"] != ""? $session["end_date"] : date("Y-m-d");
	$searchCondition = isset($session["search_condition"]) && $session["search_condition"] != "" ? $session["search_condition"] : "";
								
	$salesCondition = "date(sa.date_reserve) >= '".$selectedStartDate."'
						and date(sa.date_reserve) <= '".$selectedEndDate."'";
	if($selectedDonwloadType != "default"){
		$salesCondition = $searchCondition;
	}
	
	if($selectedAction == "sales"){
		$usersCondition = "sa_u.users_id = '".$selectedAgent."'";
		$salesCondition .= ($salesCondition != "" ? " and " : "").$usersCondition;
	}
	
	$salesList = $select->get_active_sales_list("", $salesCondition);
	$salesListRaw = root_url("pages/includes/sales/sales_list_raw.php");
	
	include($salesListRaw);
?>