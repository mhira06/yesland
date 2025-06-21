<div id = "div_items_color_input_<?php echo $itemsColorCount; ?>">
	<div class = "row" >
		<div class = "col-6">
			<div class = "row">
				<div class = "col-4">
					<select 
						name = "slt_items_color_<?php echo $itemsColorCount; ?>" 
						id = "slt_items_color_<?php echo $itemsColorCount; ?>" 
						class = "form-control select" 
						style = "width: 100%">
					<?php
						if(!empty($colorList)){
							$selected = "";
							foreach($colorList as $coRows){
								$selected = $coRows["colors_id"] == $selectedColor ? "selected" : "";
							?>
								<option value = "<?php echo $coRows["colors_id"]; ?>" <?php echo $selected; ?>><?php
									echo $coRows["colors_desc"];
								?></option>
							<?php
							}
						}
					?>
					</select>
				</div>
				<div class = "col-6">
					<div class = "form-group row">
						<label class = "col-sm-2 col-form-label">Image</label>
						<div class = "col-sm-10">
							<input 
								type = "file" 
								name = "fle_items_image_<?php echo $itemsColorCount; ?>"
								id = "fle_items_image_<?php echo $itemsColorCount; ?>" 
								accept = "image/*">
							<input 
								type = "hidden" 
								name = "hdn_recent_image_<?php echo $itemsColorCount; ?>" 
								id = "hdn_recent_image_<?php echo $itemsColorCount; ?>" 
								value = "<?php echo $selectedImage; ?>">
							<?php
								if($selectedImage != ""){
								?>
									<ul class = "mailbox-attachments d-flex align-items-stretch clearfix">
										<li>
											<span class = "mailbox-attachment-icon has-img">
												<img src = "<?php echo base_url($selectedImage); ?>" alt = "Items Image">
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
			<div class = "row">
				<div class = "col-12">
					<div class = "form-group row">
						<label class = "col-sm-2 col-form-label">Sizes</label>
						<div class = "col-sm-10">
							<select 
								name = "slt_items_sizes_<?php echo $itemsColorCount; ?>[]" 
								id = "slt_items_sizes_<?php echo $itemsColorCount; ?>" 
								class = "form-control select items_size" 
								style = "width: 100%"
								multiple = "multiple"
								data-items_count = "<?php echo $itemsColorCount; ?>">
							<?php
								if(!empty($sizesList)){
									$selected = "";
									foreach($sizesList as $siRows){
										$selected = in_array( $siRows["sizes_id"], $selectedSize) ? "selected" : "";
									?>
										<option value = "<?php echo $siRows["sizes_id"]; ?>" <?php echo $selected; ?>><?php
											echo $siRows["sizes_desc"];
										?></option>
									<?php
									}
								}
							?>
							</select>
						</div>
					</div>
				</div>
				<div class = "col-12" id = "div_items_stock_<?php echo $itemsColorCount; ?>">
				<?php
					if(!empty($itemStockList)){
						$sizeList = $itemStockList;
						$selectedItemCount = $itemsColorCount;
						$itemsStockInputs = root_url("pages/loads/items_stock_input.php");
						include($itemsStockInputs);
					}
				?>
				</div>
			</div>
		</div>
	</div>
	<hr>
</div>

