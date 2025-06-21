<form 
	name = "frm_items_stock" 
	id = "frm_items_stock" 
	method = "POST"
	enctype="multipart/form-data">
	<input 
		type = "hidden" 
		name = "hdn_items_size_id" 
		id = "hdn_items_size_id" 
		value = "<?php echo $itemsSizeId; ?>">
	<input 
		type = "hidden" 
		name = "hdn_items_color_id" 
		id = "hdn_items_color_id" 
		value = "<?php echo $itemsSizeId; ?>">
	<input 
		type = "hidden" 
		name = "hdn_items_type_code" 
		id = "hdn_items_type_code" 
		value = "<?php echo $itemsCode; ?>">
	<div id = "div_transaction_result"></div>
	<div class = "row">
		<div class = "col-sm-6">
			<div class = "form-group">
				<label class = "control-label">Item Type</label>
				<div class = "input form-control bg-secondary">
					<p><?php
						echo $itemsTypeDesc;
					?></p>
				</div>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group">
				<label class = "control-label">Item Name</label>
				<div class = "input form-control bg-secondary">
					<p><?php
						echo $itemsName;
					?></p>
				</div>
			</div>
		</div>
	</div>
	
	<div class = "row">
		<div class = "col-sm-6">
			<div class = "form-group">
				<label class = "control-label">Color</label>
				<div class = "input form-control bg-secondary">
					<p><?php
						echo $itemsColor;
					?></p>
				</div>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group">
				<label class = "control-label">Size</label>
				<div class = "input form-control bg-secondary">
					<p><?php
						echo $itemsSize;
					?></p>
				</div>
			</div>
		</div>
	</div>
	<div class = "row">
		<div class = "col-sm-6">
			<div class = "form-group">
				<label class = "control-label">Price (in Philippine Peso)</label>
				<div class = "input">
					<input 
						type = "text" 
						name = "txt_items_stock_price" 
						id = "txt_items_stock_price" 
						class ="form-control number_only"
						value = "<?php echo $itemsPrice; ?>">
				</div>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group">
				<label class = "control-label">Stock</label>
				<div class = "input">
					<input 
						type = "text" 
						name = "txt_items_stock_qty" 
						id = "txt_items_stock_qty" 
						class ="form-control number_only"
						value = "<?php echo $itemsStock; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class = "row">
		<div class = "col-sm-6">
		<?php
			echo $select->generate->alert_message("info", "Image is for all colors");
		?>
			<div class = "form-group">
				<label class = "control-label">Image</label>
				<div class = "input">
					<input 
						type = "file" 
						name = "fle_items_image" 
						id = "fle_items_image" 
						accept = "image/*">
					<input 
						type = "hidden" 
						name = "hdn_items_image" 
						id = "hdn_items_image"
						value = "<?php echo $itemsImage?>">
				<?php
					if($itemsImage != ""){
					?>
						<ul class = "mailbox-attachments d-flex align-items-stretch clearfix">
							<li>
								<span class = "mailbox-attachment-icon has-img">
									<img src = "<?php echo base_url($itemsImage); ?>" alt = "Items Image">
								</span>
							</li>
						</ul>
					<?php
					}
				?>
				</div>
			</div>
		</div>
	</div>
</form>