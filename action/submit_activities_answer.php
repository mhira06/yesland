<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$generate = new Generate();
	$insert = new Insert();
	$update = new Update();
	$select = new Select();
	$delete = new Delete_data();
	
	$alert = "";
	$message = "";
	$response = array();
	$selectedActivity = $function->post("actitivity");
	$selectedStatus = $function->post("status_id");
	$selectedRemarks = $function->post("remarks");
	$activitiesData = array(
		"activities_id" => $selectedActivity,
		"users_id" => ID, 
		"status_id" => $selectedStatus, 
		"transaction_remarks" => $selectedRemarks, 
		"transact_by" => ID, 
		"date_transaction" => date("Y-m-d H:i:s"), 
		"date_added" => date("Y-m-d H:i:s"), 
		"added_by" => ID
	);
	
	$deleteCurrentAnswerCondition = array(
		"activities_id" => $selectedActivity,
		"users_id" => ID, 
		"status" => "active"
	);
	$deleteCurrentAnswer = $delete->activities_attendees($deleteCurrentAnswerCondition, ID, "due_to_update");
	if(!is_numeric($deleteCurrentAnswer)){
		$alert = "danger";
		$message = "Error in overwriting existing answer: <br>";
		$message .= "Error: ".$deleteCurrentAnswer;
	}
	
	if($alert == ""){
		$insertActivitiesAttendees = $insert->activities_attendees($activitiesData);
		if(!is_numeric($insertActivitiesAttendees)){
			$alert = "danger";
			$message = "Error in saving answer: <br>";
			$message .= "Error: ".$insertActivitiesAttendees;
		}
	}
	
	if($alert == ""){
		$alert = "success";
		$message = "Transaction Done: Answer Submitted"; 
	}
	
	$response = array(
		"output" => $alert, 
		"message" => $message, 
		"header" => ucfirst($alert)
	);
	
	echo json_encode($response);
	
?>