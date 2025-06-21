<div class = "row">
	<div class = "col-sm-12">
		<div class = "form-group">
			<label class = "control-label">Type</label>
			<div class = "input">
				<select 
					name = "slt_download_type" 
					id = "slt_download_type" 
					class = "form-control select"
					style = "width:100%">
				<?php
					foreach($downloadList as $key => $value){
					?>
						<option value = "<?php echo $key; ?>"><?php
							echo $value;
						?></option>
					<?php
					}
				?>
				</select>
			</div>
		</div>
	</div>
	<div class = "col-sm-12">
		<div class = "form-group">
			<label class = "control-label">File Type</label>
			<div class = "input">
				<select 
					name = "slt_download_file_type" 
					id = "slt_download_file_type" 
					class = "form-control select"
					style = "width:100%">
				<?php
					foreach($downloadFileType as $key => $value){
					?>
						<option value = "<?php echo $key; ?>"><?php
							echo $value;
						?></option>
					<?php
					}
				?>
				</select>
			</div>
		</div>
	</div>
</div>