<form 
	name = "frm_import_sales" 
	id = "frm_import_sales" 
	enctype="multipart/form-data">
	<div id = "div_transaction_result"></div>
	<div class = "row">
		<!--<div class = "col-sm-12">
			<div class = "form-group">
				<label class = "control-label">Sales Person</label>
				<div class = "input">
					<select 
						name = "slt_import_sales_person" 
						id = "slt_import_sales_person" 
						class = "form-control select"
						style = "width:100%">
					
					</select>
				</div>
			</div>
		</div>-->
		<div class = "col-sm-12">
			<div class = "form-group">
				<label class = "control-label">File (Excel)</label>
				<div class = "input">
					<input 
						type = "file"
						name = "fle_import_files" 
						id = "fle_import_files"
						accept = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
				</div>
			</div>
		</div>
	</div>
</form>