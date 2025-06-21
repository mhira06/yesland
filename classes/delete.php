<?php
	class Delete_data{
		public $sql_query, 
				$sql_fields, 
				$db, 
				$generate;
		public function __construct() {
			$this->generate = new Generate();
			$this->db = new Databases();
		}
		
		public function users_login($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"password_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_login", $data, $condition, "local");
			
			return $update;
		}
		
		public function users_contact_number($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_contact_number", $data, $condition, "local");
			
			return $update;
		}
		
		public function users_address($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_address", $data, $condition, "local");
			
			return $update;
		}
		
		public function users_identification($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_identification", $data, $condition, "local");
			
			return $update;
		}
		
		public function users_position($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_position", $data, $condition, "local");
			
			return $update;
		}
		public function users_status($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_status", $data, $condition, "local");
			
			return $update;
		}
		
		public function users_rate($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_rate", $data, $condition, "local");
			
			return $update;
		}
		
		public function users_leave_credit($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_users_leave_credit", $data, $condition, "local");
			
			return $update;
		}
		
		public function target_activities_attendees($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_activities_target_attendees", $data, $condition, "local");
			
			return $update;
		}
		
		public function activities_attendees($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_activities_attendees", $data, $condition, "local");
			
			return $update;
		}
		
		public function items_stock($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "inactive", 
				"transaction_remarks" => $remarks
			);
			$update = $this->db->update("tbl_items_stocks", $data, $condition, "local");
			
			return $update;
		}
		
		public function clients_contact_number($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_clients_contact_number", $data, $condition, "local");
			
			return $update;
		}
		
		public function clients_address($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "deleted",
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_clients_address", $data, $condition, "local");
			
			return $update;
		}
		
		public function items_price($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"transaction_status" => "inactive", 
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_items_prices", $data, $condition, "local");
			
			return $update;
		}
		
		public function items_size($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted", 
				"remarks" => $remarks
			);
			$update = $this->db->update("tbl_items_size", $data, $condition, "local");
			
			return $update;
		}
		
		public function items_color($condition, $users, $remarks){
			$data = array(
				"date_deleted" => date("Y-m-d H:i:s"), 
				"deleted_by" => $users,
				"status" => "deleted"
			);
			$update = $this->db->update("tbl_items_colors", $data, $condition, "local");
			
			return $update;
		}
	}