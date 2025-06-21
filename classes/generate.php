<?php
	class Generate{
		
		public function sql_columns($array){
			$response = "";
			$columnValue= "";
			$arrayedColumn = array();
			
			if(array_key_exists(0, $array))
			{
				foreach($array[0] as $key => $value)
				{
					array_push($arrayedColumn, $key);
				}
			}
			else
			{
				foreach($array as $key => $value)
				{
					array_push($arrayedColumn, $key);
				}
			}
			
			$response = implode(", ", $arrayedColumn);
			return $response;
		}
		
		public function sql_column_values($array){
			$response = "";
			$pushedData = "";
			$implodedData2 = "";
			$arrayedValues = array();
			foreach($array as $key => $value){
				if(is_array($value)){
					$pushedData2 = "";
					$arrayedValues2 = array();
					foreach($value as $key2 => $value2){
						$pushedData2 = "'".str_replace("'", "''", $value2)."'";
						array_push($arrayedValues2, $pushedData2);
					}
					$implodedData2 = implode(", ", $arrayedValues2);
					$pushedData = "(".$implodedData2.")";
					array_push($arrayedValues, $pushedData);
					$response = implode(", ", $arrayedValues);
				}
				else{
					$pushedData = "'".str_replace("'", "''", $value)."'";
					array_push($arrayedValues, $pushedData);
					$response = "(".implode(", ", $arrayedValues).")";
				}
			}
			
			return $response;
		}
		
		public function sql_update_condition($array){
			$response = $array;
			$string = "";
			$arrayedResults = array();
			if(is_Array($array)){
				foreach($array as $key => $value)
				{
					if(is_array($value)){
						$listCondititionValue = implode("', '", $value);
						$string = $key . " in ('".$listCondititionValue."')";
					}
					else{
						$string = $key . " = '" . $value ."'";
					}
					
					array_push($arrayedResults, $string);
				}
				$response = implode(" and ", $arrayedResults);
			}
			return $response;
		}
		
		public function sql_update_values($data){
			$response = "";
			$string = "";
			$arrayedResults = array();
			foreach($data as $key => $value)
			{
				if($value == "NULL" || $value == "null"){
					$string = $key . " = " . $value;
				}
				else{
					$string = $key . " = '" . str_replace("'", "''", $value) ."'";
				}
				
				array_push($arrayedResults, $string);
			}
			$response = implode(", ", $arrayedResults);
			return $response;
		}
		
		public function sql_query($fields = null, $table, $condition = null, $group = null, $order = null, $limit = null){
			$useFields = "*";
			if($fields != ""){
				$useFields = $fields;
			}
			
			$sqlCondition = $condition;
			$sqlString = "select ".$useFields." from ".$table;
			if($condition != "")
			{
				$sqlString .= " WHERE ".$sqlCondition;
			}
			
			if($group != "")
			{
				$sqlString .= " GROUP BY ".$group;
			}
			
			if($order != "")
			{
				$sqlString .= " ORDER BY ".$order;
			}
			
			if($limit != "")
			{
				$sqlString .= " LIMIT ".$limit;
			}
			
			return $sqlString;
		}
		
		public function range_date($start, $end, $format, $type = "P1D", $sequence = null){
			$periodDate 	= array();
			$utc 			= new DateTimeZone('UTC');
			$periodStart 	= new DateTime($start, $utc);
			$periodEnd 		= new DateTime($end, $utc);
			$periodEnd->modify('+1 day');
			$interval 		= new DateInterval($type);
			$period   		= new DatePeriod($periodStart, $interval, $periodEnd);
			//$this->echo_array($period);
			//echo $format;
			foreach($period as $dt){
				$date = $dt->format($format);
				//echo "Date: ".$date."<bR>";
				if($sequence != ""){
					$startDate = new DateTime($date);
					//$this->echo_array($startDate);
					$startDate->modify($sequence);
					$nextDate = $startDate->format($format);
					//echo "Date To: ".$nextDate."<bR>";
					$date = $date."=".$nextDate;
					
				}
				$periodDate[] = $date;
			}
			
			return $periodDate;
		}
		
		public function ip_address(){
			$response = "";
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$response = $_SERVER['HTTP_CLIENT_IP'];
			} 
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$response = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} 
			else {
				$response = $_SERVER['REMOTE_ADDR'];
			}
			return $response;
		}
		
		public function subtract_date($start, $end, $type){
			$diff = abs(strtotime($end) - strtotime($start));
			$response = "";
			switch($type){
				case "years":
					$response = floor($diff / (365*60*60*24));
				break;
				
				case "moonths":
					$response = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				break;
				
				case "days":
					$response = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				break;
			}
			return $response;
		}
		
		public function alert_message($type, $message, $close = false){
			//$response = "<div class = 'alert alert-".$type."'>".$message."</div>";
			$icon = "bell";
			$textColor = "text-white";
			switch($type){
				case "primary":
					$icon = "fa-bookmark";
					$textColor = "text-black";
				break;
				
				case "secondary":
					$icon = "fa-tag";
					$textColor = "text-black";
				break;
				
				case "success":
					$icon = "fa-check-circle";
					$textColor = "text-white";
				break;
				
				case "danger":
					$icon = "fa-times-circle";
				break;
				
				case "warning":
					$icon = "fa-exclamation";
					$textColor = "text-black";
				break;
				
				case "info":
					$icon = "fa-info-circle";
					$textColor = "text-black";
				break;
				
				
			}
			$response = "<div class = 'alert alert-".$type." alert-dismissible'>";
			if($close == true){
				$response .= "<button type = 'button' class= 'btn-close close' data-bs-dismiss = 'alert' aria-label= 'Close'>x</button>";
			}
			$response .="	<h5>
								<i class = 'icon fas ".$icon."'></i>
								Message
							</h5>
							<div class= ''>".$message."</div>
						</div>";
			return $response;
		}
		
		public function array_to_in($list){
			$response = "";
			if(is_array($list)){
				$response = implode("', '", $list);
			}
			else{
				$response = $list;
			}
			
			return $response;
		}
	}
?>