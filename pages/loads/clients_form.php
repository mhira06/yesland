<form 
	name = "frm_clients" 
	id = "frm_clients" 
	autocomplete = "off">
	<div class = "row mb-1">
		<div class = "col-md-4">
			<label class = "control-label">First Name</label>
			<div class = "input">
				<input 
					type = "text"
					name = "txt_clients_first_name" 
					id = "txt_clients_first_name" 
					class = "form-control">
			</div>
		</div>
		<div class = "col-md-4">
			<label class = "control-label">Middle Name</label>
			<div class = "input">
				<input 
					type = "text"
					name = "txt_clients_middle_name" 
					id = "txt_clients_middle_name" 
					class = "form-control">
			</div>
		</div>
		<div class = "col-md-4">
			<label class = "control-label">Last Name</label>
			<div class = "input">
				<input 
					type = "text"
					name = "txt_clients_last_name" 
					id = "txt_clients_last_name" 
					class = "form-control">
			</div>
		</div>
	</div>
	<h5>Contact Number</h5>
	<?php
		if(!empty($contactNumberList)){
			foreach($contactNumberList as $cnRows){
				$contactCode = $cnRows["contact_number_type_code"];
			?>
				<div class = "row">
					<div class = "col-sm-6">
						<div class = "form-group row">
							<label class = "col-sm-3 col-form-label"><?php
								echo $cnRows["contact_number_type_desc"];
							?></label>
							<div class = "col-sm-9">
								<input 
									type = "text" 
									name = "txt_clients_<?php echo $contactCode;?>_number" 
									id = "txt_clients_<?php echo $contactCode;?>_number" 
									class = "form-control" 
									placeholder = "<?php echo $cnRows["contact_number_type_desc"]; ?>"
									value = "">
							</div>
						</div>
					</div>
				</div>
			<?php
			}
		}
	?>
	<h5>Address</h5>
	<?php
		if(!empty($addressList)){
		foreach($addressList as $adRows){
			$addressCode = $adRows["address_type_code"];
		?>
			<div class = "row">
				<div class = "col-md-12">
					<div class = "form-group">
						<label class = "col-form-label"><?php
							echo $adRows["address_type_desc"];
						?></label>
						<div class = "address-input">
							<div class = "row">
								<div class = "col-sm-3">
									<div class = "form-group">
										<label class = "col-form-label">Number</label>
										<div class = "input ">
											<input 
												type = "text" 
												name = "txt_clients_number_<?php echo $addressCode;?>_address" 
												id = "txt_clients_number_<?php echo $addressCode;?>_address" 
												class = "form-control" 
												placeholder = "Number"
												value = "">
										</div>
									</div>
								</div>
								<div class = "col-sm-3">
									<div class = "form-group">
										<label class = "col-form-label">Street</label>
										<div class = "input ">
											<input 
												type = "text" 
												name = "txt_clients_street_<?php echo $addressCode;?>_address" 
												id = "txt_clients_street_<?php echo $addressCode;?>_address" 
												class = "form-control" 
												placeholder = "Street"
												value = "">
										</div>
									</div>
								</div>
								<div class = "col-sm-3">
									<div class = "form-group">
										<label class = "col-form-label">Barangay</label>
										<div class = "input ">
											<input 
												type = "text" 
												name = "txt_clients_barangay_<?php echo $addressCode;?>_address" 
												id = "txt_clients_barangay_<?php echo $addressCode;?>_address" 
												class = "form-control" 
												placeholder = "Barangay"
												value = "">
										</div>
									</div>
								</div>
								<div class = "col-sm-3">
									<div class = "form-group">
										<label class = "col-form-label">City</label>
										<div class = "input ">
											<input 
												type = "text" 
												name = "txt_clients_city_<?php echo $addressCode;?>_address" 
												id = "txt_clients_city_<?php echo $addressCode;?>_address" 
												class = "form-control" 
												placeholder = "City"
												value = "">
										</div>
									</div>
								</div>
								<div class = "col-sm-3">
									<div class = "form-group">
										<label class = "col-form-label">Province</label>
										<div class = "input ">
											<input 
												type = "text" 
												name = "txt_clients_province_<?php echo $addressCode;?>_address" 
												id = "txt_clients_province_<?php echo $addressCode;?>_address" 
												class = "form-control" 
												placeholder = "Province"
												value = "">
										</div>
									</div>
								</div>
								<div class = "col-sm-3">
									<div class = "form-group">
										<label class = "col-form-label">Country</label>
										<div class = "input ">
											<input 
												type = "text" 
												name = "txt_clients_country_<?php echo $addressCode;?>_address" 
												id = "txt_clients_country_<?php echo $addressCode;?>_address" 
												class = "form-control" 
												placeholder = "Country"
												value = "">
										</div>
									</div>
								</div>
								<div class = "col-sm-3">
									<div class = "form-group">
										<label class = "col-form-label">Zip code</label>
										<div class = "input ">
											<input 
												type = "text" 
												name = "txt_clients_zip_code_<?php echo $addressCode;?>_address" 
												id = "txt_clients_zip_code_<?php echo $addressCode;?>_address" 
												class = "form-control" 
												placeholder = "Zip Code"
												value = "">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
	}
	?>
</form>