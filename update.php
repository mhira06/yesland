<?php
	class Update{
		public $sql_query, 
				$sql_fields, 
				$db, 
				$generate;
		public function __construct() {
			$this->generate = new Generate();
			$this->db = new Databases();
		}
		
		public function users_login($data, $condition){
			$update = $this->db->update("tbl_users_login", $data, $condition, "local");
			
			return $update;
		}
		
		public function users($data, $condition){
			$update = $this->db->update("tbl_users", $data, $condition, "local");
			
			return $update;
		}
		
		public function users_leave_credit($data, $condition){
			$update = $this->db->update("tbl_users_leave_credit", $data, $condition, "local");
			
			return $update;
		}
		
		public function leave_transaction($data, $condition){
			$update = $this->db->update("tbl_leave_transaction", $data, $condition, "local");
			
			return $update;
		}
		
		public function activities($data, $condition){
			$update = $this->db->update("tbl_activities", $data, $condition, "local");
			
			return $update;
		}
		
		public function items_order($data, $condition){
			$update = $this->db->update("tbl_items_orders", $data, $condition, "local");
			
			return $update;
		}
		
		public function documents_request($data, $condition){
			$update = $this->db->update("tbl_documents_request", $data, $condition, "local");
			
			return $update;
		}
		
		public function items_colors($data, $condition){
			$update = $this->db->update("tbl_items_colors", $data, $condition, "local");
			
			return $update;
		}
		
		public function sales($data, $condition){
			$update = $this->db->update("tbl_sales", $data, $condition, "local");
			
			return $update;
		}
	}