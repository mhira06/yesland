<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	$function = new Functions();
	$select = new Select();
	$selectedId = $function->get("users_id");
	$userDetails = $select->get_user_details($selectedId);
	$selectedUsersId = isset($userDetails["users_id"]) ? $userDetails["users_id"] : $selectedId;
	$selectedNumber = isset($userDetails["users_number_display"]) ? $userDetails["users_number_display"] : "";
	$selectedFullName = isset($userDetails["full_name"]) ? $userDetails["full_name"] : "";
	$selectedDateHired = isset($userDetails["date_hire"]) ? $userDetails["date_hire"] : "";
	$selectedStatus = isset($userDetails["employment_status_desc"]) ? $userDetails["employment_status_desc"] : "";
	$selectedPosition = isset($userDetails["positions_desc"]) ? $userDetails["positions_desc"] : "";
	$employeeStatusId = isset($userDetails["employment_status_id"]) ? $userDetails["employment_status_id"] : "";
	$usersLeaveCredit = $select->get_users_leave_credit_details($selectedUsersId);
	$selectedStartDate = isset($usersLeaveCredit["date_from"]) ? $usersLeaveCredit["date_from"] : $selectedDateHired;
	$selectedEndDate = $function->format_date_3($selectedStartDate, "+1 year", "Y-m-d");
?>
<form 
	name = "frm_leave_details" 
	id = "frm_leave_details"
	class = "form-horizontal">
	<input 
		type = "hidden" 
		name = "hdn_leave_users_id" 
		id = "hdn_leave_users_id" 
		value = "<?php echo $selectedId; ?>">
	<input 
		type = "hidden" 
		name = "hdn_leave_date_hired" 
		id = "hdn_leave_date_hired" 
		value = "<?php echo $selectedDateHired; ?>">
	<input 
		type = "hidden" 
		name = "hdn_leave_employee_status" 
		id = "hdn_leave_employee_status" 
		value = "<?php echo $employeeStatusId; ?>">
	<div id = "div_leave_transaction_result"></div>
	<div class = "row">
		<div class = "col-sm-6">
			<div class = "form-group row">
				<label class="col-sm-3 col-form-label">Number</label>
				<div class = "col-sm-9">
					<div class = "form-control bg-secondary"><?php
						echo $selectedNumber;
					?></div>
				</div>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group row">
				<label class="col-sm-3 col-form-label">Name</label>
				<div class = "col-sm-9">
					<div class = "form-control bg-secondary"><?php
						echo $selectedFullName;
					?></div>
				</div>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group row">
				<label class="col-sm-3 col-form-label">Position</label>
				<div class = "col-sm-9 ">
					<div class = "form-control bg-secondary"><?php
						echo $selectedPosition;
					?></div>
				</div>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group row">
				<label class="col-sm-3 col-form-label">Status</label>
				<div class = "col-sm-9">
					<div class = "form-control bg-secondary"><?php
						echo $selectedStatus;
					?></div>
				</div>
			</div>
		</div>
	</div>
	<div class = "row">
	<?php
		$leaveList = $select->get_active_employees_leave_types($employeeStatusId);
		foreach($leaveList as $lRows){
			$usersTypeLeave = $lRows["users_type_leave_id"];
			$usedLeaveDetails = $select->get_active_users_used_leaves($selectedUsersId, $usersTypeLeave, $selectedStartDate, $selectedEndDate);
			$usedLeave = isset($usedLeaveDetails["total_used_leave_credits"]) && $usedLeaveDetails["total_used_leave_credits"] != "" ? $usedLeaveDetails["total_used_leave_credits"] : 0;
			$remainingLeaveCredit = ($lRows["leave_credit"] - $usedLeave);
		?>
			<div class = "col-sm-3">
				<div class = "form-group">
					<label class="col-form-label">Leave Type</label>
					<div class = "input">
						<div class = "form-control bg-secondary"><?php
							echo $lRows["leave_type_desc"];
						?></div>
					</div>
				</div>
			</div>
			<div class = "col-sm-2">
				<div class = "form-group">
					<label class="col-form-label">New Credit</label>
					<div class = "input">
						<input 
							type = "text" 
							name = "txt_leave_credit_<?php echo $lRows["users_type_leave_id"];?>" 
							id = "txt_leave_credit_<?php echo $lRows["users_type_leave_id"];?>" 
							class = "form-control"
							value = "<?php echo $lRows["leave_credit"]; ?>">
					</div>
				</div>
			</div>
			<div class = "col-sm-3">
				<div class = "form-group">
					<label class="col-form-label">Remaining Credit</label>
					<div class = "input">
						<div class = "form-control bg-secondary"><?php
							echo $remainingLeaveCredit;
						?></div>
					</div>
				</div>
			</div>
			<div class = "col-sm-2">
				<div class = "form-group">
					<label class="col-form-label">Start Date</label>
					<div class = "input">
						<div class = "form-control bg-secondary"><?php
							echo $selectedStartDate;
						?></div>
					</div>
				</div>
			</div>
			<div class = "col-sm-2">
				<div class = "form-group">
					<label class="col-form-label">End Date</label>
					<div class = "input">
						<div class = "form-control bg-secondary"><?php
							echo $selectedEndDate;
						?></div>
					</div>
				</div>
			</div>
		<?php
		}
		//$function->echo_array($leaveList);
	?>
	</div>
</form>