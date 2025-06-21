<?php
	
	$availableSizesList = $availableSizes != "" ? explode(",", $availableSizes) : array();
	if(!empty($availableSizesList)){
		foreach($availableSizesList as $a2Rows){
			list($sizesDesc, $itemsSizesId) = explode("-x-", $a2Rows);
		?>
			<button 
				type = "button" 
				name = "btn_sizes_<?php echo $itemsSizesId; ?>" 
				id = "btn_sizes_<?php echo $itemsSizesId; ?>"
				data-id = "<?php echo $itemsSizesId; ?>" 
				class = "btn btn-app btn-flat btn-default available_sizes"><?php
				echo $sizesDesc
			?></button>
		<?php
		}
	}
?>