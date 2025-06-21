<?php
	class Menu{
		public function side($active){
			$session = isset($_SESSION[PROJECT]) ? $_SESSION[PROJECT] : array();
			$sessionUser = isset($session["user"]) ? $session["user"] : array();
			$logintType = isset($sessionUser["login_type"]) ? $sessionUser["login_type"] : "";
			$userType = isset($sessionUser["user_type"]) ? $sessionUser["user_type"] : "";
			$response = array();
			$administrationList = array(
				"manage_leave", 
				"manage_activities", 
				"manage_clients", 
				"manage_sales", 
				"manage_documents_request", 
				"manage_online_ordering", 
				"users"
			);
			$maintenanceList = array(
				"users", 
				"address_type", 
				"contact_number_type", 
				"identification", 
				"leave_type", 
				"position", 
				"rate_type", 
				"document_type", 
				"items", 
				"items_type", 
				"colors", 
				"sizes"
			);
			if($logintType != "1" && (in_array($active, $administrationList) || in_array($active, $maintenanceList)) ){
				redirect();
			}
			$response[] = array(
				"class" => $active == "dashboard" ? "active" : "", 
				"url" => base_url(), 
				"icon" => "tachometer-alt", 
				"text" => "Dashboard"
			);
			$response[] = array(
				"class" => $active == "profile" ? "active" : "", 
				"url" => base_url("pages/display/profile.php"), 
				"icon" => "user-alt", 
				"text" => "Profile"
			);
			if($userType == "1"){
				$response[] = array(
					"class" => $active == "leave" ? "active" : "", 
					"url" => base_url("pages/display/leave.php"), 
					"icon" => "calendar-alt", 
					"text" => "Leave"
				);
			}
			
			$response[] = array(
				"class" => $active == "activities" ? "active" : "", 
				"url" => base_url("pages/display/activities.php"), 
				"icon" => "users", 
				"text" => "Activities"
			);
			$response[] = array(
				"class" => $active == "online_ordering" ? "active" : "", 
				"url" => base_url("pages/display/online_ordering.php"), 
				"icon" => "layer-group", 
				"text" => "Online Ordering"
			);
			
			if($userType == "2" || $logintType == "1"){
				$response[] = array(
					"class" => $active == "sales" ? "active" : "", 
					"url" => base_url("pages/display/sales.php"), 
					"icon" => "chart-line", 
					"text" => "Sales"
				);
				$response[] = array(
					"class" => $active == "document_request" ? "active" : "", 
					"url" => base_url("pages/display/document_request.php"), 
					"icon" => "calendar-alt", 
					"text" => "Document Request"
				);
			}
			if($logintType == "1"){
				
				$administration = array(
					"class" => in_array($active, $administrationList) ? "active" : "", 
					"url" => "javascript:void(0)", 
					"icon" => "lock", 
					"text" => "Administration", 
					"sub_menu" => array()
				);
				$administration["sub_menu"][] =  array(
					"class" => $active == "manage_leave" ? "active" : "", 
					"url" => base_url("pages/administration/manage_leave.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Leave"
				);
				$administration["sub_menu"][] =  array(
					"class" => $active == "manage_activities" ? "active" : "", 
					"url" => base_url("pages/administration/manage_activities.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Activities"
				);
				/*$administration["sub_menu"][] =  array(
					"class" => $active == "manage_clients" ? "active" : "", 
					"url" => base_url("pages/administration/manage_clients.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Clients"
				);*/
				$administration["sub_menu"][] =  array(
					"class" => $active == "manage_sales" ? "active" : "", 
					"url" => base_url("pages/administration/manage_sales.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Sales"
				);
				$administration["sub_menu"][] =  array(
					"class" => $active == "manage_documents_request" ? "active" : "", 
					"url" => base_url("pages/administration/manage_documents_request.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Document Request"
				);
				$administration["sub_menu"][] =  array(
					"class" => $active == "manage_online_ordering" ? "active" : "", 
					"url" => base_url("pages/administration/manage_online_ordering.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Online Ordering"
				);
				$administration["sub_menu"][] =  array(
					"class" => $active == "users" ? "active" : "", 
					"url" => base_url("pages/maintenance/users.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Users"
				);
				$response[] = $administration;
				
				$maintenance = array(
					"class" => in_array($active, $maintenanceList) ? "active" : "", 
					"url" => "javascript:void(0)", 
					"icon" => "cog", 
					"text" => "Maintenance", 
					"sub_menu" => array()
				);
				/*$maintenance["sub_menu"][] =  array(
					"class" => $active == "users" ? "active" : "", 
					"url" => base_url("pages/maintenance/users.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Users"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "address_type" ? "active" : "", 
					"url" => base_url("pages/maintenance/address_type.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Address Type"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "contact_number_type" ? "active" : "", 
					"url" => base_url("pages/maintenance/contact_number_type.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Contact Number Type"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "identification" ? "active" : "", 
					"url" => base_url("pages/maintenance/identification.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Identification"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "leave_type" ? "active" : "", 
					"url" => base_url("pages/maintenance/leave_type.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Leave Type"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "position" ? "active" : "", 
					"url" => base_url("pages/maintenance/position.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Position"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "rate_type" ? "active" : "", 
					"url" => base_url("pages/maintenance/rate_type.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Rate Type"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "document_type" ? "active" : "", 
					"url" => base_url("pages/maintenance/document_type.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Document Type"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "items_type" ? "active" : "", 
					"url" => base_url("pages/maintenance/items_type.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Items Type"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "colors" ? "active" : "", 
					"url" => base_url("pages/maintenance/colors.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Colors"
				);
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "sizes" ? "active" : "", 
					"url" => base_url("pages/maintenance/sizes.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Sizes"
				);*/
				$maintenance["sub_menu"][] =  array(
					"class" => $active == "items" ? "active" : "", 
					"url" => base_url("pages/maintenance/items.php"), 
					"icon" => "right-arrow-alt", 
					"text" => "Items"
				);
				$response[] = $maintenance;
			}
			
			return $response;
		}
	}
?>