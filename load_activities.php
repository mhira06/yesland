<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedId = $function->get("id");
	$selectedStart = $function->get("start");
	$selectedEnd = $function->get("end");
	$startDate = $function->format_date($selectedStart, "Y-m-d");
	$endDate = $function->format_date($selectedEnd, "Y-m-d");
	//echo $startDate." ".$endDate;
	$activitiesCondition = "a.start_date >= '".$startDate."' 
							and a.end_date <= '".$endDate."'";
	$activitiesList = $select->get_active_activities_list("", $activitiesCondition, "a.activities_id");
	$response = array();
	foreach($activitiesList as $aRows){
		$color = "#3788D8";
		if($aRows["date_registration_end"] < date("Y-m-d")){
			$color = "#C6303E";
		}
		if($aRows["status_id"] != "12"){
			$color = "#FFC107";
		}
		$color = $aRows["activities_id"] == $selectedId ? "#28A745" : $color;
		$response[] = array(
			"id" => $aRows["activities_id"], 
			"title" => $aRows["activities_title"],
			"url"   => base_url("pages/administration/manage_activities.php?id=".$aRows["activities_id"]),
			"start" => $aRows["start_date"], 
			"end" => $aRows["end_date"], 
			"color" => $color
		);
	}
	
	echo json_encode($response);
?>