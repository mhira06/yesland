<?php
	if(!empty($sizeList)){
		foreach($sizeList as $siRows){
			$sizesId = $siRows["sizes_id"];
			$itemStockId = isset($siRows["items_stocks_id"]) ? $siRows["items_stocks_id"] : "";
			$availableStock = isset($siRows["quantity"]) ? $siRows["quantity"] : "";
			$price = isset($siRows["price"]) ? $siRows["price"] : "";
			if($itemStockId == ""){
				$itemStockCondition = "si.sizes_id = '".$sizesId."' 
										and co.colors_id = '".$selectedItemColor."'";
				$itemStockDetails = $select->get_active_items_stock_details("", $itemStockCondition);
				$availableStock = isset($itemStockDetails["quantity"]) ? $itemStockDetails["quantity"] : "";
				$price = isset($itemStockDetails["price"]) ? $itemStockDetails["price"] : "";
			}
		?>
			<div class = "form-group row">
				<label class = "col-sm-2 col-form-label"><?php
					echo $siRows["sizes_desc"];
				?></label>
				<div class = "col-sm-5">
					<div class = "form-group row">
						<label class = "col-sm-3 col-form-label">Stock</label>
						<div class = "col-sm-9">
							<input 
								type = "text" 
								name = "txt_items_stock_<?php echo $siRows["sizes_id"];?>_<?php echo $selectedItemCount; ?>" 
								id = "txt_items_stock_<?php echo $siRows["sizes_id"];?>_<?php echo $selectedItemCount; ?>" 
								class = "form-control number_only"
								placeholder = "Available Stock"
								value = "<?php echo $availableStock; ?>">
						</div>
					</div>
					
				</div>
				<div class = "col-sm-5">
					<div class = "form-group row">
						<label class = "col-sm-3 col-form-label">Price</label>
						<div class = "col-sm-9">
							<input 
								type = "text" 
								name = "txt_items_price_<?php echo $siRows["sizes_id"];?>_<?php echo $selectedItemCount; ?>" 
								id = "txt_items_price_<?php echo $siRows["sizes_id"];?>_<?php echo $selectedItemCount; ?>" 
								class = "form-control number_only"
								placeholder = "Price"
								value = "<?php echo $price; ?>">
						</div>
					</div>
				</div>
			</div>
		<?php
		}
	}
?>