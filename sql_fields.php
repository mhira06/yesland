<?php
	class Sql_fields{
		public function users_main(){
			$userFields = $this->users_raw("u");
			$response = $userFields;
			$response .= ", CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,
							ul.users_login_id,
							ul.users_password,
							(YEAR(NOW()) - YEAR(u.birthday)) AS age,
							IF(u.users_status = 'active',
								'Active',
								'Pending') AS users_status,
							CONCAT(LEFT(ut.users_type_desc, 1),
									'YLR-',
									LPAD(u.users_number, 5, 0)) AS users_number_display";
							
			$loginTypeFields = $this->login_type_raw("lt");
			$response .= ", ".$loginTypeFields; 
			
			$response .= ", us.users_status_id, 
							uts.users_type_status_id";
			$userTypeFields = $this->user_type_raw("ut");
			$response .= ", ".$userTypeFields;
			
			$employmentStatusFields = $this->employment_status_raw("es");
			$response .= ", ".$employmentStatusFields;
			
			$response .= ", up.users_position_id";
			$positionsFields = $this->positions_raw("p");
			$response .= ", ".$positionsFields;
			
			$response .= ", ur.users_rate_id, 
							ur.rate_value";
			$rateTypeFields = $this->rate_type_raw("rt");
			$response .= ", ".$rateTypeFields;
			
			return $response;
			
		}
		public function users_raw($alias = null){
			$fields = array(
				"users_id", 
				"users_number", 
				"first_name", 
				"middle_name", 
				"last_name", 
				"second_name", 
				"birthday", 
				"date_hire",
				"users_picture", 
				"users_signature"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function login_type_raw($alias = null){
			$fields = array(
				"login_type_id", 
				"login_type_code", 
				"login_type_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function user_type_raw($alias = null){
			$fields = array(
				"users_type_id", 
				"users_type_desc", 
				"users_type_code"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function employment_status_raw($alias = null){
			$fields = array(
				"employment_status_id", 
				"employment_status_code", 
				"employment_status_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function positions_raw($alias = null){
			$fields = array(
				"positions_id", 
				"positions_code", 
				"positions_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function identification_main(){
			$response = "id.identification_id,
						id.identification_code,
						id.identification_desc,
						id_t.identification_type_id,
						id_t.identification_type_code,
						id_t.identification_type_desc";
			return $response;
		}
		
		public function users_identification_main(){
			$response = "u_id.users_identification_id,
						u_id.users_id,
						u_id.id_value";
			$identificationFields = $this->identification_main();
			$response .= ", ".$identificationFields;
			
			return $response;
		}
		
		public function users_identification_display($identification){
			$response = "u_id.users_id";
			
			$fields = array();
			
			foreach($identification as $idRows){
				$idCode = $idRows["identification_code"];
				$idName = $idRows["identification_desc"];
				$condition = "if(id.identification_code = '".$idCode."', 
								u_id.id_value, 
								NULL)";
				$tempFields = "group_concat(".$condition.") as `".$idName."`";
				
				$fields[] = $tempFields;
			}
			
			$response .= ", ".implode(", ", $fields);
			
			return $response;
		}
		
		public function users_contact_number_main(){
			$response = "u_cn.users_contact_number_id, 
						u_cn.users_id, 
						u_cn.contact_number_value";
			$contactNumberFields = $this->contact_number_raw("cnt");
			$response .= ", ".$contactNumberFields;
			return $response;
		}
		
		public function contact_number_raw($alias = null){
			$fields = array(
				"contact_number_type_id", 
				"contact_number_type_code", 
				"contact_number_type_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function address_type_raw($alias = null){
			$fields = array(
				"address_type_id", 
				"address_type_code", 
				"address_type_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function users_address_raw($alias = null){
			$fields = array(
				"users_address_id", 
				"users_id", 
				"`number`", 
				"street", 
				"barangay", 
				"city", 
				"zip_code", 
				"province", 
				"country"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function users_address_main(){
			$usersAddressRaw = $this->users_address_raw("u_ad");
			$response = $usersAddressRaw;
			$response .= ", CONCAT(IFNULL(u_ad.`number`, ''),
								IF(u_ad.street IS NOT NULL,
									CONCAT(', ', u_ad.street),
									''),
								IF(u_ad.barangay IS NOT NULL,
									CONCAT(', ', u_ad.barangay),
									''),
								IF(u_ad.city IS NOT NULL,
									CONCAT(', ', u_ad.city),
									''),
								IF(u_ad.province IS NOT NULL,
									CONCAT(', ', u_ad.province),
									''),
								IF(u_ad.country IS NOT NULL,
									CONCAT(', ', u_ad.country),
									''),
								IF(u_ad.zip_code IS NOT NULL,
									CONCAT(' ', u_ad.zip_code),
									'')) AS full_address";
			$addressTypeFields = $this->address_type_raw("ad");
			$response .= ", ".$addressTypeFields;
			
			return $response;
		}
		
		public function users_type_status(){
			$response = "uts.users_type_status_id";
			
			$usersTypeFields = $this->user_type_raw("ut");
			$response .= ", ".$usersTypeFields;
			
			$employmentStatusFields = $this->employment_status_raw("es");
			$response .= ", ".$employmentStatusFields;
			
			return $response;
		}
		
		public function rate_type_raw($alias = null){
			$fields = array(
				"rate_type_id", 
				"rate_type_code", 
				"rate_type_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function users_contact_number_display($contactNumber){
			$response = "u_cn.users_id";
			
			$fields = array();
			if(!empty($contactNumber)){
				foreach($contactNumber as $cnRows){
					$contactNumberCode = $cnRows["contact_number_type_code"];
					$contactNumberDesc = $cnRows["contact_number_type_desc"];
					$condition = "if(cnt.contact_number_type_code = '".$contactNumberCode."', 
									u_cn.contact_number_value, 
									NULL)";
					$tempFields = "group_concat(".$condition.") as `".$contactNumberDesc."`";
					
					$fields[] = $tempFields;
				}
				$response .= ", ".implode(", ", $fields);
			}
			return $response;
		}
		
		public function users_address_display($address){
			$response = "u_ad.users_id";
			
			$fields = array();
			if(!empty($address)){
				foreach($address as $addRows){
					$addressCode = $addRows["address_type_code"];
					$addressDesc = $addRows["address_type_desc"];
					$condition = "if(ad.address_type_code = '".$addressCode."', 
									CONCAT(IFNULL(u_ad.`number`, ''), '-x-',
										IF(u_ad.street IS NOT NULL,
											u_ad.street,
											''), '-x-',
										IF(u_ad.barangay IS NOT NULL,
											u_ad.barangay,
											''), '-x-',
										IF(u_ad.city IS NOT NULL,
											u_ad.city,
											''), '-x-',
										IF(u_ad.province IS NOT NULL,
											u_ad.province,
											''), '-x-',
										IF(u_ad.country IS NOT NULL,
											u_ad.country,
											''), '-x-',
										IF(u_ad.zip_code IS NOT NULL,
											u_ad.zip_code,
											'')), 
									NULL)";
					$tempFields = "group_concat(".$condition.") as `".$addressDesc."`";
					
					$fields[] = $tempFields;
				}
				$response .= ", ".implode(", ", $fields);
			}
			
			return $response;
		}
		
		public function users_type_leave_main(){
			$response = "utl.users_type_leave_id,
						utl.leave_credit";
			$usersTypeStatus = $this->users_type_status();
			$response .= ", ".$usersTypeStatus;
			
			$leaveType = $this->leave_type_raw("lt");
			$response .= ", ".$leaveType;
			
			return $response;
		}
		
		public function leave_type_raw($alias = null){
			$fields = array(
				"leave_type_id", 
				"leave_type_code", 
				"leave_type_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response;
		}
		
		public function users_leave_credit_raw($alias = null){
			$fields = array(
				"users_leave_credit_id", 
				"users_id", 
				"leave_credit", 
				"leave_status", 
				"date_from", 
				"date_to"
			);
			$temp = array();
			foreach($fields as $values){
				$realValue = $values;
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				if($values == "leave_credit"){
					$fieldName = $fieldName." as users_leave_credit";
				}
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			
			return $response; 
		}
		
		public function users_leave_credit_main(){
			$response = $this->users_leave_credit_raw("ulc");
			
			$usersTypeLeaveMain = $this->users_type_leave_main();
			$response .= ", ".$usersTypeLeaveMain;
			
			return $response;
		}
		
		public function status_raw($alias = null){
			$fields = array(
				"status_id", 
				"status_sequence", 
				"status_code", 
				"status_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function leave_transaction_main(){
			$response = "ltr.leave_transaction_id, 
						ltr.leave_reason";
			
			$usersLeaveCredit = $this->users_leave_credit_main();
			$response .= ", ".$usersLeaveCredit;
			
			$statusFields = $this->status_raw("s");
			$response .= ", ".$statusFields;
			
			$response .= ",u.users_id,
							u.users_number,
							u.first_name,
							u.last_name,
							CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,
							CONCAT(LEFT(ut.users_type_desc, 1),
									'YLR-',
									lpad(u.users_number, 5, 0)) AS users_number_display, 
							leave_dates.start_date, 
							leave_dates.end_date, 
							leave_dates.credit";
			return $response;
		}
		
		public function users_leave_summary(){
			$response = "ulc.users_id,
						SUM(ltr.credits_deducted) AS total_used_leave_credits";
			return $response;
		}
		
		public function leave_dates_main(){
			$response = "ld.leave_dates_id,
						ld.leave_date,
						ld.leave_status, 
						ltr.leave_transaction_id, 
						ltr.status_id";
			return $response;
		}
		
		public function leave_dates_display(){
			$response = "ltr.leave_transaction_id,  
						count(ld.leave_date) as credit, 
						min(ld.leave_date) as start_date,
						max(ld.leave_date) as end_date";
			return $response;
		}
		
		public function leave_history_main(){
			$response = "ltsh.leave_transaction_status_history_id,
						ltsh.leave_transaction_id";
						
			$userFields = $this->users_raw("u");
			$response .= ", ".$userFields;
			
			$statusFields = $this->status_raw("s");
			$response .= ", ".$statusFields;
			
			return $response;
		}
		
		public function leave_history_display(){
			$response = "ltsh.leave_transaction_status_history_id,
						ltsh.leave_transaction_id";
			$statusFields = $this->status_raw("s");
			$response .= ", ".$statusFields;
			
			$response .= ",  CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,
							IF(s.status_id != 1,
								ltsh.transaction_remarks,
								'') AS leave_remarks,
							ltsh.date_transaction";
			return $response;
		}
		
		public function activities_raw($alias = null){
			$fields = array(
				"activities_id", 
				"activities_title", 
				"activities_desc", 
				"location", 
				"start_date", 
				"end_date", 
				"date_registration_end"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function activities_main(){
			$activitiesFields = $this->activities_raw("a");
			$response = $activitiesFields;
			
			$statusFields = $this->status_raw("s");
			$response .= ", ".$statusFields;
			
			$response .= ", ata.activities_target_attendees_id";
			
			$positionsFields = $this->positions_raw("p");
			$response .= ", ".$positionsFields;
			
			return $response;
		}
		
		public function activities_display(){
			$activitiesFields = $this->activities_raw("a");
			$response = $activitiesFields;
			
			$statusFields = $this->status_raw("s");
			$response .= ", ".$statusFields;
			
			$response .= ", group_concat(p.positions_id) as target_attendees";
			
			return $response;
		}
		
		public function activities_attendees_main(){
			$response = "att.activities_attendees_id";
			
			$activitiesFields = $this->activities_raw("a");
			$response .= ", ".$activitiesFields;
			
			$response .= ", u.users_id, 
							CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,  
							CONCAT(LEFT(ut.users_type_desc, 1),
								'YLR-',
								LPAD(u.users_number, 5, 0)) AS users_number_display, 
							ut.users_type_desc";
			$statusFields = $this->status_raw("att_s");
			$response .= ", ".$statusFields;
			
			return $response;
		}
		
		public function activities_attendees_summary(){
			$response = "";
			$activitiesFields = $this->activities_raw("a");
			$response = $activitiesFields;
			
			$response .= ", SUM(IF(att_s.status_id = 6, 1, 0)) AS join_count,
							SUM(IF(att_s.status_id = 7, 1, 0)) AS not_join_count";
			return $response;
		}
		
		public function activities_target_attendees_main(){
			$response = "ata.activities_target_attendees_id";
			
			$positionsFields = $this->positions_raw("p");
			$response .= ", ".$positionsFields;
			
			$activitiesFields = $this->activities_raw("a");
			$response .= ", ".$activitiesFields;
			
			$response .= ", up.users_position_id, 
							u.users_id, 
							CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,  
							CONCAT(LEFT(ut.users_type_desc, 1),
								'YLR-',
								LPAD(u.users_number, 5, 0)) AS users_number_display, 
							ut.users_type_desc";
			$response .= ", att.activities_attendees_id";
			
			$statusFields = $this->status_raw("att_s");
			$response .= ", ".$statusFields;
			
			return $response;
		}
		
		public function items_raw($alias = null){
			$fields = array(
				"items_id", 
				"items_code", 
				"items_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function items_type_raw($alias = null){
			$fields = array(
				"items_type_code", 
				"items_type_desc", 
				"items_type_id"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function sizes_raw($alias = null){
			$fields = array(
				"sizes_id", 
				"size_sequence", 
				"sizes_code", 
				"sizes_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function colors_raw($alias = null){
			$fields = array(
				"colors_id", 
				"colors_code", 
				"colors_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function items_display(){
			$response = "";
			$itemsFields = $this->items_raw("i");
			$response = $itemsFields;
			
			$itemsTypeField = $this->items_type_raw("it");
			$response .= ", ".$itemsTypeField;
			
			$response .= ", ico.image, 
							GROUP_CONCAT(DISTINCT co.colors_desc) AS colors_list,
							GROUP_CONCAT(DISTINCT co.colors_desc,
								'-x-',
								ico.items_colors_id) AS colors_value_list,
							GROUP_CONCAT(DISTINCT si.sizes_desc
								ORDER BY si.size_sequence) AS sizes_list,
							GROUP_CONCAT(DISTINCT si.sizes_desc,'-x-',isi.sizes_id
								ORDER BY si.size_sequence) AS sizes_value_list_raw, 
							GROUP_CONCAT(DISTINCT si.sizes_desc,'-x-',isi.items_size_id
								ORDER BY si.size_sequence) AS sizes_value_list, 
							ipr.price, 
							SUM(quantity) AS available_stock";
			return $response;
		}
		
		public function items_stock_main(){
			$response = "ist.items_stocks_id,
						ist.quantity";
					
			$sizesFields = $this->sizes_raw("si");
			$response .= ", isi.items_size_id";
			$response .= ", ".$sizesFields;
			
			$colorsFields = $this->colors_raw("co");
			$response .= ", ico.items_colors_id, 
							ico.image";
			$response .= ", ".$colorsFields;
			
			$itemsFields = $this->items_raw("i");
			$response .= ", ".$itemsFields;
			
			$itemsTypeFiels = $this->items_type_raw("it");
			$response .= ", ".$itemsTypeFiels;
			$response .= ", ipr.items_prices_id, 
							ipr.price, 
							CONCAT(i.items_desc,
									' (',
									co.colors_desc,
									')',
									' (',
									si.sizes_desc,
									') ') AS items_display";
							
			return $response;
		}
		
		public function items_order_main(){
			$response = "ito.items_orders_id,
						ito.quantity as order_qty, 
						ito.date_transaction as date_ordered";
			$sizesFields = $this->sizes_raw("si");
			$response .= ", isi.items_size_id";
			$response .= ", ".$sizesFields;
			
			$colorsFields = $this->colors_raw("co");
			$response .= ", ico.items_colors_id, 
							ico.image";
			$response .= ", ".$colorsFields;
			
			$itemsFields = $this->items_raw("i");
			$response .= ", ".$itemsFields;
			
			$itemsTypeFiels = $this->items_type_raw("it");
			$response .= ", ".$itemsTypeFiels;
			$response .= ", ipr.items_prices_id, 
							ipr.price";
			
			$response .= ", u.users_id, 
							CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,  
							CONCAT(LEFT(ut.users_type_desc, 1),
								'YLR-',
								LPAD(u.users_number, 5, 0)) AS users_number_display, 
							ut.users_type_desc";
			$statusFields = $this->status_raw("ito_s");
			$response .= ", ".$statusFields;
			
			$response .= ", CONCAT(i.items_desc,
									' (',
									co.colors_desc,
									')',
									' (',
									si.sizes_desc,
									') ') AS items_display,
							(ito.quantity * ipr.price) AS sub_total";
			return $response;
		}
		
		public function users_items_order_count(){
			$response = "u.users_id, 
						count(ito.items_orders_id) as order_count";
			return $response;
		}
		
		public function items_ordered_history_raw($alias = null){
			$fields = array(
				"items_order_history_id", 
				"items_order_id", 
				"quantity", 
				"date_transaction", 
				"transaction_remarks"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function items_ordered_history_main($alias = null){
			$response = $this->items_ordered_history_raw("ito_h");
			
			$response .= ", u.users_id, 
							CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,  
							CONCAT(LEFT(ut.users_type_desc, 1),
								'YLR-',
								LPAD(u.users_number, 5, 0)) AS users_number_display, 
							ut.users_type_desc";
			$statusFields = $this->status_raw("ito_sh");
			$response .= ", ".$statusFields;
			
			return $response;
		}
		
		public function clients_raw($alias = null){
			$fields = array(
				"clients_id", 
				"first_name", 
				"middle_name", 
				"last_name"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function sales_raw($alias = null){
			$fields = array(
				"sales_id", 
				"project_name", 
				"location", 
				"price", 
				"quantity", 
				"date_reserve"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function sales_main(){
			$response = $this->sales_raw("sa");
			$response .= ", cl.clients_id,
							CONCAT(cl.first_name,
									' ',
									cl.last_name,
									IF(cl.suffix IS NOT NULL OR cl.suffix != '',
										CONCAT(' ', cl.suffix),
										'')) AS clients_full_name";
										
			$statusFields = $this->status_raw("sa_s");
			$response .= ", ".$statusFields;
			
			$response .= ", sa_u.users_id, 
							CONCAT(sa_u.first_name,
									' ',
									sa_u.last_name,
									IF(sa_u.second_name IS NOT NULL
											OR sa_u.second_name != '',
										CONCAT(' ', sa_u.second_name),
										'')) AS transact_full_name";
			
			return $response;
		}
		
		public function documents_type_raw($alias = null){
			$fields = array(
				"documents_type_id", 
				"documents_type_code", 
				"documents_type_desc"
			);
			$temp = array();
			foreach($fields as $values){
				$fieldName = ($alias != "" ? $alias."." : "").$values;
				$temp[] = $fieldName;
			}
			
			$response = implode(", ",$temp);
			return $response;
		}
		
		public function documents_request_main(){
			$response = "dr.documents_request_id,
						dr.date_need,
						dr.transaction_remarks AS purpose";
			
			$documentsTypeFields = $this->documents_type_raw("dt");
			$response .= ", ".$documentsTypeFields;
			
			$response .= ", IF(dt.documents_type_desc = 'Others',
								dr.other_document,
								dt.documents_type_desc) AS documents_requested_display";
			
			$statusFields = $this->status_raw("dr_s");
			$response .= ", ".$statusFields;
			
			$response .= ", u.users_id, 
							CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name,  
							CONCAT(LEFT(ut.users_type_desc, 1),
								'YLR-',
								LPAD(u.users_number, 5, 0)) AS users_number_display, 
							ut.users_type_desc";
							
			return $response;
		}
		
		public function documents_request_history_main(){
			$response = "drh.documents_request_history_id,
						drh.documents_request_id,
						drh.date_transaction,
						drh.transaction_remarks";
			$statusFields = $this->status_raw("drh_s");
			$response .= ", ".$statusFields;
			
			$response .= ", u.users_id, 
							CONCAT(u.first_name,
									' ',
									u.last_name,
									IF(u.second_name IS NOT NULL
											OR u.second_name != '',
										CONCAT(' ', u.second_name),
										'')) AS full_name";
			return $response;
		}	
	}
	
?>