<?php
	class Insert{
		public $sql_query, 
				$sql_fields, 
				$db, 
				$generate;
		public function __construct() {
			$this->generate = new Generate();
			$this->db = new Databases();
		}
		
		public function users_login($data){
			$insert = $this->db->insert("tbl_users_login", $data, "local");
			
			return $insert;
		}
		
		public function users($data){
			$insert = $this->db->insert("tbl_users", $data, "local");
			
			return $insert;
		}
		
		public function users_contact_number($data){
			$insert = $this->db->insert("tbl_users_contact_number", $data, "local");
			
			return $insert;
		}
		
		public function users_address($data){
			$insert = $this->db->insert("tbl_users_address", $data, "local");
			
			return $insert;
		}
		
		public function users_identification($data){
			$insert = $this->db->insert("tbl_users_identification", $data, "local");
			
			return $insert;
		}
		
		public function users_position($data){
			$insert = $this->db->insert("tbl_users_position", $data, "local");
			
			return $insert;
		}
		
		public function users_status($data){
			$insert = $this->db->insert("tbl_users_status", $data, "local");
			
			return $insert;
		}
		
		public function users_rate($data){
			$insert = $this->db->insert("tbl_users_rate", $data, "local");
			
			return $insert;
		}
		
		public function users_leave_credit($data){
			$insert = $this->db->insert("tbl_users_leave_credit", $data, "local");
			
			return $insert;
		}
		
		public function leave_transaction($data){
			$insert = $this->db->insert("tbl_leave_transaction", $data, "local");
			
			return $insert;
		}
		
		public function leave_transaction_history($data){
			$insert = $this->db->insert("tbl_leave_transaction_status_history", $data, "local");
			
			return $insert;
		}
		
		public function leave_dates($data){
			$insert = $this->db->insert("tbl_leave_dates", $data, "local");
			
			return $insert;
		}
		
		public function activities($data){
			$insert = $this->db->insert("tbl_activities", $data, "local");
			
			return $insert;
		}
		
		public function activities_target_attendees($data){
			$insert = $this->db->insert("tbl_activities_target_attendees", $data, "local");
			
			return $insert;
		}
		
		public function activities_attendees($data){
			$insert = $this->db->insert("tbl_activities_attendees", $data, "local");
			
			return $insert;
		}
		
		public function activities_status_history($data){
			$insert = $this->db->insert("tbl_activities_status_history", $data, "local");
			
			return $insert;
		}
		
		public function items_order($data){
			$insert = $this->db->insert("tbl_items_orders", $data, "local");
			
			return $insert;
		}
		
		public function items_order_history($data){
			$insert = $this->db->insert("tbl_items_order_history", $data, "local");
			
			return $insert;
		}
		
		public function items_stock($data){
			$insert = $this->db->insert("tbl_items_stocks", $data, "local");
			
			return $insert;
		}
		
		public function clients($data){
			$insert = $this->db->insert("tbl_clients", $data, "local");
			
			return $insert;
		}
		
		public function clients_contact_number($data){
			$insert = $this->db->insert("tbl_clients_contact_number", $data, "local");
			
			return $insert;
		}
		
		public function clients_address($data){
			$insert = $this->db->insert("tbl_clients_address", $data, "local");
			
			return $insert;
		}
		
		public function sales($data){
			$insert = $this->db->insert("tbl_sales", $data, "local");
			
			return $insert;
		}
		
		public function sales_history($data){
			$insert = $this->db->insert("tbl_sales_history", $data, "local");
			
			return $insert;
		}
		
		public function documents_request($data){
			$insert = $this->db->insert("tbl_documents_request", $data, "local");
			
			return $insert;
		}
		
		public function documents_request_history($data){
			$insert = $this->db->insert("tbl_documents_request_history", $data, "local");
			
			return $insert;
		}
		
		public function items_price($data){
			$insert = $this->db->insert("tbl_items_prices", $data, "local");
			
			return $insert;
		}
		
		public function items($data){
			$insert = $this->db->insert("tbl_items", $data, "local");
			
			return $insert;
		}
		
		public function items_colors($data){
			$insert = $this->db->insert("tbl_items_colors", $data, "local");
			
			return $insert;
		}
		
		public function items_size($data){
			$insert = $this->db->insert("tbl_items_size", $data, "local");
			
			return $insert;
		}
		
	}