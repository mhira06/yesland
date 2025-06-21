<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedLeave = $function->get("leave_id");
	$selectedAction = $function->get("action");
	$leaveDetails = $select->get_users_leave_transaction_details_by_id($selectedLeave);
	//$function->echo_array($leaveDetails);
	$selectedNumber = isset($leaveDetails["users_number_display"]) ? $leaveDetails["users_number_display"] : "";
	$selectedName = isset($leaveDetails["full_name"]) ? $leaveDetails["full_name"] : "";
	$selectedLeaveType = isset($leaveDetails["leave_type_desc"]) ? $leaveDetails["leave_type_desc"] : "";
	$selectedReason = isset($leaveDetails["leave_reason"]) && $leaveDetails["leave_reason"] != "" ? $leaveDetails["leave_reason"] : "&nbsp;";
	$selectedStart = isset($leaveDetails["start_date"]) ? $leaveDetails["start_date"] : "";
	$selectedEnd = isset($leaveDetails["end_date"]) ? $leaveDetails["end_date"] : "";
	$selectedUsedCredit = isset($leaveDetails["credit"]) ? $leaveDetails["credit"] : "0";
	$selectedStatus = isset($leaveDetails["status_desc"]) ? $leaveDetails["status_desc"] : ""; 
	$leaveHistoryList = $select->get_active_leave_history_display($selectedLeave);
	$leaveDetailsForm = root_url("pages/loads/leave_transaction_details_form.php");
	
	include($leaveDetailsForm);
?>
