<?php
	$dateDescription = "";
	if($selectedUserType != ""){
		$dateDescription = $selectedUserType == "1" ? "Hired" : "Affiliated";
	}
?>
<div class = "row">
<?php
	if($selectedUserType != ""){
		
		$usersTypeStatusList = $select->get_active_users_type_status($selectedUserType);
	?>
		<div class = "col-sm-6">
			<div class = "form-group row">
				<label class = "col-sm-3 col-form-label">Status *</label>
				<div class = "col-sm-9">
					<select 
						name = "slt_users_status" 
						id = "slt_users_status" 
						class = "form-control select" 
						style = "width:100%">
						<option value = "">--Please select--</option>
					<?php
						$selected = "";
						foreach($usersTypeStatusList as $utRows){
							$selected = $utRows["users_type_status_id"] == $selectedUserStatus ? "selected" : "";
						?>
							<option value = "<?php echo $utRows["users_type_status_id"]; ?>" <?php echo $selected; ?>><?php
								echo $utRows["employment_status_desc"];
							?></option>
						<?php
						}
					?>
					</select>
				</div>
			</div>
		</div>
	<?php
	}
?>
	<div class = "col-sm-6">
		<div class = "form-group row">
			<label class = "col-sm-3 col-form-label">Position *</label>
			<div class = "col-sm-9">
			<?php
				$positionsList = $select->get_active_positions_list();
			?>
				<select 
					name = "slt_users_position" 
					id = "slt_users_position" 
					class = "form-control select" 
					style = "width:100%">
					<option value = "">--Please select--</option>
				<?php
					$selected = "";
					foreach($positionsList as $posRows){
						$selected = $posRows["positions_id"] == $selectedPosition ? "selected" : "";
					?>
						<option value = "<?php echo $posRows["positions_id"]; ?>" <?php echo $selected; ?>><?php
							echo $posRows["positions_desc"];
						?></option>
					<?php
					}
				?>
				</select>
			</div>
		</div>
	</div>
<?php
	if($selectedUserType != ""){
	?>
		<div class = "col-sm-6">
			<div class = "form-group row">
				<label class = "col-sm-3 col-form-label">Date <?php
					echo $dateDescription;
				?> *</label>
				<div class = "col-sm-9">
					<input 
						type = "text" 
						name = "txt_users_date_hired" 
						id = "txt_users_date_hired" 
						data-toggle = "datetimepicker" 
						data-target-input="#txt_users_date_hired"
						class = "form-control" 
						placeholder = "Date <?php echo $dateDescription; ?>"
						value = "<?php echo $selectedDateHired; ?>">
				</div>
			</div>
		</div>
	<?php
	}
?>
</div>
<?php
	if($selectedUserType == "1"){
		$rateTypeList = $select->get_active_rate_type_list();
	?>
		<div class = "row">
			<div class = "col-sm-6">
				<div class = "form-group row">
					<label class = "col-sm-3 col-form-label">Rate Type *</label>
					<div class = "col-sm-9">
						<select 
							name = "slt_users_rate_type" 
							id = "slt_users_rate_type" 
							class = "form-control select" 
							style = "width:100%">
							<option value = "">--Please select--</option>
						<?php
							$selected = "";
							foreach($rateTypeList as $rtRows){
								$selected = $rtRows["rate_type_id"] == $selectedRateType ? "selected" : "";
							?>
								<option value = "<?php echo $rtRows["rate_type_id"]; ?>" <?php echo $selected; ?>><?php
									echo $rtRows["rate_type_desc"];
								?></option>
							<?php
							}
						?>
						</select>
					</div>
				</div>
			</div>
			<div class = "col-sm-6">
				<div class = "form-group row">
					<label class = "col-sm-3 col-form-label">Rate Value *</label>
					<div class = "col-sm-9">
						<input 
							type = "text" 
							name = "txt_users_rate_value" 
							id = "txt_users_rate_value" 
							class = "form-control" 
							placeholder = "Rate Value"
							value = "<?php echo $selectedRateValue; ?>">
					</div>
				</div>
			</div>
		</div>
	<?php
	}
?>