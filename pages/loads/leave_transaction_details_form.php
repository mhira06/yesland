<div class = "row">
	<div class = "col-sm-6">
		<div class = "form-group">
			<label class = "control-label">Employee Number</label>
			<div class = "form-control bg-secondary"><?php
				echo $selectedNumber;
			?></div>
		</div>
	</div>
	<div class = "col-sm-6">
		<label class = "control-label">Name</label>
		<div class = "form-control bg-secondary"><?php
				echo $selectedName;
			?></div>
	</div>
</div>
<div class = "row">
	<div class = "col-sm-6">
		<div class = "form-group">
			<label class = "control-label">Leave Type</label>
			<div class = "form-control bg-secondary"><?php
				echo $selectedLeaveType;
			?></div>
		</div>
	</div>
	<div class = "col-sm-6">
		<label class = "control-label">Reason</label>
		<div class = "form-control bg-secondary h-auto"><?php
				echo $selectedReason;
			?></div>
	</div>
</div>
<div class = "row">
	<div class = "col-sm-6">
		<div class = "form-group">
			<label class = "control-label">From</label>
			<div class = "form-control bg-secondary"><?php
				echo $selectedStart;
			?></div>
		</div>
	</div>
	<div class = "col-sm-6">
		<label class = "control-label">To</label>
		<div class = "form-control bg-secondary"><?php
			echo $selectedEnd;
		?></div>
	</div>
</div>
<div class = "row">
	<div class = "col-sm-6">
		<label class = "control-label">Credits Used</label>
		<div class = "form-control bg-secondary"><?php
			echo $selectedUsedCredit;
		?></div>
	</div>
	<div class = "col-sm-6">
		<div class = "form-group">
			<label class = "control-label">Status</label>
			<div class = "form-control bg-secondary"><?php
				echo $selectedStatus;
			?></div>
		</div>
	</div>
</div>
<?php
	switch($selectedAction){
		case "view":
		?>
			<table class = "table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Status</th>
						<th>Done By</th>
						<th>Remarks</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!empty($leaveHistoryList)){
						$count = 1;
						foreach($leaveHistoryList as $lRows){
						?>
							<tr>
								<td><?php
									echo $count;
								?></td>
								<td><?php
									echo $lRows["status_desc"];
								?></td>
								<td><?php
									echo $lRows["full_name"];
								?></td>
								<td><?php
									echo $lRows["leave_remarks"];
								?></td>
								<td><?php
									echo $lRows["date_transaction"];
								?></td>
							</tr>
						<?php
							$count++;
						}
					}
				?>
				</tbody>
			</table>
		<?php
			//$leaveHistoryList = $select->get_active_leave_history_display();
		break;
		
		case "approve":
		?>
			<div class = "row">
				<div class = "col-sm-12">
					<label class = "control-label">Remarks</label>
					<div class = "input">
						<textarea 
							name = "txtarea_remars" 
							id = "txtarea_remars" 
							class = "form-control" 
							rows = "4"></textarea>
					</div>
				</div>
			</div>
		<?php
		break;
	}
?>