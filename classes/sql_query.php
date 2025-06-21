<?php
	class Sql_query{
		public $sql_fields, $sql_tables, $generate;
		public function __construct(){
			$this->sql_fields = new Sql_fields();
			$this->sql_tables = new Sql_tables();
			$this->generate = new Generate();
		}
		
		public function users_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->users_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->users_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "u.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function users_type_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_users_type";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_type_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_type_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function identification_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->identification_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->identification_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_identification_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "id.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->identification_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function users_identification($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->users_identification_main();
			
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->users_identification_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_identification($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "u_id.status = 'active' 
								and u_id.transaction_status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_identification($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function users_contact_number_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->users_contact_number_main();
			
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->users_contact_number_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_contact_number($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "u_cn.status = 'active' 
								and u_cn.transaction_status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_contact_number_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function users_address_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->users_address_main();
			
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->users_address_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_address($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "u_ad.status = 'active' 
								and u_ad.transaction_status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_address_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function contact_number_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->contact_number_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_contact_number_type";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_contact_number_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->contact_number_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function address_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->address_type_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_address_type";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_address_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->address_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function login_type_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->login_type_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_login_type";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_login_type_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->login_type_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function users_type_status_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->users_type_status();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->users_type_status();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_type_status($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "uts.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_type_status_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function rate_type_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->rate_type_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_rate_type";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_rate_type_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->rate_type_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function positions_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->positions_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_positions";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_positions_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->positions_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function users_type_leave_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->users_type_leave_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->users_type_leave();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_type_leave_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "utl.status = 'active'";
			
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_type_leave_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function leave_transaction_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->leave_transaction_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->leave_transaction_main();
				/*start of leave date summary*/
				$leaveDateFields = $this->sql_fields->leave_dates_display();
				$leaveDateGroup = "ltr.leave_transaction_id";
				$leaveDateQuery = $this->active_leave_dates_main($leaveDateFields, "", $leaveDateGroup);
				/*end of leave date summary*/
			$sqlTables .= " left join (".$leaveDateQuery.") leave_dates on leave_dates.leave_transaction_id = ltr.leave_transaction_id";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_leave_transaction_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ltr.transaction_status = 'active' 
								and ltr.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->leave_transaction_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function users_leave_credit($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->users_leave_credit_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->users_leave_credit_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_users_leave_credit($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ulc.transaction_status = 'active' 
								and ulc.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->users_leave_credit($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
			
		}
		
		public function leave_type_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->leave_type_raw();
			
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "";
		}
		
		public function leave_dates_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->leave_dates_main();
			
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->leave_dates_main();
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_leave_dates_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ld.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->leave_dates_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function leave_history_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->leave_history_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->leave_history_main();
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_leave_history_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ltsh.status = 'active'
								AND ltsh.transaction_status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->leave_history_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function activities_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->activities_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->activities_main();
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_activities_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "a.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->activities_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function target_attendees_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_activities_target_attendees";
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_target_attendees_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->target_attendees_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function status_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_status";
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_status_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->status_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_page_status($page, $condition = null){
			$sqlCondition = "page = '".$page."'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->active_status_raw("", $sqlCondition);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function activities_status_history_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_activities_status_history";
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_activities_status_history_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->activities_status_history_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function activities_attendees_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_activities_attendees";
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_activities_attendees_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->activities_attendees_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function activities_attendees_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->activities_attendees_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->activities_attendess_main();
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_activities_attendees_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "att.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->activities_attendees_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function activities_target_attendees_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->activities_target_attendees_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->activities_target_attendees_main();
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_activities_target_attendees_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ata.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->activities_target_attendees_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function items_type_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_items_type";
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_items_type_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->items_type_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function items_stock_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->items_stock_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->items_stock_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_items_stock_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ist.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->items_stock_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function items_order_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->items_order_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->items_order_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_items_order_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ito.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->items_order_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function items_ordered_history_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->items_ordered_history_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->items_ordered_history_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function action_items_ordered_history_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ito_h.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->items_ordered_history_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function clients_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->clients_raw();
			$sqlFields .= ", CONCAT(first_name,
									' ',
									last_name,
									IF(suffix IS NOT NULL
											OR suffix != '',
										CONCAT(' ', suffix),
										'')) AS full_name";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_clients";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_clients_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->clients_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function sales_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->sales_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->sales_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_sales_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "sa.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->sales_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function documents_type_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->documents_type_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_documents_type";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_documents_type_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->documents_type_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function documents_request_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->documents_request_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->documents_request_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_documents_request_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "dr.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->documents_request_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function documents_request_history_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->documents_request_history_main();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = $this->sql_tables->documents_request_history_main();
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_documents_request_history_main($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "drh.status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->documents_request_history_main($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function color_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->colors_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_colors";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_color_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->color_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function items_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->items_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_items";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_items_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->items_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function size_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = $this->sql_fields->sizes_raw();
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_sizes";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_size_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->size_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function items_color_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_items_colors";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_items_color_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->items_color_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function items_size_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlFields = "*";
			if($fields != ""){
				$sqlFields = $fields;
			}
			
			$sqlTables = "tbl_items_size";
			
			$sqlQuery = $this->generate->sql_query($sqlFields, $sqlTables, $condition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
		public function active_items_size_raw($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "status = 'active'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->items_size_raw($fields, $sqlCondition, $group, $order, $limit);
			
			$response = $sqlQuery;
			
			return $response;
		}
		
	}
?>