<?php
	if (!session_id()) @session_start();
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/configs/includes.php");
	
	class Functions{
		public $generate, $db, $select;
		public function __construct() {
			$this->generate = new Generate();
			$this->db = new Databases();
			$this->select = new Select();
		}
		public function get_date_and_time_now($format){
			$dt = new DateTime();
			return $dt->format($format);
		}
		
		public function format_date($date, $format){
			$strToTimeDate = strtotime($date);
			$newDate = date($format, $strToTimeDate);
			
			return $newDate;
		}
		public function format_date_2($date, $old_format, $new_format){
			$date2 = DateTime::createFromFormat($old_format, $date);
			return $date2->format($new_format);
		}
		
		public function format_date_3($date, $modify, $format_result){
			$dateCreated = new DateTime($date);
			$dateCreated->modify($modify);
			return $dateCreated->format($format_result);
		}
		
		public function format_date_4($date, $format){
			
			$replacedDate = ((strpos($date, '/') !== false) ? $date : str_replace('/', '-', $date));
			$strToTimeDate = strtotime($replacedDate);
			$newDate = date($format, $strToTimeDate);
			return $newDate;
		}
		
		public function compute_time_difference($start, $end){
			$response = "";
			$startTime = strtotime($start);
			$endTime = strtotime($end);
			
			$response = round(abs($endTime - $startTime) / 60 / 60,2);
			
			return $response;
		}
		
		public function clean($string) {
			return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
		}
		
		public function clear_string($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		public function read_csv($file){
			$file_handle = fopen($file, 'r');
			while (!feof($file_handle) ) {
				$line_of_text[] = fgetcsv($file_handle, 1024);
			}
			fclose($file_handle);
			return $line_of_text;
		}
		
		public function echo_array($array){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
		
		
		public function load($url){
			$php = $url.".php";
			$view = $this->root_url($php); 
			include($view);
		}
		public function post($index = null){
			$response = "";
			$sendData = $_POST;
			if($index == ""){
				if(empty($sendData)){
					$response = "No Post data received";
				}
				else{
					$response = $sendData;
				}
			}
			else{
				$response = isset($sendData[$index]) ? $sendData[$index] : "";
			}
			
			return $response;
		}
		
		public function get($index = null){
			$response = "";
			$sendData = $_GET;
			if($index == ""){
				if(empty($sendData)){
					$response = "No Post data received";
				}
				else{
					$response = $sendData;
				}
			}
			else{
				$response = isset($sendData[$index]) ? $sendData[$index] : "";
			}
			
			return $response;
		}
		
		public function flash_message($alert, $message, $redirect){
			$flashMessage = new \Plasticbrain\FlashMessages\FlashMessages();
			
			$flashMessage->{$alert}($message, $redirect);
		}
		
		public function display_flash(){
			$flashMessage = new \Plasticbrain\FlashMessages\FlashMessages();
			
			$flashMessage->display();
		}
		
		public function get_users_number($usersType){
			$response = array();
			$sqlFields = "u.users_number, ut.users_type_desc";
	
			$sqlCondition = "ut.users_type_id = '".$usersType."'";
			
			$sqlOrder = "u.date_added desc";
			$usersDetails = $this->select->get_active_user_main_details($sqlFields, $sqlCondition, $sqlOrder, "1");
			
			$totalCount = isset($usersDetails["users_number"]) ? $usersDetails["users_number"] : 0;
			$userTypeDesc = isset($usersDetails["users_type_desc"]) ? $usersDetails["users_type_desc"] : "";
			if($userTypeDesc == ""){
				$userTypeDetails = $this->select->get_user_type($usersType);
				$userTypeDesc = $userTypeDetails["users_type_desc"];
			}
			$usersTypeCode = substr($userTypeDesc, 0, 1);
			$number = $totalCount + 1;
			$display = sprintf("%05d", $number);
			$usersNumberDisplay = $usersTypeCode."YLR-".$display;
			$response = array(
				"display" => $usersNumberDisplay, 
				"value" => $number, 
				"users_type" => $userTypeDesc
			);
			
			return $response;
		}
		
		
	}
?>