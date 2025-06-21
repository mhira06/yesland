<?php
	class Select{
		public $sql_query, 
				$sql_fields, 
				$db, 
				$generate;
		public function __construct() {
			$this->generate = new Generate();
			$this->db = new Databases();
			$this->sql_query = new Sql_query();
			$this->sql_fields = new Sql_fields();
		}
		
		public function users_login($user, $pass){
			$sqlCondition = "CONCAT(LEFT(ut.users_type_desc, 1),
									'YLR-',
									LPAD(u.users_number, 5, 0)) = '".$user."' 
								and users_password = '".$pass."'";
			$sqlQuery = $this->sql_query->active_users_main("", $sqlCondition);
			//echo $sqlQuery;
			//exit;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_user_type($id){
			$sqlCondition = "users_type_id = '".$id."'";
			$sqlQuery = $this->sql_query->active_users_type_raw("", $sqlCondition);
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_user_details($id){
			$sqlCondition = "u.users_id = '".$id."'";
			$sqlQuery = $this->sql_query->active_users_main("", $sqlCondition);
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_government_id(){
			$sqlCondition = "id_t.identification_type_desc = 'Government'";
			$sqlQuery = $this->sql_query->active_identification_main("", $sqlCondition);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_professional_id(){
			$sqlCondition = "id_t.identification_type_desc = 'Professional'";
			$sqlQuery = $this->sql_query->active_identification_main("", $sqlCondition);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_identification_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_users_identification($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_government_id($user){
			$govermentIdList = $this->get_active_government_id();
			$sqlFields = $this->sql_fields->users_identification_display($govermentIdList);
			
			$sqlCondition = "u_id.users_id = '".$user."'";
			$sqlQuery = $this->sql_query->active_users_identification($sqlFields, $sqlCondition, "u_id.users_id");
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_contact_number($user){
			$sqlCondition = "u_cn.users_id = '".$user."'";
			$sqlQuery = $this->sql_query->active_users_contact_number("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_address($user){
			$sqlCondition = "u_ad.users_id = '".$user."'";
			$sqlQuery = $this->sql_query->active_users_address("", $sqlCondition);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_users_main($fields, $condition, $group, $order, $limit);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_contact_numbers_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_contact_number_main($fields, $condition, $group, $order);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_address_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_address_main($fields, $condition, $group, $order);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_type_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->users_type_raw($fields, $condition, $group, $order);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_login_type_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_login_type_main($fields, $condition, $group, $order);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_user_main_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			
			$sqlQuery = $this->sql_query->active_users_main($fields, $condition, $group, $order, $limit);
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_type_status($usersType){
			$sqlCondition = "ut.users_type_id = '".$usersType."'";
			$sqlQuery = $this->sql_query->active_users_type_status("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_rate_type_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_rate_type_main($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_positions_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_positions_main($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_contact_number_display($user){
			$contactNumberList = $this->get_active_contact_numbers_list();
			$sqlFields = $this->sql_fields->users_contact_number_display($contactNumberList);
			
			$sqlCondition = "u_cn.users_id = '".$user."'";
			
			$sqlGroup = "u_cn.users_id";
			
			$sqlQuery = $this->sql_query->active_users_contact_number($sqlFields, $sqlCondition, $sqlGroup);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_address_display($user){
			$addressTypeList = $this->get_active_address_list();
			$sqlFields = $this->sql_fields->users_address_display($addressTypeList);
			
			$sqlCondition = "u_ad.users_id = '".$user."'";
			
			$sqlGroup = "u_ad.users_id";
			
			$sqlQuery = $this->sql_query->active_users_address($sqlFields, $sqlCondition, $sqlGroup);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_professional_id($user){
			$professionalId = $this->get_active_professional_id();
			$sqlFields = $this->sql_fields->users_identification_display($professionalId);
			
			$sqlCondition = "u_id.users_id = '".$user."'";
			$sqlQuery = $this->sql_query->active_users_identification($sqlFields, $sqlCondition, "u_id.users_id");
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_type_leave($usersTypeStatus){
			$sqlCondition = "";
		}
		
		public function get_active_employees_leave_types($employeeStatus){
			$sqlCondition = "es.employment_status_id = '".$employeeStatus."'";
			$sqlQuery = $this->sql_query->active_users_type_leave_main("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_used_leaves($usersId, $leave, $dateFrom, $dateTo){
			$sqlFields = $this->sql_fields->users_leave_summary();
			$sqlCondition = "ulc.users_id = '".$usersId."' 
							and ulc.date_from >= '".$dateFrom."' 
							and ulc.date_to <= '".$dateTo."'
							and ulc.users_type_leave_id = '".$leave."'
							and s.status_id not in (4, 5)";
			$sqlQuery = $this->sql_query->active_leave_transaction_main($sqlFields, $sqlCondition);
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_leave_credit_details($usersId){
			$sqlCondition = "ulc.users_id = '".$usersId."'";
			$sqlQuery = $this->sql_query->active_users_leave_credit("", $sqlCondition, "ulc.users_id");
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		
		public function get_users_leave_credit_list($usersId){
			$sqlCondition = "ulc.users_id = '".$usersId."'";
			$sqlQuery = $this->sql_query->active_users_leave_credit("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_leave_credit_details_2($id){
			$sqlCondition = "ulc.users_leave_credit_id = '".$id."'";
			$sqlQuery = $this->sql_query->active_users_leave_credit("", $sqlCondition, "ulc.users_id");
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_leave_dates($usersId, $date, $leave = null){
			//$sqlCondition = "ltr.users_leave_credit_id = '".$usersLeave."'";
			$sqlCondition = "ulc.users_id = '".$usersId."'";
			$dateList = $this->generate->array_to_in($date);
			$dateConditon = "ld.leave_date in ('".$dateList."')";
			$sqlCondition .= " and ".$dateConditon;
			$sqlCondition .= " and status_id not in (4, 5)";
			if($leave != ""){
				$leaveCondition = "ltr.leave_transaction_id != '".$leave."'";
				$sqlCondition .= " and ".$leaveCondition;
			}
			$sqlQuery = $this->sql_query->active_leave_dates_main("", $sqlCondition);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_leave_transaction_list($usersId, $condition = null){
			$sqlCondition = "u.users_id = '".$usersId."'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlOrder = "field(s.status_id, 1) desc";
			$sqlQuery = $this->sql_query->active_leave_transaction_main("", $sqlCondition, "", $sqlOrder);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_leave_transaction_by_id($leave){
			$leaveIdList = $this->generate->array_to_in($leave);
			$sqlCondition = "ltr.leave_transaction_id in ('".$leaveIdList."')";
			$sqlQuery = $this->sql_query->active_leave_transaction_main("", $sqlCondition);
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_leave_transaction_details_by_id($selectedLeave){
			$sqlCondition = "ltr.leave_transaction_id = '".$selectedLeave."'";
			$sqlQuery = $this->sql_query->active_leave_transaction_main("", $sqlCondition);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_leave_history_display($leave){
			$sqlFields = $this->sql_fields->leave_history_display();
			$sqlCondition = "ltsh.leave_transaction_id = '".$leave."'";
			$sqlQuery = $this->sql_query->active_leave_history_main($sqlFields, $sqlCondition, "", "ltsh.date_transaction");
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_pending_leave_list($usersId){
			$sqlCondition = "u.users_id = '".$usersId."' 
							and s.status_id = '1'";
			$sqlOrder = "ltr.date_transaction";
			$sqlQuery = $this->sql_query->active_leave_transaction_main("", $sqlCondition, "", $sqlOrder);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_leave_transaction_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_leave_transaction_main($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_activities_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_activities_main($fields, $condition, $group, $order, $limit);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_activities_details_by_id($id){
			$sqlFields = $this->sql_fields->activities_display();
			$sqlCondition = "a.activities_id = '".$id."'";
			$sqlQuery = $this->sql_query->active_activities_main($sqlFields, $sqlCondition, "a.activities_id");
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_activities_target_attendees($activitiesId){
			$sqlCondition = "activities_id = '".$activitiesId."'";
			$sqlQuery = $this->sql_query->active_target_attendees_raw("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_activities_status(){
			$sqlCondition = "status_id in (12, 13)";
			$sqlQuery = $this->sql_query->active_page_status("activities", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_activities_status($activitiesId, $status){
			$sqlCondition = "activities_id = '".$activitiesId."' 
								and status_id = '".$status."'";
			$sqlQuery = $this->sql_query->active_activities_status_history_raw("", $sqlCondition);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_activities_attendees_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_activities_attendees_raw($fields, $condition, $group, $order, $limit);
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_activities_attendees_summary($activities){
			$sqlFields = $this->sql_fields->activities_attendees_summary();
			$sqlCondition = "a.activities_id = '".$activities."'";
			$sqlGroup = "a.activities_id";
			$sqlQuery = $this->sql_query->active_activities_attendees_main($sqlFields, $sqlCondition, $sqlGroup);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_activities_attendees_status(){
			$sqlCondition = "status_id in (6, 7)";
			$sqlQuery = $this->sql_query->active_page_status("activities", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_target_attendees($activity, $status = null){
			$sqlCondition = "a.activities_id = '".$activity."'";
			if($status != ""){
				$statusCondition = "att_s.status_id = '".$status."'";
				if($status == "not_yet_decided"){
					$statusCondition = "att_s.status_id is null";
				}
				$sqlCondition .= ($sqlCondition != "" ? " and " : "").$statusCondition;
			}
			
			$sqlQuery = $this->sql_query->active_activities_target_attendees_main("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_type_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_type_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_display_list($itemsType = null){
			$sqlFields = $this->sql_fields->items_display();
			$sqlCondition = "";
			if($itemsType != "" && !empty($itemsType)){
				$itemsTypeList = $this->generate->array_to_in($itemsType);
				$itemsTypeCondition = "it.items_type_id in ('".$itemsTypeList."')";
				$sqlCondition .= ($sqlCondition != "" ? " and " : "").$itemsTypeCondition;
			}
			$sqlGroup = "i.items_id";
			$sqlQuery = $this->sql_query->active_items_stock_main($sqlFields, $sqlCondition, $sqlGroup);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_display_details($condition){
			$sqlFields = $this->sql_fields->items_display();
			$sqlCondition = $condition;
			
			$sqlGroup = "i.items_id";
			$sqlQuery = $this->sql_query->active_items_stock_main($sqlFields, $sqlCondition, $sqlGroup);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_add_to_cart_count($usersId){
			$sqlFields = $this->sql_fields->users_items_order_count();
			$sqlCondition = "u.users_id = '".$usersId."' 
							and ito_s.status_id = '8'";
			$sqlGroup = "u.users_id";
			
			$sqlQuery = $this->sql_query->active_items_order_main($sqlFields, $sqlCondition, $sqlGroup);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_pending_orders($usersId){
			$sqlCondition = "u.users_id = '".$usersId."' 
							and ito_s.status_id = '8'";
			$sqlQuery = $this->sql_query->active_items_order_main("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_users_ordered_items_list($usersId, $condition = null){
			$sqlCondition = "u.users_id = '".$usersId."' 
							and ito_s.status_id != '18'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			$sqlQuery = $this->sql_query->active_items_order_main("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_ordered_items_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_order_main($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_submitted_ordered_items_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlCondition = "ito_s.status_id not in ('18', '16')";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->sql_query->active_items_order_main($fields, $sqlCondition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_ordered_items_history($orderId){
			$sqlCondition = "ito_h.items_order_id = '".$orderId."'";
			
			$sqlOrder = "ito_h.date_transaction";
			
			$sqlQuery = $this->sql_query->action_items_ordered_history_main("", $sqlCondition, "", $sqlOrder);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_clients_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_clients_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_sales_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_sales_main($fields, $condition, $group, $order, $limit);
			//echo $sqlQuery."<br><br>";
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_sales_summary($condition = null){
			$sqlFields = "sum(sa.price) as sales_count";
			$sqlCondition  = "sa_s.status_id != '11'";
			if($condition != ""){
				$sqlCondition .= " and ".$condition;
			}
			
			$sqlQuery = $this->sql_query->active_sales_main($sqlFields, $sqlCondition);
			//echo $sqlQuery."<br><br>";
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_documents_type_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_documents_type_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_documents_request_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_documents_request_main($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_documents_request_history($documentsRequest){
			$sqlCondition = "drh.documents_request_id = '".$documentsRequest."'";
			$sqlQuery = $this->sql_query->active_documents_request_history_main("", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_colors_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_color_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_sizes_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_size_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_stock_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_stock_main($fields, $condition, $group, $order, $limit);
			//echo $sqlQuery;
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_stock_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_stock_main($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_type_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_type_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_color_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_color_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_size_input($itemsColor){
			$sqlFields = "group_concat(sizes_id) as sizes_list, 
						group_concat(items_size_id) as item_sizes_list";
			//$itemColorIdList = $this->generate->array_to_in($itemsColor);
			//$sqlCondition = "items_colors_id in ('".$itemColorIdList."')";
			$sqlCondition = "items_colors_id = '".$itemsColor."'";
			$sqlGroup = "items_colors_id";
			$sqlQuery = $this->sql_query->active_items_size_raw($sqlFields, $sqlCondition, $sqlGroup);
			//echo $sqlQuery."<br><br>";
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_items_size_list($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_items_size_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_sales_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_sales_main($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_sales_status(){
			$sqlCondition = "status_id in (10, 11)";
			$sqlQuery = $this->sql_query->active_page_status("sales", $sqlCondition);
			
			$result = $this->db->select_result($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_clients_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_clients_raw($fields, $condition, $group, $order, $limit);
			
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
		
		public function get_active_users_details($fields = null, $condition = null, $group = null, $order = null, $limit = null){
			$sqlQuery = $this->sql_query->active_users_main($fields, $condition, $group, $order, $limit);
			//echo $sqlQuery;
			$result = $this->db->select_row($sqlQuery, "local");
			
			return $result;
		}
	}
?>