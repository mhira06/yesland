<div class = "row">
	<div class = "col-12">
		<table class = "table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Done By</th>
					<th>Date</th>
					<th>Status</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody>
			<?php
				if(!empty($itemsOrderHistoryList)){
					$count = 1;
					foreach($itemsOrderHistoryList as $iRows){
					?>
						<tr>
							<td><?php
								echo $count;
							?></td>
							<td><?php
								echo $iRows["full_name"];
							?></td>
							<td><?php
								echo $iRows["date_transaction"];
							?></td>
							<td><?php
								echo $iRows["status_desc"];
							?></td>
							<td><?php
								echo $iRows["transaction_remarks"];
							?></td>
						</tr>
					<?php
						$count++;
					}
				}
			?>
			</tbody>
		</table>
	</div>
</div>