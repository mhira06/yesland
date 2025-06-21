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
				if(!empty($documentRequestHistoryList)){
					$count = 1;
					foreach($documentRequestHistoryList as $dRows){
					?>
						<tr>
							<td><?php
								echo $count;
							?></td>
							<td><?php
								echo $dRows["full_name"];
							?></td>
							<td><?php
								echo $dRows["date_transaction"];
							?></td>
							<td><?php
								echo $dRows["status_desc"];
							?></td>
							<td><?php
								echo $dRows["transaction_remarks"];
							?></td>
						</tr>
					<?php
					}
				}
			?>
			</tbody>
		</table>
	</div>
</div>